<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>S&P 500 — Accueil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: #f8fafc; }
  </style>
</head>
<body class="text-slate-900">
  <?php require __DIR__ . '/../partials/sp500-header.php'; ?>

  <main class="max-w-6xl mx-auto px-6 py-12">
    <section class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] items-center">
      <div>
        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">S&P 500</p>
        <h1 class="mt-3 text-3xl md:text-5xl font-bold">Investir intelligemment avec le S&amp;P 500</h1>
        <p class="mt-5 text-lg text-slate-600">
          Le S&amp;P 500 regroupe les 500 plus grandes entreprises américaines. C’est un moyen simple de
          profiter de la croissance de l’économie américaine sans choisir des actions individuellement.
        </p>
        <div class="mt-8 grid gap-4 sm:grid-cols-2">
          <div class="rounded-2xl bg-white p-5 shadow-sm border border-slate-100">
            <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Principe</h3>
            <p class="mt-3 text-sm text-slate-600">Indice pondéré par capitalisation, mis à jour en continu.</p>
          </div>
          <div class="rounded-2xl bg-white p-5 shadow-sm border border-slate-100">
            <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Accès</h3>
            <p class="mt-3 text-sm text-slate-600">Via ETF accessibles en PEA ou compte‑titres.</p>
          </div>
        </div>
      </div>
      <div class="rounded-3xl bg-white shadow-sm border border-slate-100 p-6">
        <h2 class="text-lg font-semibold text-slate-900">Cours du S&amp;P 500 (5 dernières années)</h2>
        <p class="mt-2 text-sm text-slate-500">Source: FRED, mise à jour automatique.</p>
        <div class="mt-4 rounded-2xl overflow-hidden border border-slate-200">
          <iframe
            src="https://fred.stlouisfed.org/graph/graph-landing.php?g=1KWoe&width=670&height=475"
            scrolling="no"
            frameborder="0"
            style="overflow: hidden; width: 100%; height: 360px;"
            allowTransparency="true"
            loading="lazy"
          ></iframe>
        </div>
        <script
          src="https://fred.stlouisfed.org/assets/research/fred-graph-react/build/embed.min.js"
          type="text/javascript"
        ></script>
      </div>
    </section>

    <section class="mt-14 grid gap-6 lg:grid-cols-3">
      <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
        <h3 class="text-lg font-semibold">Le S&amp;P 500, c’est quoi ?</h3>
        <p class="mt-3 text-sm text-slate-600">
          Un indice boursier américain qui suit les 500 plus grandes entreprises cotées aux États‑Unis,
          comme Apple, Microsoft ou Coca‑Cola.
        </p>
      </div>
      <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
        <h3 class="text-lg font-semibold">Comment ça fonctionne ?</h3>
        <p class="mt-3 text-sm text-slate-600">
          Pondéré par capitalisation: les plus grandes sociétés ont le plus d’impact sur l’indice.
          On investit via des ETF qui répliquent sa performance.
        </p>
      </div>
      <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
        <h3 class="text-lg font-semibold">Pourquoi c’est intéressant ?</h3>
        <ul class="mt-3 text-sm text-slate-600 space-y-2">
          <li>Rendement historique moyen ~7 à 10%/an (hors inflation).</li>
          <li>Diversification automatique sur 500 entreprises.</li>
          <li>Placement passif, simple à suivre.</li>
          <li>Accessible depuis la France via ETF.</li>
        </ul>
      </div>
    </section>

    <section class="mt-16">
      <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-100">
        <h2 class="text-2xl font-semibold">Questions fréquentes</h2>
        <div class="mt-6 grid gap-4">
          <div class="rounded-2xl border border-slate-200 p-5">
            <h3 class="font-semibold">Est-ce risqué d'investir dans le S&amp;P 500 ?</h3>
            <p class="mt-2 text-sm text-slate-600">
              Oui, comme tout investissement en bourse, il y a des variations à court terme. Sur le long terme,
              l’indice a historiquement progressé malgré les crises.
            </p>
          </div>
          <div class="rounded-2xl border border-slate-200 p-5">
            <h3 class="font-semibold">De combien d'argent ai-je besoin pour commencer ?</h3>
            <p class="mt-2 text-sm text-slate-600">
              Certains ETF sont accessibles dès quelques dizaines d’euros. Le plus important est d’investir régulièrement.
            </p>
          </div>
          <div class="rounded-2xl border border-slate-200 p-5">
            <h3 class="font-semibold">Est-ce que je peux perdre tout mon argent ?</h3>
            <p class="mt-2 text-sm text-slate-600">
              C’est très peu probable, car l’indice regroupe 500 entreprises solides. Un effondrement total serait un
              scénario extrême.
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php require __DIR__ . '/../partials/sp500-footer.php'; ?>
</body>
</html>
