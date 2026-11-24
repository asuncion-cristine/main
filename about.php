<?php
$title = 'About'; $page = 'about';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/design.php';   // site design

// ===== EDIT YOUR ABOUT TEXT HERE. One box per line: ["Heading", "Text"], =====
$about = [
    ["About Me", "Hello, I am Cristine Asuncion, a Bachelor of Science in Information Technology (BSIT) student at CSU-Solana. I am a friendly, hardworking and responsible person who enjoys learning new things and improving my skills. I am curious about how technology works, especially how websites and applications are built, and I enjoy turning ideas into something people can see and use. I try to do my best in every task I take on, whether it is a school project, a group activity, or a simple responsibility at home. I value honesty, respect, and kindness, and I believe that a good attitude is as important as good skills. I like meeting new people, sharing ideas, and learning from others, because every conversation teaches me something new. My goal is to grow into a capable IT professional who can create helpful solutions and make my family and my community proud."],
    ["My journey", "My journey is made of two things I love: travelling and studying. Travelling has taught me to be brave, to adapt to new places, and to appreciate different people and cultures. Every trip, whether near or far, gave me new experiences and lessons that I carry with me. Seeing new places, tasting local food, and listening to people's stories made me more open-minded and grateful for the little things in life. At the same time, studying BSIT at CSU-Solana has opened my mind to the world of technology and helped me build my skills step by step. There were times when lessons were difficult, deadlines were close, and I felt tired, but those moments taught me not to give up and to keep trying until I understand. Balancing the two taught me patience, discipline, and how to enjoy the process of learning. I also learned that growth does not happen overnight; it comes from small steps taken every day, with the support of my family and friends. I am still on this journey, and I look forward to exploring more places, learning more every day, and one day reaching my dreams."],
    ["My family", "I come from a close, loving, and supportive family that has been my foundation for as long as I can remember. My parents taught me the value of hard work, honesty, and respect, and they have always encouraged me to pursue my dreams, even when the path felt difficult. My siblings and relatives bring laughter and warmth into our home, and the time we spend together, whether during simple dinners or special celebrations, means a lot to me. Everything I have achieved so far, including my studies at CSU-Solana, is because of their love, sacrifices, and faith in me. I hope to make them proud and one day give back for everything they have done."],
    ["Hobbies and interests", "In my free time, I enjoy exploring new technologies and learning how websites and applications work. Building and designing web pages is one of my favorite activities because it lets me combine creativity with technical skills. I also love listening to music, which helps me relax after a long day of studying, and watching movies and series with my family and friends. From time to time, I like trying out new hobbies, such as photography, drawing, or cooking, because they teach me patience and let me express myself in different ways. Whatever I do, I try to keep learning and enjoying the process."],
    ["Others", "Beyond my studies, I see myself as someone who is always willing to learn, adapt, and grow. I believe that every challenge is an opportunity to improve, and I try to approach each task with dedication and a positive attitude. As a BSIT student, my goal is to become a skilled and reliable IT professional who can develop useful solutions and contribute to my community. I am also open to meeting new people, sharing ideas, and working with others on projects. Thank you for taking the time to visit my page and getting to know me better!"],
    ["My message", "Thank you for visiting my page and taking the time to know me. I hope you learned something about who I am, where I come from, and where I want to go. Life is a journey, and I believe that every step, even the small and difficult ones, brings us closer to our dreams. Keep learning, keep believing in yourself, and never forget to be grateful for the people who support you. If you would like to say hello or work with me on a project, please feel free to reach out through my Contact page. Have a wonderful day!"],
];

// ==============================================================================
// Makes an id such as "about-my-family" from a heading
$slug = function ($h) { return 'about-' . trim(strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $h)), '-'); };

// Small icons for the buttons (same style as the top menu)
$icons = [
    "About Me" => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    "My journey" => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
    "My family" => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
    "Hobbies and interests" => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>',
    "Others" => '<circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/>',
    "My message" => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
];
$defaultIcon = '<circle cx="12" cy="12" r="9"/>';
?>
<style>
  /* One box at a time: the box fills the row, the others are hidden */
  #aboutSection > .about-block { grid-column: 1 / -1; flex: 0 0 100%; }
  #aboutSection.tabs-on > .about-block:not(.is-active) { display: none; }
  /* The buttons always take a full row of their own, ABOVE all the boxes */
  #aboutSection > h2 { order: -2; grid-column: 1 / -1; flex: 0 0 100%; }
  .about-nav-wrap { order: -1; grid-column: 1 / -1; flex: 0 0 100%; width: 100%; min-width: 0; }
  .about-nav {
    display: flex; flex-wrap: nowrap; gap: 4px;   /* one straight line */
    width: fit-content; max-width: 100%; overflow-x: auto; scrollbar-width: none;
    margin: 14px 0 20px; padding: 6px;
    border: 1px solid #f3c9d2; border-radius: 999px; background: rgba(255,255,255,.65);
  }
  .about-nav::-webkit-scrollbar { display: none; }
  .about-pill {
    flex: 0 0 auto; white-space: nowrap;
    display: inline-flex; align-items: center; gap: 7px; padding: 8px 16px; border-radius: 999px;
    color: #5f4a58; font-size: .92rem; font-weight: 500; text-decoration: none; transition: background .2s, color .2s;
  }
  .about-pill svg { width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
  .about-pill:hover { background: #fbe3ea; color: #c92a5f; }
  .about-pill.active { background: #d63a6e; color: #fff; font-weight: 700; }
</style>

<section id="aboutSection">
  <h2>About me</h2>

  <!-- Buttons that jump to each box -->
  <div class="about-nav-wrap">
  <nav class="about-nav" aria-label="About sections">
    <?php foreach ($about as $i => [$heading, $text]): ?>
      <a class="about-pill<?= $i === 0 ? ' active' : '' ?>" href="#<?= $e($slug($heading)) ?>">
        <svg viewBox="0 0 24 24" aria-hidden="true"><?= $icons[$heading] ?? $defaultIcon ?></svg>
        <?= $e($heading) ?>
      </a>
    <?php endforeach; ?>
  </nav>
  </div>

  <?php foreach ($about as [$heading, $text]): ?>
    <div class="about-block" id="<?= $e($slug($heading)) ?>">
      <h3><?= $e($heading) ?></h3>
      <p class="text"><?= nl2br($e($text)) ?></p>
    </div>
  <?php endforeach; ?>
</section>

<script>
// Show one box at a time: click a button to see that box only
(function () {
  var section = document.getElementById('aboutSection');
  var links = document.querySelectorAll('.about-pill');
  var blocks = document.querySelectorAll('#aboutSection > .about-block');
  if (!section || !links.length) return;

  function show(id) {
    var found = false;
    blocks.forEach(function (b) { var on = b.id === id; b.classList.toggle('is-active', on); if (on) found = true; });
    if (!found) { show(blocks[0].id); return; }
    links.forEach(function (l) {
      var on = l.getAttribute('href') === '#' + id;
      l.classList.toggle('active', on);
      if (on) l.setAttribute('aria-current', 'true'); else l.removeAttribute('aria-current');
    });
  }

  section.classList.add('tabs-on');
  links.forEach(function (l) {
    l.addEventListener('click', function (ev) {
      ev.preventDefault();
      var id = l.getAttribute('href').slice(1);
      show(id);
      if (history.replaceState) history.replaceState(null, '', '#' + id);
    });
  });
  show(location.hash ? location.hash.slice(1) : blocks[0].id);
})();
</script>
<?php require __DIR__ . '/includes/footer.php'; ?>