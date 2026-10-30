<?php
$admin_page_title = 'Candidatures';
$admin_active_page = 'candidatures';
require_once __DIR__ . '/../partials/header.php';
?>
<div class="min-h-screen lg:pl-[20%]">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>
    <main class="px-5 pt-26 pb-10 sm:px-8 lg:px-10 lg:pt-11 xl:px-14">
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div><p class="text-xs font-bold tracking-[.14em] text-blue-600 uppercase">Recrutement</p><h1 class="mt-2 font-jakarta text-3xl font-extrabold tracking-[-.045em] text-[#111c33]">Candidatures aux offres</h1><p class="mt-2 text-sm text-slate-500">Consultez les profils reçus pour chaque offre publiée.</p></div>
            <span class="w-max rounded-xl bg-violet-100 px-4 py-2.5 text-sm font-bold text-violet-700"><?= $totalCandidatures ?> candidature<?= $totalCandidatures > 1 ? 's' : '' ?></span>
        </div>
        <section class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <?php if (!$candidatures): ?>
                <div class="px-6 py-16 text-center"><p class="font-jakarta text-lg font-bold text-[#111c33]">Aucune candidature reçue pour le moment</p><p class="mt-2 text-sm text-slate-500">Les candidatures aux offres apparaîtront ici.</p></div>
            <?php else: ?>
                <div class="overflow-x-auto"><table class="w-full min-w-[760px] text-left">
                    <thead class="border-b border-slate-100 bg-slate-50/80 text-xs font-bold tracking-wider text-slate-500 uppercase"><tr><th class="px-6 py-4">Candidat</th><th class="px-6 py-4">Offre concernée</th><th class="px-6 py-4">Réception</th><th class="px-6 py-4">État</th><th class="px-6 py-4"><span class="sr-only">Actions</span></th></tr></thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php foreach ($candidatures as $candidature): ?>
                            <tr class="transition hover:bg-slate-50/70">
                                <td class="px-6 py-4"><div class="flex items-center gap-3"><span class="grid size-10 shrink-0 place-items-center rounded-full bg-blue-100 text-blue-700"><svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21a8 8 0 0 1 16 0"></path></svg></span><span><strong class="block font-bold"><?= htmlspecialchars($candidature['nom_complet'], ENT_QUOTES, 'UTF-8') ?></strong><small class="text-slate-500"><?= htmlspecialchars($candidature['email'], ENT_QUOTES, 'UTF-8') ?></small></span></div></td>
                                <td class="px-6 py-4 font-medium text-slate-600"><?= htmlspecialchars($candidature['offre_titre'] ?? $candidature['poste'] ?? 'Offre supprimée', ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="px-6 py-4 text-slate-500"><?= date('d/m/Y à H:i', strtotime($candidature['date_candidature'])) ?></td>
                                <td class="px-6 py-4"><span class="rounded-full bg-violet-100 px-3 py-1 text-xs font-bold text-violet-700">Reçue</span></td>
                                <td class="px-6 py-4 text-right"><button type="button" data-open-candidature="candidature-<?= (int) $candidature['id'] ?>" aria-label="Voir la candidature de <?= htmlspecialchars($candidature['nom_complet'], ENT_QUOTES, 'UTF-8') ?>" class="rounded-lg p-2 text-slate-400 transition hover:bg-blue-50 hover:text-blue-600"><svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"></path></svg></button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table></div>
                <div class="flex flex-col gap-3 border-t border-slate-100 px-6 py-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between"><span>Page <?= $page ?> sur <?= $pageCount ?> · <?= $totalCandidatures ?> candidature<?= $totalCandidatures > 1 ? 's' : '' ?></span><div class="flex gap-2"><?php if ($page > 1): ?><a class="rounded-lg border border-slate-200 px-3 py-2 font-semibold hover:bg-slate-50" href="index.php?page=candidatures&amp;page_num=<?= $page - 1 ?>">Précédent</a><?php endif; ?><?php if ($page < $pageCount): ?><a class="rounded-lg border border-slate-200 px-3 py-2 font-semibold hover:bg-slate-50" href="index.php?page=candidatures&amp;page_num=<?= $page + 1 ?>">Suivant</a><?php endif; ?></div></div>
            <?php endif; ?>
        </section>
        <?php foreach ($candidatures as $candidature): ?>
            <dialog id="candidature-<?= (int) $candidature['id'] ?>" aria-labelledby="candidature-title-<?= (int) $candidature['id'] ?>" class="m-auto w-[calc(100%-2rem)] max-w-2xl rounded-2xl p-0 text-[#17213b] shadow-2xl backdrop:bg-slate-950/60">
                <div class="flex items-start justify-between border-b border-slate-100 px-6 py-5"><div><p class="text-xs font-bold tracking-widest text-blue-600 uppercase">Dossier candidat</p><h2 id="candidature-title-<?= (int) $candidature['id'] ?>" class="mt-1 font-jakarta text-xl font-extrabold"><?= htmlspecialchars($candidature['nom_complet'], ENT_QUOTES, 'UTF-8') ?></h2><p class="mt-1 text-sm text-slate-500"><?= htmlspecialchars($candidature['offre_titre'] ?? $candidature['poste'] ?? 'Offre supprimée', ENT_QUOTES, 'UTF-8') ?></p></div><button type="button" data-close-candidature="candidature-<?= (int) $candidature['id'] ?>" aria-label="Fermer" class="rounded-lg px-3 py-2 text-slate-400 hover:bg-slate-100">×</button></div>
                <div class="space-y-5 px-6 py-6"><div class="grid gap-4 sm:grid-cols-2"><div><p class="text-xs font-bold uppercase tracking-wider text-slate-400">E-mail</p><a class="mt-1 block text-sm font-semibold text-blue-700 hover:underline" href="mailto:<?= htmlspecialchars($candidature['email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($candidature['email'], ENT_QUOTES, 'UTF-8') ?></a></div><div><p class="text-xs font-bold uppercase tracking-wider text-slate-400">Téléphone</p><a class="mt-1 block text-sm font-semibold text-blue-700 hover:underline" href="tel:<?= htmlspecialchars($candidature['telephone'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($candidature['telephone'], ENT_QUOTES, 'UTF-8') ?></a></div><div><p class="text-xs font-bold uppercase tracking-wider text-slate-400">Date de réception</p><p class="mt-1 text-sm text-slate-700"><?= date('d/m/Y à H:i', strtotime($candidature['date_candidature'])) ?></p></div></div>
                    <div><p class="text-xs font-bold uppercase tracking-wider text-slate-400">Message</p><p class="mt-2 whitespace-pre-line text-sm leading-relaxed text-slate-700"><?= !empty($candidature['message']) ? nl2br(htmlspecialchars($candidature['message'], ENT_QUOTES, 'UTF-8')) : 'Aucun message fourni.' ?></p></div>
                    <div class="flex flex-wrap gap-3"><?php if ($candidature['cv_chemin']): ?><a class="rounded-lg bg-blue-50 px-4 py-2 text-sm font-bold text-blue-700 hover:bg-blue-100" href="<?= htmlspecialchars($candidature['cv_chemin'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Voir le CV</a><?php endif; ?><?php if ($candidature['lm_chemin']): ?><a class="rounded-lg bg-blue-50 px-4 py-2 text-sm font-bold text-blue-700 hover:bg-blue-100" href="<?= htmlspecialchars($candidature['lm_chemin'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener">Voir la lettre de motivation</a><?php endif; ?></div>
                </div>
            </dialog>
        <?php endforeach; ?>
    </main>
</div>
<script>
    document.querySelectorAll('[data-open-candidature]').forEach(button => button.addEventListener('click', () => document.getElementById(button.dataset.openCandidature).showModal()));
    document.querySelectorAll('[data-close-candidature]').forEach(button => button.addEventListener('click', () => document.getElementById(button.dataset.closeCandidature).close()));
    document.querySelectorAll('dialog').forEach(dialog => dialog.addEventListener('click', event => { if (event.target === dialog) dialog.close(); }));
</script>
</body>
</html>