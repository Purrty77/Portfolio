<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($title ?? 'Portfolio') ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --ink: #0f172a;
      --soft: #f8fafc;
      --accent: #2563eb;
      --accent-2: #0ea5e9;
      --glow: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.18), transparent 35%),
              radial-gradient(circle at 80% 10%, rgba(14, 165, 233, 0.16), transparent 35%),
              radial-gradient(circle at 60% 80%, rgba(15, 23, 42, 0.12), transparent 40%);
    }
    body {
      background: var(--soft);
      color: var(--ink);
    }
    .hero-bg {
      background: var(--glow);
    }
  </style>
</head>
<body class="min-h-screen">
  <header class="hero-bg">
    <div class="max-w-6xl mx-auto px-6 py-16">
      <div class="flex flex-col gap-10">
        <div class="flex items-center gap-3 text-sm font-semibold text-slate-600 uppercase tracking-[0.3em]">
          Portfolio
          <span class="h-px w-16 bg-slate-300"></span>
        </div>
        <div class="grid lg:grid-cols-[1.2fr_0.8fr] gap-10 items-center">
          <div>
            <h1 class="text-4xl md:text-6xl font-bold leading-tight text-slate-900">Elie Ayadi</h1>
            <p class="mt-5 text-lg text-slate-600 max-w-2xl">
              Développeur web full stack passionné par la création d'interfaces modernes et performantes.
              Voici une sélection de mes projets récents et expérimentations.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
              <a href="mailto:elie.ayadi@icloud.com" class="inline-flex items-center justify-center rounded-full bg-slate-900 text-white px-5 py-2 text-sm font-semibold hover:bg-slate-800">Me contacter</a>
              <a href="/portfolio/resume" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-700 hover:border-slate-400">Voir mon CV</a>
              <a href="https://github.com/Purrty77" target="_blank" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-700 hover:border-slate-400">GitHub</a>
              <a href="https://www.linkedin.com/in/elie-ayadi-820438375/" target="_blank" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-700 hover:border-slate-400">LinkedIn</a>
            </div>
          </div>
          <div class="bg-white/70 backdrop-blur rounded-3xl p-6 shadow-lg border border-white">
            <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Highlights</p>
            <ul class="mt-5 space-y-3 text-slate-700">
              <li class="flex items-start gap-3">
                <span class="mt-1 h-2 w-2 rounded-full bg-blue-500"></span>
                UI modernes, focus performance et UX.
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 h-2 w-2 rounded-full bg-sky-400"></span>
                Projets pédagogiques et e‑commerce.
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 h-2 w-2 rounded-full bg-slate-400"></span>
                Intégrations front-end propres et maintenables.
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-6 pb-20">
    <section class="mt-10">
      <div class="flex items-center justify-between flex-wrap gap-4">
        <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">Mes derniers projets</h2>
        <p class="text-slate-500 text-sm">Accès direct aux versions originales.</p>
      </div>

      <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <article class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col">
          <img src="/portfolio/public/assets/img/Screenshot_sp.png" alt="Mini Wiki S&P 500" class="h-44 w-full object-cover">
          <div class="p-5 flex flex-col gap-4 flex-1">
            <div>
              <h3 class="text-lg font-semibold text-slate-900">Mini Wiki S&amp;P 500</h3>
              <p class="text-sm text-slate-600 mt-2">Un site pédagogique pour comprendre le S&amp;P 500, ses bases et son fonctionnement.</p>
            </div>
            <div class="mt-auto flex items-center justify-between">
              <span class="text-xs uppercase tracking-[0.2em] text-slate-400">HTML • CSS • JS</span>
              <a href="/portfolio/sp500" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Voir</a>
            </div>
          </div>
        </article>

        <article class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col">
          <img src="/portfolio/public/assets/img/Screenshot-nrs.png" alt="E‑Commerce Bijoux" class="h-44 w-full object-cover">
          <div class="p-5 flex flex-col gap-4 flex-1">
            <div>
              <h3 class="text-lg font-semibold text-slate-900">Nereis — E‑commerce Bijoux</h3>
              <p class="text-sm text-slate-600 mt-2">Univers marin raffiné, storytelling visuel et navigation responsive.</p>
            </div>
            <div class="mt-auto flex items-center justify-between">
              <span class="text-xs uppercase tracking-[0.2em] text-slate-400">HTML • CSS • JS</span>
              <a href="/portfolio/nereis" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Voir</a>
            </div>
          </div>
        </article>

        <article class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col">
          <img src="/portfolio/public/assets/img/Screenshot-tasklist.png" alt="Liste de tâches" class="h-44 w-full object-cover">
          <div class="p-5 flex flex-col gap-4 flex-1">
            <div>
              <h3 class="text-lg font-semibold text-slate-900">TaskList</h3>
              <p class="text-sm text-slate-600 mt-2">Application simple pour ajouter, compléter et supprimer des tâches.</p>
            </div>
            <div class="mt-auto flex items-center justify-between">
              <span class="text-xs uppercase tracking-[0.2em] text-slate-400">HTML • JS</span>
              <a href="/portfolio/tasklist" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Voir</a>
            </div>
          </div>
        </article>
      </div>
    </section>

    <section class="mt-16 grid lg:grid-cols-[1.1fr_0.9fr] gap-8">
      <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
        <h3 class="text-xl font-semibold text-slate-900">À propos</h3>
        <p class="text-slate-600 mt-4 leading-relaxed">
          Curieux et motivé, je transforme des idées en projets concrets et modernes. J’aime concevoir des interfaces
          claires et efficaces, avec un souci du détail et de la performance. Chaque projet est une occasion d’apprendre
          et d’expérimenter de nouvelles approches.
        </p>
      </div>
      <div class="bg-slate-900 rounded-3xl p-8 text-white shadow-sm">
        <h3 class="text-xl font-semibold">Envie de collaborer ?</h3>
        <p class="mt-3 text-slate-200">Je suis disponible pour des projets front-end, full stack ou design d'interfaces.</p>
        <div class="mt-6 flex flex-wrap gap-3">
          <a href="mailto:elie.ayadi@icloud.com" class="inline-flex items-center justify-center rounded-full bg-white text-slate-900 px-5 py-2 text-sm font-semibold hover:bg-slate-100">Écrire un mail</a>
          <a href="https://www.linkedin.com/in/elie-ayadi-820438375/" target="_blank" class="inline-flex items-center justify-center rounded-full border border-white/30 px-5 py-2 text-sm font-semibold text-white hover:border-white">LinkedIn</a>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
