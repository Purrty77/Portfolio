<?php
  $currentAction = $_GET['action'] ?? 'index';
?>
<header class="bg-white text-slate-900 border-b border-slate-200">
  <div class="max-w-6xl mx-auto px-6 py-6">
    <div class="flex flex-col gap-4">
      <div class="flex flex-wrap items-center justify-between gap-4">
        <a href="/portfolio/sp500" class="flex items-center gap-3">
          <img
            src="/portfolio/public/projects/sp500/assets/img/Logo.png"
            alt="Logo S&P 500"
            class="h-10 md:h-12 w-auto"
          />
          <div class="text-xs uppercase tracking-[0.25em] text-slate-500">Mini Guide</div>
        </a>
        <nav class="flex flex-wrap items-center gap-3 text-sm">
          <a
            class="inline-flex items-center rounded-full border px-3 py-1.5 font-semibold transition <?= $currentAction === 'histoire' ? 'border-slate-900 bg-slate-900 text-white' : 'border-slate-300 text-slate-700 hover:border-slate-400 hover:text-slate-900' ?>"
            href="/portfolio/sp500/histoire"
          >Histoire</a>
          <a
            class="inline-flex items-center rounded-full border px-3 py-1.5 font-semibold transition <?= $currentAction === 'livret' ? 'border-slate-900 bg-slate-900 text-white' : 'border-slate-300 text-slate-700 hover:border-slate-400 hover:text-slate-900' ?>"
            href="/portfolio/sp500/livret"
          >Livret A vs S&amp;P 500</a>
          <a
            class="inline-flex items-center rounded-full border px-3 py-1.5 font-semibold transition <?= $currentAction === 'autres' ? 'border-slate-900 bg-slate-900 text-white' : 'border-slate-300 text-slate-700 hover:border-slate-400 hover:text-slate-900' ?>"
            href="/portfolio/sp500/autres"
          >Pourquoi le S&amp;P 500</a>
          <a
            href="/portfolio/"
            class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Retour au Portfolio
          </a>
        </nav>
      </div>
    </div>
  </div>
</header>
