<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pourquoi le S&amp;P 500</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: #f8fafc; }
  </style>
</head>
<body class="text-slate-900">
  <?php require __DIR__ . '/../partials/sp500-header.php'; ?>

  <main class="max-w-6xl mx-auto px-6 py-12">
    <section class="space-y-5">
      <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Analyse</p>
      <h1 class="text-3xl md:text-5xl font-bold">Pourquoi le S&amp;P 500 plutôt que des indices européens ?</h1>
      <p class="text-lg text-slate-600 max-w-3xl">
        Comparaison entre le S&amp;P 500 et des indices européens comme le CAC 40 ou l’Euro Stoxx 50.
      </p>
    </section>

    <section class="mt-6">
      <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-900">
        Ces chiffres ne tiennent pas compte de l’inflation ni des éventuels frais liés aux produits d’investissement.
      </div>
    </section>

    <section class="mt-10 grid gap-8 lg:grid-cols-[1.1fr_0.9fr] items-start">
      <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 space-y-4 text-sm text-slate-600">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Constat</p>
        <p>
          Beaucoup d’épargnants se tournent vers des indices locaux comme le <strong class="text-slate-900">CAC 40</strong>
          ou l’<strong class="text-slate-900">Euro Stoxx 50</strong>. Pourtant, le S&amp;P 500 offre une diversification
          plus large et une exposition aux géants technologiques.
        </p>
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Atout majeur</p>
        <p>
          Le S&amp;P 500 représente plus de 80% de la capitalisation boursière américaine, avec des entreprises
          leaders mondiaux comme Apple, Microsoft, Amazon ou Nvidia.
        </p>
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Limites européennes</p>
        <p>
          Les indices européens sont plus concentrés sur certains secteurs (luxe, finance, énergie), ce qui
          limite leur capacité à profiter des vagues d’innovation.
        </p>
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Performance long terme</p>
        <p>
          Sur 20 ans, le S&amp;P 500 a historiquement offert un rendement moyen d’environ 8%/an, contre 4–5% pour
          le CAC 40 ou l’Euro Stoxx 50.
        </p>
        <div class="pt-2 space-y-3">
          <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Accessibilité</p>
          <p>
            Un autre avantage du S&amp;P 500 est la richesse des produits qui y sont adossés (ETF simples, liquides et peu
            coûteux). Les marchés américains bénéficient aussi d’une culture entrepreneuriale forte qui favorise
            l’innovation et la croissance.
          </p>
          <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Conclusion</p>
          <p>
            En résumé, combiner une diversification européenne avec l’exposition au S&amp;P 500 permet souvent un meilleur
            équilibre entre stabilité et potentiel de croissance.
          </p>
        </div>
      </div>
      <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
        <img
          src="/portfolio/public/projects/sp500/assets/img/comparaison.png"
          alt="Comparatif des performances"
          class="w-full rounded-xl border border-slate-200"
        />
        <p class="mt-3 text-xs text-slate-500">Comparatif des rendements annuels moyens sur 20 ans (estimation).</p>
      </div>
    </section>

    
  </main>

  <?php require __DIR__ . '/../partials/sp500-footer.php'; ?>
</body>
</html>
