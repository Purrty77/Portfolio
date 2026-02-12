<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Nereis') ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --sand: #f8f3ef;
      --deep: #0b2f2a;
      --sea: #0f766e;
      --mist: #e7ecea;
    }
    body {
      background: var(--sand);
      color: #0f172a;
    }
    .hero-overlay {
      background: linear-gradient(120deg, rgba(15, 118, 110, 0.75), rgba(15, 23, 42, 0.2));
    }
  </style>
</head>
<body class="min-h-screen">
  <?php require __DIR__ . '/../partials/nereis-header.php'; ?>

  <main class="max-w-6xl mx-auto px-6">
    <section class="mt-10 rounded-3xl overflow-hidden relative">
      <img src="/portfolio/public/projects/nereis/assets/imgs/fond.png" alt="Bijoux Nereis" class="w-full h-[420px] object-cover">
      <div class="absolute inset-0 hero-overlay"></div>
      <div class="absolute inset-0 flex flex-col justify-center px-10 md:px-16 text-white">
        <p class="text-xs uppercase tracking-[0.4em] text-amber-100/80">Collection 2026</p>
        <h1 class="mt-3 text-3xl md:text-5xl font-semibold">Lumières marines &amp; éclats dorés</h1>
        <p class="mt-4 max-w-xl text-amber-50/90">Des pièces délicates pensées comme des talismans. Chaque bijou raconte un instant précieux, inspiré par l'océan.</p>
        <div class="mt-6 flex flex-wrap gap-4">
          <a href="/portfolio/nereis/femme" class="rounded-full bg-white text-emerald-900 px-5 py-2 text-sm font-semibold">Découvrir Femme</a>
          <a href="/portfolio/nereis/homme" class="rounded-full border border-white/60 text-white px-5 py-2 text-sm font-semibold">Découvrir Homme</a>
        </div>
      </div>
    </section>

    <section class="mt-12 grid gap-6 lg:grid-cols-3">
      <article class="bg-white/80 rounded-2xl shadow-sm overflow-hidden border border-amber-100/60">
        <img src="/portfolio/public/projects/nereis/assets/imgs/petit-menu/femme5.jpg" alt="Collection femme" class="h-44 w-full object-cover">
        <div class="p-5">
          <h3 class="text-lg font-semibold text-emerald-950">Éclats pour elle</h3>
          <p class="text-sm text-slate-600 mt-2">Bagues fines, perles nacrées et formes organiques.</p>
          <a href="/portfolio/nereis/femme" class="mt-4 inline-flex text-sm font-semibold text-emerald-800">Voir la collection</a>
        </div>
      </article>
      <article class="bg-white/80 rounded-2xl shadow-sm overflow-hidden border border-amber-100/60">
        <img src="/portfolio/public/projects/nereis/assets/imgs/petit-menu/homme2.jpg" alt="Collection homme" class="h-44 w-full object-cover">
        <div class="p-5">
          <h3 class="text-lg font-semibold text-emerald-950">Reflets pour lui</h3>
          <p class="text-sm text-slate-600 mt-2">Chaînes en acier poli, styles audacieux et élégants.</p>
          <a href="/portfolio/nereis/homme" class="mt-4 inline-flex text-sm font-semibold text-emerald-800">Voir la collection</a>
        </div>
      </article>
      <article class="bg-white/80 rounded-2xl shadow-sm overflow-hidden border border-amber-100/60">
        <img src="/portfolio/public/projects/nereis/assets/imgs/petit-menu/hommesetfemmes.jpg" alt="Collections mixtes" class="h-44 w-full object-cover">
        <div class="p-5">
          <h3 class="text-lg font-semibold text-emerald-950">Pièces signature</h3>
          <p class="text-sm text-slate-600 mt-2">Des créations unisexes pour sublimer chaque tenue.</p>
          <a href="/portfolio/nereis" class="mt-4 inline-flex text-sm font-semibold text-emerald-800">Explorer</a>
        </div>
      </article>
    </section>

    <section class="mt-16">
      <div class="flex items-center justify-between flex-wrap gap-4">
        <h2 class="text-2xl font-semibold text-emerald-950">Nos coups de coeur</h2>
        <span class="text-xs uppercase tracking-[0.4em] text-slate-400">Nereis edit</span>
      </div>
      <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <?php
        $featured = [
            ['img' => 'main/bijoux1.jpg', 'name' => 'Collier Lune', 'price' => '89€'],
            ['img' => 'main/bijoux2.jpg', 'name' => 'Bague Selene', 'price' => '54€'],
            ['img' => 'main/bijoux3.jpg', 'name' => 'Bracelet Halia', 'price' => '68€'],
            ['img' => 'femme4.jpg', 'name' => 'Boucles Nacre', 'price' => '42€'],
        ];
        foreach ($featured as $item): ?>
          <article class="bg-white rounded-2xl border border-amber-100/60 overflow-hidden shadow-sm">
            <img src="/portfolio/public/projects/nereis/assets/imgs/<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="h-44 w-full object-cover">
            <div class="p-4">
              <h3 class="text-sm font-semibold text-emerald-950"><?= htmlspecialchars($item['name']) ?></h3>
              <p class="text-xs text-slate-500 mt-1">Plaqué or • Fait main</p>
              <div class="mt-4 flex items-center justify-between">
                <span class="text-sm font-semibold text-emerald-800"><?= $item['price'] ?></span>
                <button class="text-xs uppercase tracking-widest text-emerald-900 border border-emerald-200 rounded-full px-3 py-1">Ajouter</button>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="mt-16 bg-white/80 rounded-3xl border border-amber-100/60 p-8 grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
      <div>
        <h3 class="text-xl font-semibold text-emerald-950">L'artisanat Nereis</h3>
        <p class="mt-3 text-slate-600 leading-relaxed">
          Chaque pièce est imaginée dans notre atelier côtier. Nous mêlons textures minérales, touches d'or et
          silhouettes organiques pour créer des bijoux durables, au charme discret.
        </p>
        <div class="mt-6 flex flex-wrap gap-3">
          <span class="text-xs uppercase tracking-[0.3em] text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Fait main</span>
          <span class="text-xs uppercase tracking-[0.3em] text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Matériaux nobles</span>
          <span class="text-xs uppercase tracking-[0.3em] text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Livraison rapide</span>
        </div>
      </div>
      <div class="grid gap-4">
        <img src="/portfolio/public/projects/nereis/assets/imgs/carousel/carou1.png" alt="Atelier" class="rounded-2xl object-cover h-40 w-full">
        <img src="/portfolio/public/projects/nereis/assets/imgs/carousel/carou2.png" alt="Atelier" class="rounded-2xl object-cover h-40 w-full">
      </div>
    </section>
  </main>

  <?php require __DIR__ . '/../partials/nereis-footer.php'; ?>
</body>
</html>
