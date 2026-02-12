<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Nereis Femme') ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#f8f3ef] text-slate-900">
  <?php require __DIR__ . '/../partials/nereis-header.php'; ?>

  <main class="max-w-6xl mx-auto px-6">
    <section class="mt-10 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
      <div class="bg-white/80 rounded-3xl border border-amber-100/60 p-8">
        <p class="text-xs uppercase tracking-[0.4em] text-slate-400">Collection Femme</p>
        <h1 class="mt-3 text-3xl font-semibold text-emerald-950">Reflets nacrés</h1>
        <p class="mt-4 text-slate-600 leading-relaxed">
          Des pièces délicates pour magnifier les silhouettes. Perles fines, dorures et formes organiques inspirées des
          marées.
        </p>
        <div class="mt-6 flex flex-wrap gap-3">
          <span class="text-xs uppercase tracking-[0.3em] text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Nouveautés</span>
          <span class="text-xs uppercase tracking-[0.3em] text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Best-sellers</span>
          <span class="text-xs uppercase tracking-[0.3em] text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Édition limitée</span>
        </div>
      </div>
      <div class="rounded-3xl overflow-hidden">
        <img src="/portfolio/public/projects/nereis/assets/imgs/main/femme7.jpg" alt="Nereis femme" class="h-full w-full object-cover">
      </div>
    </section>

    <section class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php
      $items = [
          ['img' => 'femme1.jpg', 'name' => 'Pendentif Orée', 'price' => '72€'],
          ['img' => 'femme2.jpg', 'name' => 'Collier Elara', 'price' => '85€'],
          ['img' => 'femme3.jpg', 'name' => 'Bague Marée', 'price' => '46€'],
          ['img' => 'femme5.jpg', 'name' => 'Boucles Estelle', 'price' => '39€'],
          ['img' => 'femme8.jpg', 'name' => 'Bracelet Sel', 'price' => '52€'],
          ['img' => 'femme9.jpg', 'name' => 'Chaîne Iris', 'price' => '64€'],
      ];
      foreach ($items as $item): ?>
        <article class="bg-white rounded-2xl border border-amber-100/60 overflow-hidden shadow-sm">
          <img src="/portfolio/public/projects/nereis/assets/imgs/main/<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="h-52 w-full object-cover">
          <div class="p-4">
            <h3 class="text-sm font-semibold text-emerald-950"><?= htmlspecialchars($item['name']) ?></h3>
            <p class="text-xs text-slate-500 mt-1">Perles fines • Plaqué or</p>
            <div class="mt-4 flex items-center justify-between">
              <span class="text-sm font-semibold text-emerald-800"><?= $item['price'] ?></span>
              <button class="text-xs uppercase tracking-widest text-emerald-900 border border-emerald-200 rounded-full px-3 py-1">Ajouter</button>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </section>
  </main>

  <?php require __DIR__ . '/../partials/nereis-footer.php'; ?>
</body>
</html>
