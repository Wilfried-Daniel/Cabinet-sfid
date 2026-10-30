<?php
$admin_page_title = "Vue d'ensemble";
$admin_active_page = 'stats';
require_once __DIR__ . '/../partials/header.php';
?>
<div class="min-h-screen lg:pl-[20%]">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="px-5 pt-26 pb-10 sm:px-8 lg:px-10 lg:pt-11 xl:px-14">
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-bold tracking-[.14em] text-blue-600 uppercase">Tableau de bord</p>
                <h1 class="mt-2 font-jakarta text-3xl font-extrabold tracking-[-.045em] text-[#111c33]">Bonjour, <?= htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8') ?></h1>
                <p class="mt-2 text-sm text-slate-500">Voici un aper&ccedil;u de l'activit&eacute; de votre espace recrutement.</p>
            </div>
            <button class="inline-flex w-max items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-blue-200 hover:text-blue-700">
                <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" aria-hidden="true"><path d="M12 3v18M3 12h18"></path></svg>
                Cette semaine
            </button>
        </div>

        <section class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Statistiques rapides">
            <article class="rounded-2xl bg-[#111c33] p-5 text-white shadow-xl shadow-slate-900/10">
                <div class="flex items-start justify-between">
                    <span class="text-sm text-white/65">Candidatures re&ccedil;ues</span>
                    <span class="grid size-10 place-items-center rounded-xl bg-white/10 text-violet-300"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M19 8v6M22 11h-6"></path></svg></span>
                </div>
                <p class="mt-6 font-jakarta text-4xl font-extrabold tracking-tight"><?= number_format($dashboardKpis['applications'], 0, ',', ' ') ?></p>
                <p class="mt-2 text-xs text-emerald-400">Depuis le lancement</p>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <span class="text-sm font-medium text-slate-500">Profils candidats</span>
                    <span class="grid size-10 place-items-center rounded-xl bg-blue-50 text-blue-600"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg></span>
                </div>
                <p class="mt-6 font-jakarta text-4xl font-extrabold tracking-tight"><?= number_format($dashboardKpis['candidates'], 0, ',', ' ') ?></p>
                <p class="mt-2 text-xs text-blue-600">Profils enregistr&eacute;s</p>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <span class="text-sm font-medium text-slate-500">Candidatures spontan&eacute;es</span>
                    <span class="grid size-10 place-items-center rounded-xl bg-violet-100 text-violet-600"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M21 15a4 4 0 0 1-4 4H7l-4 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4Z"></path><path d="M8 9h8M8 13h5"></path></svg></span>
                </div>
                <p class="mt-6 font-jakarta text-4xl font-extrabold tracking-tight"><?= number_format($dashboardKpis['spontaneous'], 0, ',', ' ') ?></p>
                <p class="mt-2 text-xs text-slate-400">Depuis le lancement</p>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <span class="text-sm font-medium text-slate-500">Offres actives</span>
                    <span class="grid size-10 place-items-center rounded-xl bg-emerald-50 text-emerald-600"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="7" width="18" height="13" rx="2"></rect><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 12h18"></path></svg></span>
                </div>
                <p class="mt-6 font-jakarta text-4xl font-extrabold tracking-tight"><?= number_format($dashboardKpis['active_offers'], 0, ',', ' ') ?></p>
                <p class="mt-2 text-xs text-emerald-600">Disponibles pour postuler</p>
            </article>
        </section>

        <section class="mt-7 grid gap-6 xl:grid-cols-[1.55fr_.85fr]">
            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-jakarta text-lg font-extrabold tracking-tight">Flux des candidatures</h2>
                        <p class="mt-1 text-sm text-slate-500">Les 7 derniers jours</p>
                    </div>
                    <span class="rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-500"><?= number_format($applicationChart['total'], 0, ',', ' ') ?> sur 7 jours</span>
                </div>
                <?php $chartToday = $applicationChart['days'][array_key_last($applicationChart['days'])]['date']; ?>
                <div class="mt-8 grid h-48 grid-cols-7 gap-3 border-b border-slate-100 px-1">
                    <?php foreach ($applicationChart['days'] as $day): ?>
                        <?php
                        $barHeight = $applicationChart['maximum'] > 0
                            ? max(5, (int) round(($day['count'] / $applicationChart['maximum']) * 100))
                            : 3;
                        $isToday = $day['date'] === $chartToday;
                        ?>
                        <div class="flex h-full min-w-0 flex-col items-center" title="<?= htmlspecialchars(date('d/m/Y', strtotime($day['date'])) . ' : ' . $day['count'] . ' candidature(s)', ENT_QUOTES, 'UTF-8') ?>">
                            <small class="mb-1 text-[.65rem] font-semibold text-slate-500"><?= $day['count'] ?></small>
                            <div class="flex min-h-0 w-full flex-1 items-end">
                                <span class="block w-full rounded-t-lg <?= $day['count'] > 0 ? ($isToday ? 'bg-blue-500' : 'bg-blue-200') : 'bg-slate-100' ?>" style="height: <?= $barHeight ?>%" aria-hidden="true"></span>
                            </div>
                            <small class="mt-2 text-center text-xs <?= $isToday ? 'font-bold text-blue-600' : 'text-slate-400' ?>"><?= htmlspecialchars($day['label'], ENT_QUOTES, 'UTF-8') ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>
            </article>

            <article class="rounded-2xl bg-[#1d3159] p-6 text-white shadow-xl shadow-blue-950/10">
                <span class="grid size-11 place-items-center rounded-xl bg-violet-300 text-[#111c33]"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg></span>
                <h2 class="mt-6 font-jakarta text-xl font-extrabold tracking-tight">Publier une offre</h2>
                <p class="mt-2 text-sm leading-6 text-white/65">Cr&eacute;ez une nouvelle opportunit&eacute; et recevez les candidatures directement dans votre espace.</p>
                <a class="mt-7 inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-[#111c33] transition hover:bg-violet-200" href="index.php?page=ajouter-offre">G&eacute;rer les offres <span aria-hidden="true">&rarr;</span></a>
            </article>
        </section>
    </main>
</div>
</body>
</html>
