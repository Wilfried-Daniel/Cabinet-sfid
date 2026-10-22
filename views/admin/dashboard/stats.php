<?php
$admin_page_title = 'Vue d’ensemble';
$admin_active_page = 'stats';
require_once __DIR__ . '/../partials/header.php';
?>
<div class="min-h-screen lg:pl-[20%]">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="px-5 pt-26 pb-10 sm:px-8 lg:px-10 lg:pt-11 xl:px-14">
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-bold tracking-[.14em] text-blue-600 uppercase">Tableau de bord</p>
                <h1 class="mt-2 font-jakarta text-3xl font-extrabold tracking-[-.045em] text-[#111c33]">Bonjour, Administrateur</h1>
                <p class="mt-2 text-sm text-slate-500">Voici un aperçu de l'activité de votre espace recrutement.</p>
            </div>
            <button class="inline-flex w-max items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-blue-200 hover:text-blue-700">
                <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" aria-hidden="true"><path d="M12 3v18M3 12h18"></path></svg>
                Cette semaine
            </button>
        </div>

        <section class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Statistiques rapides">
            <article class="rounded-2xl bg-[#111c33] p-5 text-white shadow-xl shadow-slate-900/10">
                <div class="flex items-start justify-between">
                    <span class="text-sm text-white/65">Candidatures reçues</span>
                    <span class="grid size-10 place-items-center rounded-xl bg-white/10 text-violet-300"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M19 8v6M22 11h-6"></path></svg></span>
                </div>
                <p class="mt-6 font-jakarta text-4xl font-extrabold tracking-tight">124</p>
                <p class="mt-2 text-xs text-emerald-400">+ 12 % <span class="text-white/45">depuis le mois dernier</span></p>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <span class="text-sm font-medium text-slate-500">Nouvelles candidatures</span>
                    <span class="grid size-10 place-items-center rounded-xl bg-blue-50 text-blue-600"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg></span>
                </div>
                <p class="mt-6 font-jakarta text-4xl font-extrabold tracking-tight">18</p>
                <p class="mt-2 text-xs text-blue-600">À examiner aujourd'hui</p>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <span class="text-sm font-medium text-slate-500">Candidatures spontanées</span>
                    <span class="grid size-10 place-items-center rounded-xl bg-violet-100 text-violet-600"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M21 15a4 4 0 0 1-4 4H7l-4 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4Z"></path><path d="M8 9h8M8 13h5"></path></svg></span>
                </div>
                <p class="mt-6 font-jakarta text-4xl font-extrabold tracking-tight">08</p>
                <p class="mt-2 text-xs text-slate-400">4 reçues cette semaine</p>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <span class="text-sm font-medium text-slate-500">Offres actives</span>
                    <span class="grid size-10 place-items-center rounded-xl bg-emerald-50 text-emerald-600"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="7" width="18" height="13" rx="2"></rect><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 12h18"></path></svg></span>
                </div>
                <p class="mt-6 font-jakarta text-4xl font-extrabold tracking-tight">06</p>
                <p class="mt-2 text-xs text-emerald-600">Toutes publiées</p>
            </article>
        </section>

        <section class="mt-7 grid gap-6 xl:grid-cols-[1.55fr_.85fr]">
            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-jakarta text-lg font-extrabold tracking-tight">Flux des candidatures</h2>
                        <p class="mt-1 text-sm text-slate-500">Les 7 derniers jours</p>
                    </div>
                    <span class="rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-500">128 au total</span>
                </div>
                <div class="mt-9 flex h-48 items-end justify-between gap-3 border-b border-slate-100 px-1">
                    <div class="flex h-full flex-1 flex-col justify-end gap-2"><span class="h-[32%] rounded-t-lg bg-blue-100"></span><small class="text-center text-xs text-slate-400">Lun.</small></div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-2"><span class="h-[48%] rounded-t-lg bg-blue-200"></span><small class="text-center text-xs text-slate-400">Mar.</small></div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-2"><span class="h-[39%] rounded-t-lg bg-blue-200"></span><small class="text-center text-xs text-slate-400">Mer.</small></div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-2"><span class="h-[72%] rounded-t-lg bg-blue-500"></span><small class="text-center text-xs font-bold text-blue-600">Jeu.</small></div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-2"><span class="h-[55%] rounded-t-lg bg-blue-300"></span><small class="text-center text-xs text-slate-400">Ven.</small></div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-2"><span class="h-[28%] rounded-t-lg bg-blue-100"></span><small class="text-center text-xs text-slate-400">Sam.</small></div>
                    <div class="flex h-full flex-1 flex-col justify-end gap-2"><span class="h-[42%] rounded-t-lg bg-blue-200"></span><small class="text-center text-xs text-slate-400">Dim.</small></div>
                </div>
            </article>

            <article class="rounded-2xl bg-[#1d3159] p-6 text-white shadow-xl shadow-blue-950/10">
                <span class="grid size-11 place-items-center rounded-xl bg-violet-300 text-[#111c33]"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg></span>
                <h2 class="mt-6 font-jakarta text-xl font-extrabold tracking-tight">Publier une offre</h2>
                <p class="mt-2 text-sm leading-6 text-white/65">Créez une nouvelle opportunité et recevez les candidatures directement dans votre espace.</p>
                <a class="mt-7 inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-[#111c33] transition hover:bg-violet-200" href="index.php?page=ajouter-offre">Gérer les offres <span aria-hidden="true">→</span></a>
            </article>
        </section>
    </main>
</div>
</body>
</html>
