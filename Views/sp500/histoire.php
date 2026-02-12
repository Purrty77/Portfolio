<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>S&P 500 — Historique</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: #f8fafc; }
  </style>
</head>
<body class="text-slate-900">
  <?php require __DIR__ . '/../partials/sp500-header.php'; ?>

  <main class="max-w-6xl mx-auto px-6 py-12">
    <section class="space-y-4">
      <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Historique</p>
      <h1 class="text-3xl md:text-5xl font-bold">Le S&amp;P 500 : historique, performances et tendances</h1>
      <p class="text-lg text-slate-600">
        Un aperçu clair de l’origine, de la composition et des grandes étapes de l’indice américain le plus suivi.
      </p>
    </section>

    <section class="mt-10 grid gap-8 lg:grid-cols-2 items-start">
      <div class="space-y-6 text-slate-700 leading-relaxed">
        <div>
          <h2 class="text-2xl font-semibold text-slate-900">Présentation &amp; historique</h2>
          <p class="mt-2">
            Le S&amp;P 500 regroupe environ 500 grandes entreprises américaines cotées sur le NYSE et le NASDAQ. Il représente
            plus de 80% de la capitalisation boursière totale des sociétés cotées aux États‑Unis, soit une valorisation
            supérieure à 49 800 milliards de dollars au 31 mars 2025.
          </p>
          <p class="mt-2">
            L’indice a été officiellement lancé le 4 mars 1957, après des versions antérieures comme le S&amp;P 90 des années
            1920. Il est publié et géré par S&amp;P Dow Jones Indices, une division de S&amp;P Global.
          </p>
        </div>

        <div>
          <h2 class="text-2xl font-semibold text-slate-900">Méthodologie &amp; composition</h2>
          <p class="mt-2">
            L’indice est pondéré selon la capitalisation flottante. En 2025, les 10 sociétés dominantes représentent
            environ 37–38% de l’indice.
          </p>
          <p class="mt-2">
            Le secteur technologique pèse près de 33%, suivi par la finance (~14%) et les services de communication (~10%).
          </p>
        </div>

        <div>
          <h2 class="text-2xl font-semibold text-slate-900">Grandes étapes</h2>
          <p class="mt-2">
            Seuils symboliques: 500 (1995), 1 000 (1998), 2 000 (2014), 3 000 (2019), 5 000 (2024) et 6 000 (2024).
            Creux majeur en 2009 autour de 676 points après la crise financière.
          </p>
          <p class="mt-2">
            Rendement historique moyen > 10% brut/an (≈ 6,7% après inflation).
          </p>
        </div>
      </div>

      <div class="space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-4">
          <h2 class="text-lg font-semibold text-slate-900">Graphique historique</h2>
          <p class="text-xs text-slate-500">Source: FRED (chargement dynamique).</p>
          <div class="mt-3 rounded-xl overflow-hidden border border-slate-200">
            <iframe
              src="https://fred.stlouisfed.org/graph/graph-landing.php?g=1KWoe&width=670&height=475"
              scrolling="no"
              frameborder="0"
              style="overflow: hidden; width: 100%; height: 320px;"
              allowTransparency="true"
              loading="lazy"
            ></iframe>
          </div>
          <script
            src="https://fred.stlouisfed.org/assets/research/fred-graph-react/build/embed.min.js"
            type="text/javascript"
          ></script>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 text-sm text-slate-700 space-y-2">
          <h2 class="text-xl font-semibold text-slate-900">Rendement &amp; risques</h2>
          <p>ETF faciles d’accès, tracking error faible.</p>
          <p>Valorisation élevée possible, concentration sur les \"Magnificent Seven\".</p>
          <p>Repère majeur de la croissance américaine sur le long terme.</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 text-sm text-slate-700 space-y-2">
          <h2 class="text-xl font-semibold text-slate-900">Synthèse</h2>
          <p>Très diversifié — mais forte concentration sur quelques mégacaps.</p>
          <p>Rendement historique élevé — mais volatilité liée aux cycles économiques.</p>
          <p>Accessible via ETF — mais valorisation parfois élevée.</p>
          <p>Reflète 80% du marché US — mais sensible aux crises macro‑économiques.</p>
        </div>
      </div>
    </section>
  </main>

  <?php require __DIR__ . '/../partials/sp500-footer.php'; ?>
</body>
</html>
