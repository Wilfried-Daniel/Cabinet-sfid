<?php
$admin_page_title = 'Offres d’emploi';
$admin_active_page = 'offres';
require_once __DIR__ . '/../partials/header.php';
?>
<div class="min-h-screen lg:pl-[20%]">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>
    <main class="px-5 pt-26 pb-10 sm:px-8 lg:px-10 lg:pt-11 xl:px-14">
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-bold tracking-[.14em] text-blue-600 uppercase">Recrutement</p>
                <h1 class="mt-2 font-jakarta text-3xl font-extrabold tracking-[-.045em] text-[#111c33]">Offres d'emploi</h1>
                <p class="mt-2 text-sm text-slate-500">Pilotez les opportunités publiées par le Cabinet SFID.</p>
            </div>
            <button class="inline-flex w-max items-center gap-2 rounded-xl bg-violet-300 px-4 py-3 text-sm font-bold text-[#111c33] shadow-lg shadow-violet-500/20 transition hover:-translate-y-0.5 hover:bg-violet-200"><svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>Ajouter une offre</button>
        </div>

        <section class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-4 border-b border-slate-100 px-6 py-5 md:flex-row md:items-center md:justify-between">
                <div><h2 class="font-jakarta text-lg font-extrabold tracking-tight">Toutes les offres</h2><p class="mt-1 text-sm text-slate-500">6 offres au total · 5 actuellement publiées</p></div>
                <div class="flex gap-2"><button class="rounded-lg bg-[#111c33] px-3 py-2 text-xs font-bold text-white">Toutes</button><button class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-bold text-slate-600">Publiées</button><button class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-bold text-slate-600">Brouillons</button></div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-190 w-full text-left">
                    <thead class="border-b border-slate-100 bg-slate-50/80 text-xs font-bold tracking-wider text-slate-500 uppercase"><tr><th class="px-6 py-4">Intitulé</th><th class="px-6 py-4">Département</th><th class="px-6 py-4">Candidatures</th><th class="px-6 py-4">Statut</th><th class="px-6 py-4">Publication</th><th class="px-6 py-4"><span class="sr-only">Actions</span></th></tr></thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <tr class="transition hover:bg-slate-50/70"><td class="px-6 py-4"><strong class="block font-bold">Assistant(e) comptable</strong><small class="mt-1 block text-slate-400">Abidjan · CDI</small></td><td class="px-6 py-4 text-slate-600">Finance & comptabilité</td><td class="px-6 py-4"><span class="font-bold text-[#111c33]">42</span> <span class="text-slate-400">profils</span></td><td class="px-6 py-4"><span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Publiée</span></td><td class="px-6 py-4 text-slate-500">08 août 2026</td><td class="px-6 py-4"><button class="rounded-lg p-2 text-slate-400 transition hover:bg-blue-50 hover:text-blue-600" aria-label="Gérer l'offre Assistant(e) comptable">•••</button></td></tr>
                        <tr class="transition hover:bg-slate-50/70"><td class="px-6 py-4"><strong class="block font-bold">Chargé(e) de communication</strong><small class="mt-1 block text-slate-400">Abidjan · CDD</small></td><td class="px-6 py-4 text-slate-600">Communication</td><td class="px-6 py-4"><span class="font-bold text-[#111c33]">28</span> <span class="text-slate-400">profils</span></td><td class="px-6 py-4"><span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Publiée</span></td><td class="px-6 py-4 text-slate-500">05 août 2026</td><td class="px-6 py-4"><button class="rounded-lg p-2 text-slate-400 transition hover:bg-blue-50 hover:text-blue-600" aria-label="Gérer l'offre Chargé(e) de communication">•••</button></td></tr>
                        <tr class="transition hover:bg-slate-50/70"><td class="px-6 py-4"><strong class="block font-bold">Consultant(e) junior</strong><small class="mt-1 block text-slate-400">Abidjan · Stage</small></td><td class="px-6 py-4 text-slate-600">Conseil</td><td class="px-6 py-4"><span class="font-bold text-[#111c33]">19</span> <span class="text-slate-400">profils</span></td><td class="px-6 py-4"><span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Publiée</span></td><td class="px-6 py-4 text-slate-500">01 août 2026</td><td class="px-6 py-4"><button class="rounded-lg p-2 text-slate-400 transition hover:bg-blue-50 hover:text-blue-600" aria-label="Gérer l'offre Consultant(e) junior">•••</button></td></tr>
                        <tr class="transition hover:bg-slate-50/70"><td class="px-6 py-4"><strong class="block font-bold">Responsable administratif(ve)</strong><small class="mt-1 block text-slate-400">Abidjan · CDI</small></td><td class="px-6 py-4 text-slate-600">Administration</td><td class="px-6 py-4"><span class="font-bold text-[#111c33]">—</span></td><td class="px-6 py-4"><span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">Brouillon</span></td><td class="px-6 py-4 text-slate-500">Non publiée</td><td class="px-6 py-4"><button class="rounded-lg p-2 text-slate-400 transition hover:bg-blue-50 hover:text-blue-600" aria-label="Gérer l'offre Responsable administratif">•••</button></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-between border-t border-slate-100 px-6 py-4 text-sm text-slate-500"><span>Affichage de 4 offres sur 6</span><button class="font-bold text-blue-600 transition hover:text-blue-800">Voir toutes les offres →</button></div>
        </section>
    </main>
</div>
</body>
</html>
