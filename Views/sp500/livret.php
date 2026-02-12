<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Livret A vs S&P 500</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: #f8fafc; }
  </style>
</head>
<body class="text-slate-900">
  <?php require __DIR__ . '/../partials/sp500-header.php'; ?>

  <main class="max-w-6xl mx-auto px-6 py-12">
    <section class="space-y-5">
      <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Comparatif</p>
      <h1 class="text-3xl md:text-5xl font-bold">Livret A vs S&amp;P 500</h1>
      <p class="text-lg text-slate-600 max-w-3xl">
        Simulation d’un investissement de 10 000 € sur 20 ans, avec un Livret A et le S&amp;P 500.
      </p>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-2">
      <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
        <div class="flex items-center justify-between">
          <h2 class="text-xl font-semibold">Livret A</h2>
          <span class="text-xs uppercase tracking-[0.2em] text-slate-400">~2,4%/an</span>
        </div>
        <p class="mt-3 text-sm text-slate-600">Rendement sécurisé mais lent, idéal pour l’épargne de précaution.</p>
        <img
          src="/portfolio/public/projects/sp500/assets/img/LivretA.png"
          alt="Gains estimés Livret A"
          class="mt-5 rounded-xl border border-slate-200"
        />
      </div>
      <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
        <div class="flex items-center justify-between">
          <h2 class="text-xl font-semibold">S&amp;P 500</h2>
          <span class="text-xs uppercase tracking-[0.2em] text-slate-400">~8%/an</span>
        </div>
        <p class="mt-3 text-sm text-slate-600">Potentiel de rendement plus élevé, mais volatilité à court terme.</p>
        <img
          src="/portfolio/public/projects/sp500/assets/img/sp500.png"
          alt="Gains estimés S&P 500"
          class="mt-5 rounded-xl border border-slate-200"
        />
      </div>
    </section>

    <section class="mt-8">
      <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-900">
        Ces graphiques sont à but pédagogique et basés sur des estimations historiques. Les performances passées ne
        garantissent pas les performances futures.
      </div>
    </section>

    <section class="mt-8">
      <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-100">
        <h2 class="text-2xl font-semibold">Résumé des performances sur 20 ans</h2>
        <div class="mt-4 space-y-3 text-sm text-slate-600">
          <p>
            Avec 10 000 € sur un Livret A à 2,4%, le capital atteindrait environ 16 100 € après 20 ans.
            C’est garanti, mais peu dynamique.
          </p>
          <p>
            Le même investissement sur le S&amp;P 500, à 8% de moyenne, pourrait atteindre environ 46 600 €,
            grâce aux intérêts composés.
          </p>
          <p>
            L’investissement en bourse reste risqué, mais l’historique montre une progression solide sur le long terme.
            Tout dépend de votre horizon et de vos objectifs.
          </p>
          <p>
            L’idée n’est pas d’opposer sécurité et rendement, mais de comprendre comment combiner les deux.
          </p>
        </div>
      </div>
    </section>
  </main>

  <?php require __DIR__ . '/../partials/sp500-footer.php'; ?>
</body>
</html>
