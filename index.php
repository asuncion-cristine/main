<?php
$title = 'Home'; $page = 'home';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/design.php';   // site design

// ===== EDIT YOUR HOME TEXT HERE =====
$role    = 'Student';
$tagline = 'Welcome to my personal portfolio.';
$photo   = 'assetsphoto.png';   // save your picture as assets/photo.jpg
$phone   = '09058055792';      // your phone number (shown instead of Telegram)

// ===== YOUR QUOTES / NOTES IN LIFE. One per line: ["Quote or note", "Author (or leave empty)"], =====
$quotes = [
    ["My family is my strength, my studies are my path, and my journey is my story.", ""],
    ["The only way to do great work is to love what you do.", ""],
   
];
// ====================================

$initials = '';
foreach (explode(' ', $name) as $word) $initials .= strtoupper(substr($word, 0, 1));
$hasPhoto = is_file(__DIR__ . '/' . $photo);
?>
<section class="hero">
  <?php if ($hasPhoto): ?>
    <img class="photo" src="<?= $e($photo) ?>" alt="Photo of <?= $e($name) ?>">
  <?php else: ?>
    <div class="photo placeholder" aria-hidden="true"><?= $e($initials) ?></div>
  <?php endif; ?>

  <div>
    <p class="role"><?= $e($role) ?></p>
    <h1>Hi, I'm <?= $e($name) ?>.</h1>
    <p class="tagline"><?= $e($tagline) ?></p>

    <ul class="social">
      <?php foreach ($links as [$label, $url]): ?>
        <?php if (strtolower($label) === 'telegram') continue; // Telegram removed ?>
        <li><a href="<?= $e($url) ?>" target="_blank" rel="noopener noreferrer"><?= icon(strtolower($label)) ?><?= $e($label) ?></a></li>
      <?php endforeach; ?>
      <li><a href="tel:<?= $e(preg_replace('/[^0-9+]/', '', $phone)) ?>"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg><?= $e($phone) ?></a></li>
    </ul>

    <p>
      <a class="btn" href="about.php"><?= icon('about') ?>About me</a>
      <a class="btn ghost" href="contact.php"><?= icon('contact') ?>Contact</a>
      <button type="button" class="btn quote-btn" id="openQuotes"><?= icon('quote') ?>Quotes in life</button>
    </p>
  </div>
</section>

<dialog id="quotesDialog" class="modal">
  <button type="button" class="modal-close" aria-label="Close">&times;</button>
  <h2 class="modal-title">My quotes in life</h2>
  <ul class="quote-list">
    <?php foreach ($quotes as [$q, $by]): ?>
      <li>
        <blockquote><?= nl2br($e($q)) ?></blockquote>
        <?php if ($by): ?><cite><?= $e($by) ?></cite><?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
</dialog>

<script>
(function () {
  var dlg = document.getElementById('quotesDialog');
  document.getElementById('openQuotes').addEventListener('click', function () { dlg.showModal(); });
  dlg.querySelector('.modal-close').addEventListener('click', function () { dlg.close(); });
  dlg.addEventListener('click', function (ev) { if (ev.target === dlg) dlg.close(); });
})();
</script>
<?php require __DIR__ . '/includes/footer.php'; ?>