<?php
$admin_page_title = 'Candidatures';
$admin_active_page = 'candidatures';
require_once __DIR__ . '/../partials/header.php';
?>
<div class="min-h-screen lg:pl-[20%]">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>
    <main class="px-5 pt-26 pb-10 sm:px-8 lg:px-10 lg:pt-11 xl:px-14">
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-bold tracking-[.14em] text-blue-600 uppercase">Recrutement</p>
                <h1 class="mt-2 font-jakarta text-3xl font-extrabold tracking-[-.045em] text-[#111c33]">Candidatures aux offres</h1>
                <p class="mt-2 text-sm text-slate-500">Consultez les profils reçus pour chaque offre publiée.</p>
            </div>
            <span class="w-max rounded-xl bg-violet-100 px-4 py-2.5 text-sm font-bold text-violet-700">12 candidatures à traiter</span>
        </div>

        <section class="mt-8 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex flex-col gap-3 md:flex-row">
                <label class="relative block flex-1">
                    <span class="sr-only">Rechercher une candidature</span>
                    <svg class="pointer-events-none absolute top-1/2 left-3.5 size-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="6"></circle><path d="m20 20-4.3-4.3"></path></svg>
                    <input class="h-11 w-full rounded-xl bg-slate-50 pr-4 pl-11 text-sm outline-none ring-1 ring-slate-200 transition focus:bg-white focus:ring-2 focus:ring-blue-500/30" type="search" placeholder="Rechercher par nom ou poste">
                </label>
                <button class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-slate-200 px-4 text-sm font-semibold text-slate-600 transition hover:border-blue-200 hover:text-blue-700"><svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 6h16M7 12h10m-7 6h4"></path></svg>Filtrer</button>
                <button class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-slate-200 px-4 text-sm font-semibold text-slate-600 transition hover:border-blue-200 hover:text-blue-700"><svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"></path></svg>Exporter</button>
            </div>
        </section>

        <section class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-180 w-full text-left">
                    <thead class="border-b border-slate-100 bg-slate-50/80 text-xs font-bold tracking-wider text-slate-500 uppercase">
                        <tr><th class="px-6 py-4">Candidat</th><th class="px-6 py-4">Offre concernée</th><th class="px-6 py-4">Réception</th><th class="px-6 py-4">Statut</th><th class="px-6 py-4"><span class="sr-only">Actions</span></th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <tr class="transition hover:bg-slate-50/70"><td class="px-6 py-4"><div class="flex items-center gap-3"><span class="grid size-10 place-items-center rounded-full bg-blue-100 font-bold text-blue-700">AM</span><span><strong class="block font-bold">Aïcha Mohamed</strong><small class="text-slate-500">aicha.mohamed@email.com</small></span></div></td><td class="px-6 py-4 font-medium text-slate-600">Assistant(e) comptable</td><td class="px-6 py-4 text-slate-500">Aujourd'hui, 09:42</td><td class="px-6 py-4"><span class="rounded-full bg-violet-100 px-3 py-1 text-xs font-bold text-violet-700">Nouveau</span></td><td class="px-6 py-4 text-right"><button class="rounded-lg p-2 text-slate-400 transition hover:bg-blue-50 hover:text-blue-600" aria-label="Voir la candidature d'Aïcha Mohamed">→</button></td></tr>
                        <tr class="transition hover:bg-slate-50/70"><td class="px-6 py-4"><div class="flex items-center gap-3"><span class="grid size-10 place-items-center rounded-full bg-emerald-100 font-bold text-emerald-700">KB</span><span><strong class="block font-bold">Kévin Bamba</strong><small class="text-slate-500">kevin.bamba@email.com</small></span></div></td><td class="px-6 py-4 font-medium text-slate-600">Chargé(e) de communication</td><td class="px-6 py-4 text-slate-500">Hier, 16:18</td><td class="px-6 py-4"><span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-700">En étude</span></td><td class="px-6 py-4 text-right"><button class="rounded-lg p-2 text-slate-400 transition hover:bg-blue-50 hover:text-blue-600" aria-label="Voir la candidature de Kévin Bamba">→</button></td></tr>
                        <tr class="transition hover:bg-slate-50/70"><td class="px-6 py-4"><div class="flex items-center gap-3"><span class="grid size-10 place-items-center rounded-full bg-rose-100 font-bold text-rose-700">SN</span><span><strong class="block font-bold">Sonia N'Diaye</strong><small class="text-slate-500">sonia.ndiaye@email.com</small></span></div></td><td class="px-6 py-4 font-medium text-slate-600">Consultant(e) junior</td><td class="px-6 py-4 text-slate-500">12 août 2026</td><td class="px-6 py-4"><span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700">Entretien</span></td><td class="px-6 py-4 text-right"><button class="rounded-lg p-2 text-slate-400 transition hover:bg-blue-50 hover:text-blue-600" aria-label="Voir la candidature de Sonia N'Diaye">→</button></td></tr>
                        <tr class="transition hover:bg-slate-50/70"><td class="px-6 py-4"><div class="flex items-center gap-3"><span class="grid size-10 place-items-center rounded-full bg-orange-100 font-bold text-orange-700">JM</span><span><strong class="block font-bold">Jean Mbala</strong><small class="text-slate-500">jean.mbala@email.com</small></span></div></td><td class="px-6 py-4 font-medium text-slate-600">Assistant(e) comptable</td><td class="px-6 py-4 text-slate-500">11 août 2026</td><td class="px-6 py-4"><span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">Reçu</span></td><td class="px-6 py-4 text-right"><button class="rounded-lg p-2 text-slate-400 transition hover:bg-blue-50 hover:text-blue-600" aria-label="Voir la candidature de Jean Mbala">→</button></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col gap-3 border-t border-slate-100 px-6 py-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between"><p>Affichage de 1 à 4 sur 124 candidatures</p><div class="flex gap-2"><button class="rounded-lg border border-slate-200 px-3 py-1.5 font-semibold text-slate-400">Précédent</button><button class="rounded-lg bg-[#111c33] px-3 py-1.5 font-semibold text-white">1</button><button class="rounded-lg border border-slate-200 px-3 py-1.5 font-semibold text-slate-600">Suivant</button></div></div>
        </section>
    </main>
</div>
</body>
</html>
