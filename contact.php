<?php
$title = 'Contact'; $page = 'contact';

// ===== EDIT YOUR CONTACT DETAILS HERE =====
$phone    = '09058055792';
$email    = 'asuncioncristine20@gmail.com';   // messages are sent to this email

// Optional: get every message in your Gmail inbox too.
// 1) Turn on 2-Step Verification in your Google account
// 2) Create an "App password" (Google Account > Security > App passwords)
// 3) Paste the 16-letter app password below. Leave it empty to skip email.
$smtpUser = 'asuncioncristine20@gmail.com';
$smtpPass = '';

$useDatabase = true;   // set to false if you do not use the database
// ==========================================

ini_set('default_socket_timeout', '8');   // never wait more than 8 seconds on a connection

/* Sends an email through Gmail (SMTP) with short time limits, so the page never keeps loading. */
function smtp_send($user, $pass, $to, $subject, $body, $replyTo) {
    $fp = @stream_socket_client('tcp://smtp.gmail.com:587', $errno, $errstr, 8);
    if (!$fp) return false;
    stream_set_timeout($fp, 8);
    $read = function () use ($fp) {
        $r = '';
        while (($l = fgets($fp, 515)) !== false) { $r .= $l; if (isset($l[3]) && $l[3] === ' ') break; }
        return $r;
    };
    $cmd = function ($c) use ($fp, $read) { fwrite($fp, $c . "\r\n"); return $read(); };
    $fail = function () use ($fp) { @fclose($fp); return false; };

    $read();
    $cmd('EHLO localhost');
    if (strpos($cmd('STARTTLS'), '220') !== 0) return $fail();
    if (!@stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) return $fail();
    $cmd('EHLO localhost');
    $cmd('AUTH LOGIN');
    $cmd(base64_encode($user));
    if (strpos($cmd(base64_encode($pass)), '235') !== 0) return $fail();
    $cmd('MAIL FROM:<' . $user . '>');
    if (strpos($cmd('RCPT TO:<' . $to . '>'), '250') !== 0) return $fail();
    $cmd('DATA');

    $headers = "From: Portfolio <$user>\r\nTo: <$to>\r\nReply-To: <$replyTo>\r\n"
             . "Subject: $subject\r\nDate: " . date('r') . "\r\nMIME-Version: 1.0\r\n"
             . "Content-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\n";
    $body = preg_replace('/^\./m', '..', str_replace(["\r\n", "\r"], "\n", $body));
    $body = str_replace("\n", "\r\n", $body);
    $ok = strpos($cmd($headers . $body . "\r\n."), '250') === 0;
    $cmd('QUIT');
    @fclose($fp);
    return $ok;
}

$status = '';
$old = ['name' => '', 'email' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = [
        'name'    => trim($_POST['name'] ?? ''),
        'email'   => trim($_POST['email'] ?? ''),
        'message' => trim($_POST['message'] ?? ''),
    ];
    if (!empty($_POST['website'])) {                       // spam trap
        $status = 'sent';
    } elseif ($old['name'] === '' || $old['message'] === '' || !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $status = 'invalid';
    } else {
        $cleanName = preg_replace('/[\r\n]+/', ' ', $old['name']);   // no line breaks in headers
        $savedFile = $savedDb = $mailed = false;

        // 1) Always keep a copy in data/messages.txt (instant, works everywhere)
        $dir = __DIR__ . '/data';
        if (!is_dir($dir)) @mkdir($dir, 0755, true);
        if (!is_file($dir . '/.htaccess')) {   // so nobody can open the file from the browser
            @file_put_contents($dir . '/.htaccess', "<IfModule mod_authz_core.c>\nRequire all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\nDeny from all\n</IfModule>\n");
        }
        $entry = "==== " . date('Y-m-d H:i:s') . " ====\n"
               . "Name:  " . $cleanName . "\nEmail: " . $old['email'] . "\n\n" . $old['message'] . "\n\n";
        $savedFile = @file_put_contents($dir . '/messages.txt', $entry, FILE_APPEND | LOCK_EX) !== false;

        // 2) Database (optional)
        if ($useDatabase && is_file(__DIR__ . '/includes/db.php')) {
            try {
                require_once __DIR__ . '/includes/db.php';
                if (!empty($pdo)) {
                    $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)")
                        ->execute([$old['name'], $old['email'], $old['message']]);
                    $savedDb = true;
                }
            } catch (Throwable $ex) { /* ignore */ }
        }

        // 3) Email through Gmail (only if you set the app password above)
        if ($smtpPass !== '') {
            try {
                $subject = '=?UTF-8?B?' . base64_encode('New message from ' . $cleanName) . '?=';
                $body = "You received a new message from your portfolio.\n\n"
                      . "Name:  " . $cleanName . "\nEmail: " . $old['email'] . "\n\nMessage:\n" . $old['message'] . "\n";
                $mailed = smtp_send($smtpUser, $smtpPass, $email, $subject, $body, $old['email']);
            } catch (Throwable $ex) { /* ignore */ }
        }

        if ($savedFile || $savedDb || $mailed) {
            $status = 'sent';
            $old = ['name' => '', 'email' => '', 'message' => ''];
        } else {
            $status = 'error';
        }
    }
}

require __DIR__ . '/includes/header.php';
require __DIR__ . '/design.php';   // site design
?>
<section>
  <h2>Contact</h2>

  <p class="contact-card">
    <strong>Phone:</strong> <a href="tel:<?= $e(preg_replace('/[^0-9+]/', '', $phone)) ?>"><?= $e($phone) ?></a><br>
    <strong>Email:</strong> <a href="mailto:<?= $e($email) ?>"><?= $e($email) ?></a>
  </p>

  <?php if ($status === 'sent'): ?>
    <p class="note ok" role="status">Message sent. Thank you!</p>
  <?php elseif ($status === 'error'): ?>
    <p class="note err" role="alert">Sorry, the message could not be sent. Please try again later or email me directly.</p>
  <?php elseif ($status === 'invalid'): ?>
    <p class="note err" role="alert">Please enter your name, a valid email and a message.</p>
  <?php endif; ?>

  <form method="post">
    <label>Name <input name="name" value="<?= $e($old['name']) ?>" required></label>
    <label>Email <input type="email" name="email" value="<?= $e($old['email']) ?>" required></label>
    <label>Message <textarea name="message" rows="5" required><?= $e($old['message']) ?></textarea></label>
    <input class="hp" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
    <button type="submit"><?= icon('send') ?>Send message</button>
  </form>

  <ul class="social">
    <?php foreach ($links as [$label, $url]): ?>
      <li><a href="<?= $e($url) ?>" target="_blank" rel="noopener noreferrer"><?= icon(strtolower($label)) ?><?= $e($label) ?></a></li>
    <?php endforeach; ?>
  </ul>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>