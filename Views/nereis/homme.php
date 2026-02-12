<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Nereis Homme') ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#f8f3ef] text-slate-900">
  <?php require __DIR__ . '/../partials/nereis-header.php'; ?>

  <main class="max-w-6xl mx-auto px-6">
    <section class="mt-10 grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
      <div class="rounded-3xl overflow-hidden order-2 lg:order-1">
        <img src="/portfolio/public/projects/nereis/assets/imgs/homme1%20(1).jpg" alt="Nereis homme" class="h-full w-full object-cover">
      </div>
      <div class="bg-white/80 rounded-3xl border border-amber-100/60 p-8 order-1 lg:order-2">
        <p class="text-xs uppercase tracking-[0.4em] text-slate-400">Collection Homme</p>
        <h1 class="mt-3 text-3xl font-semibold text-emerald-950">Matières océanes</h1>
        <p class="mt-4 text-slate-600 leading-relaxed">
          Des lignes épurées, des matières brutes, un éclat discret. La collection homme assume des bijoux affirmés et
          intemporels.
        </p>
        <div class="mt-6 flex flex-wrap gap-3">
          <span class="text-xs uppercase tracking-[0.3em] text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Acier inox</span>
          <span class="text-xs uppercase tracking-[0.3em] text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Édition marine</span>
          <span class="text-xs uppercase tracking-[0.3em] text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Nouveautés</span>
        </div>
      </div>
    </section>

    <section class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php
      $items = [
          ['img' => 'homme1.jpg', 'name' => 'Bracelet Altair', 'price' => '78€'],
          ['img' => 'homme2.jpg', 'name' => 'Chaîne Atlas', 'price' => '92€'],
          ['img' => 'homme3.jpg', 'name' => 'Bague Neptune', 'price' => '55€'],
          ['img' => 'homme4.jpg', 'name' => 'Bracelet Selene', 'price' => '69€'],
          ['img' => 'homme5.jpg', 'name' => 'Pendentif Krios', 'price' => '84€'],
          ['img' => 'homme6.jpg', 'name' => 'Chaîne Triton', 'price' => '99€'],
      ];
      foreach ($items as $item): ?>
        <article class="bg-white rounded-2xl border border-amber-100/60 overflow-hidden shadow-sm">
          <img src="/portfolio/public/projects/nereis/assets/imgs/main/<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="h-52 w-full object-cover">
          <div class="p-4">
            <h3 class="text-sm font-semibold text-emerald-950"><?= htmlspecialchars($item['name']) ?></h3>
            <p class="text-xs text-slate-500 mt-1">Acier poli • Finition mate</p>
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
