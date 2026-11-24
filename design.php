<style>
@import url('https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Manrope:wght@400;500;600;700&display=swap');

/* ===== Design tokens ===== */
:root {
  --paper:   #fff6f3;   /* page background */
  --card:    #ffffff;   /* cards */
  --ink:     #2b2230;   /* main text */
  --soft:    #6b5d6b;   /* supporting text */
  --rose:    #d63e6b;   /* main accent */
  --rose-dk: #b52c57;
  --violet:  #7c4dbc;   /* second accent */
  --line:    #f0d5d5;   /* borders */
  --blush:   #fbe3ea;   /* hover tint */
  --radius:  18px;
  --shadow:  0 10px 30px rgba(120, 50, 80, .08);
  --serif:   'Fraunces', Georgia, 'Times New Roman', serif;
  --sans:    'Manrope', system-ui, -apple-system, 'Segoe UI', sans-serif;
}

/* ===== Base ===== */
html { scroll-behavior: smooth; }
body {
  margin: 0;
  background: var(--paper);
  color: var(--ink);
  font-family: var(--sans);
  font-size: 1.02rem;
  line-height: 1.7;
  -webkit-font-smoothing: antialiased;
}
h1, h2, h3, h4 { font-family: var(--serif); color: var(--ink); line-height: 1.15; letter-spacing: -.01em; }
h2 { font-size: clamp(1.8rem, 4vw, 2.4rem); margin: 0 0 .8rem; }
h3 { font-size: 1.3rem; margin: 0 0 .5rem; }
a { color: var(--rose); text-underline-offset: 3px; }
a:hover { color: var(--rose-dk); }
:focus-visible { outline: 3px solid var(--violet); outline-offset: 3px; border-radius: 8px; }

/* ===== Top menu ===== */
body > header, header.site-header, .site-header {
  background: rgba(255, 246, 243, .88);
  backdrop-filter: blur(8px);
  border-bottom: 1px solid var(--line);
  position: sticky; top: 0; z-index: 20;
}
header nav, .site-header nav, nav.menu, .menu {
  display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 6px;
  padding: 12px 16px;
}
header nav a, .site-header nav a, .menu a {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 9px 18px; border-radius: 999px;
  color: var(--soft); font-weight: 600; font-size: .95rem; text-decoration: none;
  transition: background .2s, color .2s;
}
header nav a:hover, .menu a:hover { background: var(--blush); color: var(--rose-dk); }
header nav a.active, header nav a[aria-current],
.menu a.active, .menu a[aria-current] { background: var(--rose); color: #fff; }
header svg, nav svg { width: 17px; height: 17px; }

/* ===== Page container and cards ===== */
main { max-width: 960px; margin: 0 auto; padding: 36px 20px 70px; }
main > section {
  background: var(--card);
  border: 1px solid var(--line);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: clamp(22px, 4vw, 40px);
  margin: 0 0 28px;
}
main > section.hero { background: transparent; border: 0; box-shadow: none; padding: 40px 20px; }

/* ===== Home ===== */
section.hero {
  display: flex !important; flex-direction: column; align-items: center; justify-content: center;
  text-align: center; gap: 28px; min-height: 78vh;
}
section.hero .photo {
  width: 320px !important; height: 320px !important; max-width: 78vw; max-height: 78vw;
  border-radius: 50%; object-fit: cover; object-position: top;
  border: 6px solid #fff; box-shadow: 0 0 0 5px var(--rose), var(--shadow);
  margin: 0 auto;
}
section.hero .photo.placeholder { display: flex; align-items: center; justify-content: center; font: 700 5rem var(--serif); background: var(--blush); color: var(--rose); }
section.hero .role { font-size: .95rem; letter-spacing: .18em; text-transform: uppercase; font-weight: 700; color: var(--violet); margin: 0 0 10px; }
section.hero h1 { font-size: clamp(2.6rem, 7vw, 4.6rem); margin: 0 0 14px; }
section.hero .tagline { font-size: 1.25rem; color: var(--soft); margin: 0 0 24px; }

/* ===== Buttons and links list ===== */
.social { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; padding: 0; margin: 0 0 22px; list-style: none; }
.social a {
  display: inline-flex; align-items: center; gap: 8px; padding: 11px 20px;
  background: #fff; border: 1px solid var(--line); border-radius: 999px;
  color: var(--ink); font-weight: 600; text-decoration: none; transition: border-color .2s, background .2s;
}
.social a:hover { border-color: var(--rose); background: var(--blush); }
.btn, button.btn, form button {
  display: inline-flex; align-items: center; justify-content: center; gap: 8px;
  padding: 13px 26px; border-radius: 999px; border: 1px solid var(--rose);
  background: var(--rose); color: #fff; font: 700 1rem var(--sans); text-decoration: none; cursor: pointer;
  transition: background .2s, transform .15s;
}
.btn:hover, form button:hover { background: var(--rose-dk); color: #fff; transform: translateY(-1px); }
.btn.ghost { background: #fff; color: var(--ink); border-color: var(--line); }
.btn.ghost:hover { background: var(--blush); color: var(--rose-dk); }
.btn.quote-btn { background: var(--violet); border-color: var(--violet); }
.btn.quote-btn:hover { background: #6538a3; }
section.hero p:has(.btn) { display: flex; flex-wrap: wrap; justify-content: center; gap: 12px; margin: 0; }
.btn svg, .social svg, form button svg { width: 18px; height: 18px; }

/* ===== Quotes popup ===== */
dialog.modal { border: 0; border-radius: var(--radius); padding: 32px; max-width: 560px; width: 92%; box-shadow: 0 30px 80px rgba(60, 20, 50, .3); background: #fff; color: var(--ink); }
dialog.modal::backdrop { background: rgba(43, 34, 48, .55); }
.modal-title { margin: 0 0 16px; }
.modal-close { position: absolute; top: 12px; right: 14px; width: 38px; height: 38px; border-radius: 50%; border: 0; background: var(--blush); color: var(--rose-dk); font-size: 1.5rem; cursor: pointer; }
.quote-list { list-style: none; padding: 0; margin: 0; display: grid; gap: 14px; }
.quote-list li { border-left: 4px solid var(--rose); background: var(--paper); border-radius: 0 14px 14px 0; padding: 14px 18px; }
.quote-list blockquote { margin: 0; font-family: var(--serif); font-size: 1.15rem; }
.quote-list cite { display: block; margin-top: 6px; color: var(--soft); font-size: .9rem; }

/* ===== About ===== */
.about-block h3 { color: var(--rose); }
.about-block .text { max-width: 70ch; margin: 0; }
.about-nav { border-color: var(--line) !important; background: var(--paper) !important; }

/* ===== Education timeline (education.php) ===== */
.timeline { list-style: none; padding: 0; margin: 0; display: grid; gap: 14px; }
.timeline li { background: #fff; border: 1px solid var(--line); border-left: 4px solid var(--rose); border-radius: 14px; padding: 16px 20px; }
.timeline .year { display: block; font-size: .75rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--violet); margin-bottom: 4px; }
.timeline h3 { margin: 0; }

/* ===== Skills ===== */
.skill { margin: 0 0 20px; }
.skill-head { display: flex; justify-content: space-between; font-weight: 700; margin-bottom: 8px; }
.skill-head span:last-child { color: var(--rose); }
.bar { height: 12px; background: var(--blush); border-radius: 999px; overflow: hidden; }
.bar > div { height: 100%; border-radius: 999px; background: linear-gradient(90deg, var(--rose), var(--violet)); }

/* ===== Contact ===== */
.contact-card { background: var(--paper); border: 1px solid var(--line); border-radius: 14px; padding: 16px 20px; margin: 0 0 22px; }
form { display: grid; gap: 16px; max-width: 560px; }
form label { display: grid; gap: 6px; font-weight: 600; }
form input, form textarea {
  font: 400 1rem var(--sans); color: var(--ink);
  padding: 13px 16px; border: 1px solid var(--line); border-radius: 12px; background: #fff;
  transition: border-color .2s, box-shadow .2s;
}
form input:focus, form textarea:focus { outline: 0; border-color: var(--rose); box-shadow: 0 0 0 4px var(--blush); }
form button { justify-self: start; }
.hp { position: absolute; left: -9999px; }
.note { padding: 12px 16px; border-radius: 12px; margin: 0 0 18px; font-weight: 600; }
.note.ok  { background: #e7f6ec; color: #1f6b3a; }
.note.err { background: #fde8e8; color: #9b1c1c; }
main > section .social { justify-content: flex-start; margin: 24px 0 0; }

/* ===== Footer ===== */
footer { text-align: center; color: var(--soft); font-size: .9rem; padding: 26px 16px 40px; border-top: 1px solid var(--line); }

/* ===== Small screens ===== */
@media (max-width: 600px) {
  main { padding: 22px 14px 50px; }
  header nav a { padding: 8px 13px; font-size: .88rem; }
  section.hero { min-height: auto; }
}
@media (prefers-reduced-motion: reduce) { * { transition: none !important; scroll-behavior: auto !important; } }
</style>
