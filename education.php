<?php
$title = 'Education'; $page = 'education';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/design.php';   // site design

// ===== EDIT YOUR EDUCATION HERE. Format: ["Level", "School", "Years", "Details"], =====
$education = [
    ["Elementary",  "IRAGA ELEMENTARY SCHOOL", "", ""],
    ["High School", "SOLANA FRESH WATER FISHERY SCHOOL", "", ""],
    ["Senior High", "SOLANA FRESH WATER FISHERY SCHOOL", "", ""],
];

$eduPhoto = 'assetsphoto.jpg';   // the photo shown above the schools

// ===== YOUR MESSAGE (shown under the photo, before the schools) =====
$eduHeading = 'My education journey';
$eduMessage = "Every school I attended taught me something that shaped who I am today. From my first classroom in elementary to my studies as a BSIT student at CSU-Solana, I learned that hard work, patience, and the support of my family can take me far. I am still learning, and I am grateful for every teacher and friend who helped me along the way.";
// ======================================================================================
$hasEduPhoto = is_file(__DIR__ . '/' . $eduPhoto);
?>
<style>
  .edu-photo { margin: 0 0 18px; text-align: center; }
  .edu-photo img {
    width: 100%; max-width: 300px; aspect-ratio: 4 / 5; object-fit: cover; object-position: top;
    border-radius: 16px; border: 4px solid #fff; box-shadow: 0 4px 16px rgba(0,0,0,.12);
  }
  .edu-message {
    max-width: 640px; margin: 0 auto 26px; text-align: center;
  }
  .edu-message h3 {
    margin: 0 0 8px; font-family: Georgia, "Times New Roman", serif;
    font-size: 20px; font-weight: 700; color: #d63e6b;
  }
  .edu-message p { margin: 0; line-height: 1.7; color: #5f4a58; }

  .edu-list { display: flex; flex-direction: column; gap: 14px; }
  .edu-card {
    background: #fff; border: 1px solid #f0d5d5; border-left: 4px solid #d63e6b;
    border-radius: 14px; padding: 16px 20px;
  }
  .edu-level {
    display: block; font-size: 11px; font-weight: 600; letter-spacing: .12em;
    text-transform: uppercase; color: #7c4dbc; margin-bottom: 6px;
  }
  .edu-school { margin: 0; font-family: Georgia, "Times New Roman", serif; font-size: 19px; font-weight: 700; color: #2b2230; }
  .edu-details { margin: 8px 0 0; font-size: 14px; color: #6b6270; }
</style>

<section>
  <h2>Education</h2>

  <?php if ($hasEduPhoto): ?>
    <figure class="edu-photo">
      <img src="<?= $e($eduPhoto) ?>" alt="Photo of <?= $e($name) ?>">
    </figure>
  <?php endif; ?>

  <?php if ($eduMessage): ?>
    <div class="edu-message">
      <?php if ($eduHeading): ?><h3><?= $e($eduHeading) ?></h3><?php endif; ?>
      <p><?= nl2br($e($eduMessage)) ?></p>
    </div>
  <?php endif; ?>

  <div class="edu-list">
    <?php foreach ($education as [$level, $school, $years, $details]): ?>
      <article class="edu-card">
        <span class="edu-level"><?= $e($level) ?><?= $years ? ' · ' . $e($years) : '' ?></span>
        <h3 class="edu-school"><?= $e($school) ?></h3>
        <?php if ($details): ?><p class="edu-details"><?= $e($details) ?></p><?php endif; ?>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>