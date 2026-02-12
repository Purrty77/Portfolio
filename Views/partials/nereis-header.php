<?php
$activeClass = 'text-emerald-950 bg-emerald-100/80 border-emerald-200';
$inactiveClass = 'text-slate-700 border-transparent hover:text-emerald-900 hover:bg-emerald-50';
?>
<header class="bg-[#f8f3ef] border-b border-amber-100/70">
  <div class="bg-emerald-950 text-amber-50 text-xs tracking-[0.25em] uppercase text-center py-2">
    A partir de 60€ d'achat • 30% sur la nouvelle collection
  </div>
  <div class="max-w-6xl mx-auto px-6 py-5">
    <div class="flex flex-col gap-4">
      <div class="flex items-center justify-between gap-4">
        <a href="/portfolio/nereis" class="flex items-center gap-3">
          <img src="/portfolio/public/projects/nereis/assets/imgs/logo-nereis.png" alt="Logo Nereis" class="h-10 w-auto">
          <span class="hidden sm:inline text-xs uppercase tracking-[0.4em] text-slate-500">Bijoux marins</span>
        </a>
        <a href="/portfolio" class="hidden md:inline-flex items-center justify-center rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-blue-700">Retour au portfolio</a>
        <div class="hidden lg:flex items-center gap-3">
          <div class="relative">
            <input type="text" placeholder="Recherche" class="w-64 rounded-full border border-slate-200 bg-white/80 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-200">
            <span class="absolute right-4 top-2.5 text-xs text-slate-400">⌕</span>
          </div>
          <div class="flex items-center gap-3 text-slate-600">
            <a href="#" class="rounded-full border border-slate-200 bg-white/70 px-3 py-2 text-xs uppercase tracking-widest">Wishlist</a>
            <a href="#" class="rounded-full border border-slate-200 bg-white/70 px-3 py-2 text-xs uppercase tracking-widest">Compte</a>
            <a href="/portfolio/nereis/panier" class="rounded-full bg-emerald-900 px-4 py-2 text-xs uppercase tracking-widest text-white">Panier</a>
          </div>
        </div>
        <div class="lg:hidden flex items-center gap-2">
          <a href="/portfolio/nereis/panier" class="rounded-full bg-emerald-900 px-3 py-2 text-xs uppercase tracking-widest text-white">Panier</a>
        </div>
      </div>

      <nav class="flex flex-wrap items-center gap-3">
        <a href="/portfolio/nereis" class="px-4 py-2 rounded-full border text-sm font-semibold <?= $nereisPage === 'home' ? $activeClass : $inactiveClass ?>">Accueil</a>
        <a href="/portfolio/nereis/femme" class="px-4 py-2 rounded-full border text-sm font-semibold <?= $nereisPage === 'femme' ? $activeClass : $inactiveClass ?>">Collection Femme</a>
        <a href="/portfolio/nereis/homme" class="px-4 py-2 rounded-full border text-sm font-semibold <?= $nereisPage === 'homme' ? $activeClass : $inactiveClass ?>">Collection Homme</a>
        <a href="/portfolio/nereis/panier" class="px-4 py-2 rounded-full border text-sm font-semibold <?= $nereisPage === 'panier' ? $activeClass : $inactiveClass ?>">Panier</a>
        <span class="ml-auto hidden md:inline-flex items-center gap-2 text-xs uppercase tracking-[0.3em] text-slate-400">
          <span class="h-px w-12 bg-slate-300"></span>
          Atelier côtier
        </span>
      </nav>
    </div>
  </div>
</header>
