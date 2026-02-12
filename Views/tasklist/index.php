<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tasklist — App Moderne</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --ink: #0f172a;
      --muted: #64748b;
      --panel: rgba(255, 255, 255, 0.75);
      --stroke: rgba(148, 163, 184, 0.35);
    }
    body {
      background: radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.15), transparent 40%),
                  radial-gradient(circle at 80% 0%, rgba(14, 165, 233, 0.2), transparent 45%),
                  #f8fafc;
      color: var(--ink);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col">
  <header class="max-w-6xl mx-auto px-6 py-10">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Mini App</p>
        <h1 class="text-3xl md:text-5xl font-bold">Tasklist</h1>
        <p class="mt-2 text-slate-600">Un gestionnaire de tâches simple et moderne, pensé pour l’action.</p>
      </div>
      <a
        href="/portfolio/"
        class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Retour au Portfolio
      </a>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-6 pb-16 flex-1 w-full">
    <section class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] items-start">
      <div class="rounded-3xl border border-slate-200/60 bg-white/80 backdrop-blur p-6 shadow-lg">
        <div class="flex flex-wrap items-center justify-between gap-3">
          <div>
            <h2 class="text-xl font-semibold">Mes tâches</h2>
            <p class="text-sm text-slate-500">Ajoute, trie et coche tes tâches au fur et à mesure.</p>
          </div>
          <div class="flex flex-wrap gap-2">
            <button id="btn-auto" class="rounded-full border border-slate-300 px-3 py-1.5 text-sm font-semibold text-slate-700 hover:border-slate-400">Auto</button>
            <button id="btn-sort" class="rounded-full border border-slate-300 px-3 py-1.5 text-sm font-semibold text-slate-700 hover:border-slate-400">Trier A → Z</button>
            <button id="btn-theme" class="rounded-full border border-slate-300 px-3 py-1.5 text-sm font-semibold text-slate-700 hover:border-slate-400">Mode Nuit</button>
          </div>
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
          <input
            id="task-input"
            type="text"
            placeholder="Nouvelle tâche"
            class="flex-1 min-w-[220px] rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <button
            id="btn-add"
            class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800"
          >
            Ajouter
          </button>
        </div>

        <ul id="task-list" class="mt-6 space-y-3"></ul>
      </div>

      <aside class="rounded-3xl border border-slate-200/60 bg-white/80 backdrop-blur p-6 shadow-lg text-center space-y-6">
        <div>
          <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Conseils rapides</p>
          <h3 class="mt-2 text-lg font-semibold">Gagne du temps</h3>
          <p class="mt-2 text-sm text-slate-600">Des astuces simples pour garder le contrôle.</p>
        </div>

        <div class="grid gap-3">
          <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm">
            🧩 Tâches courtes et claires
          </div>
          <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm">
            ⚡ Auto pour pré-remplir
          </div>
          <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm">
            ⏎ Entrée pour ajouter
          </div>
          <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm">
            🔤 Trier pour visualiser
          </div>
        </div>

        <div class="rounded-2xl bg-slate-900 text-white px-4 py-4 text-sm">
          Mini workflow conseillé: écris → trie → coche → nettoie.
        </div>
      </aside>
    </section>
  </main>

  <div class="mt-auto w-full">
    <?php require __DIR__ . '/../partials/tasklist-footer.php'; ?>
  </div>
  <script src="/portfolio/public/assets/js/tasklist.js"></script>
</body>
</html>
