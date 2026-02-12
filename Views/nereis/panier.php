<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Nereis Panier') ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#f8f3ef] text-slate-900">
  <?php require __DIR__ . '/../partials/nereis-header.php'; ?>

  <main class="max-w-6xl mx-auto px-6">
    <section class="mt-10">
      <h1 class="text-3xl font-semibold text-emerald-950">Votre panier</h1>
      <p class="mt-2 text-slate-600">Finalisez votre sélection avant qu'elle ne s'évapore.</p>
    </section>

    <section class="mt-8 grid gap-8 lg:grid-cols-[1.3fr_0.7fr]">
      <div class="space-y-4">
        <?php
        $items = [
            ['img' => 'main/bijoux1.jpg', 'name' => 'Collier Lune', 'detail' => 'Plaqué or • 45 cm', 'price' => '89€'],
            ['img' => 'main/femme3.jpg', 'name' => 'Bague Marée', 'detail' => 'Taille 54 • Or rose', 'price' => '46€'],
            ['img' => 'main/homme2.jpg', 'name' => 'Chaîne Atlas', 'detail' => 'Acier inox • 55 cm', 'price' => '92€'],
        ];
        foreach ($items as $item): ?>
          <article class="bg-white rounded-2xl border border-amber-100/60 p-4 flex flex-col sm:flex-row gap-4">
            <img src="/portfolio/public/projects/nereis/assets/imgs/<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="h-28 w-28 rounded-xl object-cover">
            <div class="flex-1">
              <h3 class="text-sm font-semibold text-emerald-950"><?= htmlspecialchars($item['name']) ?></h3>
              <p class="text-xs text-slate-500 mt-1"><?= htmlspecialchars($item['detail']) ?></p>
              <div class="mt-4 flex items-center gap-3">
                <button class="h-8 w-8 rounded-full border border-emerald-200 text-emerald-900">-</button>
                <span class="text-sm font-semibold">1</span>
                <button class="h-8 w-8 rounded-full border border-emerald-200 text-emerald-900">+</button>
                <span class="ml-auto text-sm font-semibold text-emerald-800"><?= $item['price'] ?></span>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <aside class="bg-white rounded-2xl border border-amber-100/60 p-6 h-fit">
        <h2 class="text-lg font-semibold text-emerald-950">Résumé</h2>
        <div class="mt-4 space-y-2 text-sm text-slate-600">
          <div class="flex justify-between">
            <span>Sous-total</span>
            <span>227€</span>
          </div>
          <div class="flex justify-between">
            <span>Livraison</span>
            <span>Offerte</span>
          </div>
          <div class="flex justify-between font-semibold text-emerald-950">
            <span>Total</span>
            <span>227€</span>
          </div>
        </div>
        <button class="mt-6 w-full rounded-full bg-emerald-900 text-white py-3 text-sm uppercase tracking-widest">Valider la commande</button>
        <p class="mt-4 text-xs text-slate-500">Paiement sécurisé • Livraison offerte dès 60€</p>
      </aside>
    </section>

    <section class="mt-10 grid gap-4 md:grid-cols-4 text-center">
      <?php
      $services = [
          ['img' => 'truck.png', 'label' => 'Livraison 48h'],
          ['img' => 'calendar-return30.png', 'label' => 'Retours 30 jours'],
          ['img' => 'lock.png', 'label' => 'Paiement sécurisé'],
          ['img' => 'click&collect.png', 'label' => 'Click & Collect'],
      ];
      foreach ($services as $service): ?>
        <div class="bg-white rounded-2xl border border-amber-100/60 p-4 flex flex-col items-center gap-3">
          <img src="/portfolio/public/projects/nereis/assets/imgs/panier-banderole/<?= $service['img'] ?>" alt="<?= htmlspecialchars($service['label']) ?>" class="h-8 w-auto">
          <span class="text-xs uppercase tracking-[0.3em] text-slate-500"><?= htmlspecialchars($service['label']) ?></span>
        </div>
      <?php endforeach; ?>
    </section>
  </main>

  <?php require __DIR__ . '/../partials/nereis-footer.php'; ?>
</body>
</html>
