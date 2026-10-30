<?php
$admin_page_title = 'Offres emploi';
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
                <p class="mt-2 text-sm text-slate-500">Gérez les offres publiées par le Cabinet SFID.</p>
            </div>
            <button type="button" id="open-offre-modal" aria-haspopup="dialog" aria-controls="offre-modal" class="inline-flex w-max items-center gap-2 rounded-xl bg-violet-300 px-4 py-3 text-sm font-bold text-[#111c33] shadow-lg shadow-violet-500/20 transition hover:-translate-y-0.5 hover:bg-violet-200"><svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M12 5v14M5 12h14"></path>
                </svg>Ajouter une offre</button>
        </div>
        <?php if ($offreError && !in_array($_POST['action'] ?? '', ['create', 'update'], true)): ?><p role="alert" class="mt-6 rounded-xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700"><?= htmlspecialchars($offreError, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <?php if ($offreSuccess): ?><p role="status" class="mt-6 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700"><?= htmlspecialchars($offreSuccess, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <section class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-4 border-b border-slate-100 px-6 py-5 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="font-jakarta text-lg font-extrabold tracking-tight">Toutes les offres</h2>
                    <p class="mt-1 text-sm text-slate-500"><?= $offreAllCount ?> offre<?= $offreAllCount > 1 ? 's' : '' ?> au total</p>
                </div>
                <nav class="flex flex-wrap gap-2" aria-label="Filtrer les offres"><?php foreach (['tous' => 'Tous', 'ouverte' => 'Ouverte', 'fermee' => 'Fermée'] as $filterKey => $filterLabel): ?><a href="index.php?page=ajouter-offre&amp;statut=<?= rawurlencode($filterKey) ?>" class="rounded-lg px-3 py-2 text-xs font-bold <?= $statutFilter === $filterKey ? 'bg-[#111c33] text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>"><?= $filterLabel ?></a><?php endforeach; ?></nav>
            </div>
            <?php if ($offreAllCount === 0): ?>
                <div class="px-6 py-16 text-center">
                    <p class="font-jakarta text-lg font-bold text-[#111c33]">Aucune offre postée pour l'instant</p>
                </div>
            <?php elseif (!$offres): ?><div class="px-6 py-12 text-center text-sm text-slate-500">Aucune offre dans cette catégorie.</div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] text-left">
                        <thead class="border-b border-slate-100 bg-slate-50/80 text-xs font-bold tracking-wider text-slate-500 uppercase">
                            <tr>
                                <th class="px-6 py-4">Intitulé</th>
                                <th class="px-6 py-4">Statut</th>
                                <th class="px-6 py-4">Date de publication</th>
                                <th class="px-6 py-4">Date de clôture</th>
                                <th class="px-6 py-4"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php foreach ($offres as $offre): ?><?php $editId = (int) $offre['id'];
                                                                    $isOpen = $offre['statut'] === 'ouverte';
                                                                    $editPayload = ['id' => $editId, 'titre' => $offre['titre'], 'statut' => $offre['statut'], 'date_publication' => date('Y-m-d\\TH:i', strtotime($offre['date_publication'])), 'date_cloture' => $offre['date_cloture'] ? date('Y-m-d\\TH:i', strtotime($offre['date_cloture'])) : '']; ?>
                            <tr class="transition hover:bg-slate-50/70">
                                <td class="px-6 py-4"><strong class="block font-bold text-[#111c33]"><?= htmlspecialchars($offre['titre'], ENT_QUOTES, 'UTF-8') ?></strong></td>
                                <td class="px-6 py-4"><span class="rounded-full px-3 py-1 text-xs font-bold <?= $isOpen ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' ?>"><?= $isOpen ? 'Ouverte' : 'Fermée' ?></span></td>
                                <td class="px-6 py-4 text-slate-500"><?= date('d/m/Y H:i', strtotime($offre['date_publication'])) ?></td>
                                <td class="px-6 py-4 text-slate-500"><?= $offre['date_cloture'] ? date('d/m/Y H:i', strtotime($offre['date_cloture'])) : '—' ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1"><button type="button" data-edit-offre="<?= htmlspecialchars(json_encode($editPayload, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP), ENT_QUOTES, 'UTF-8') ?>" aria-label="Modifier <?= htmlspecialchars($offre['titre'], ENT_QUOTES, 'UTF-8') ?>" class="rounded-lg p-2 text-slate-400 transition hover:bg-blue-50 hover:text-blue-600"><svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                                            </svg></button>
                                        <form method="post" action="index.php?page=ajouter-offre" onsubmit="return confirm('Supprimer cette offre ?');"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_offre_token'], ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $editId ?>"><input type="hidden" name="return_statut" value="<?= htmlspecialchars($statutFilter, ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="return_page" value="<?= $offrePage ?>"><button type="submit" aria-label="Supprimer <?= htmlspecialchars($offre['titre'], ENT_QUOTES, 'UTF-8') ?>" class="rounded-lg p-2 text-slate-400 transition hover:bg-rose-50 hover:text-rose-600"><svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M8 6V4h8v2"></path>
                                                    <path d="m19 6-1 14H6L5 6"></path>
                                                    <path d="M10 11v5M14 11v5"></path>
                                                </svg></button></form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col gap-3 border-t border-slate-100 px-6 py-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between"><span>Page <?= $offrePage ?> sur <?= $offrePageCount ?> · <?= $offreTotal ?> offre<?= $offreTotal > 1 ? 's' : '' ?></span>
                    <div class="flex gap-2"><?php if ($offrePage > 1): ?><a class="rounded-lg border border-slate-200 px-3 py-2 font-bold hover:bg-slate-50" href="index.php?page=ajouter-offre&amp;statut=<?= rawurlencode($statutFilter) ?>&amp;page_num=<?= $offrePage - 1 ?>">← Précédent</a><?php endif; ?><?php if ($offrePage < $offrePageCount): ?><a class="rounded-lg border border-slate-200 px-3 py-2 font-bold hover:bg-slate-50" href="index.php?page=ajouter-offre&amp;statut=<?= rawurlencode($statutFilter) ?>&amp;page_num=<?= $offrePage + 1 ?>">Suivant →</a><?php endif; ?></div>
                </div>
            <?php endif; ?>
        </section>
    </main>
</div>

<!-- modale -->
<dialog id="offre-modal" aria-labelledby="offre-modal-title" class="m-auto w-[calc(100%-2rem)] max-w-2xl rounded-2xl p-0 text-[#17213b] shadow-2xl backdrop:bg-slate-950/60">
    <div class="flex items-start justify-between border-b border-slate-100 px-6 py-5 sm:px-8">
        <div>
            <p class="text-xs font-bold tracking-[.14em] text-blue-600 uppercase">Recrutement</p>
            <h2 id="offre-modal-title" class="mt-1 font-jakarta text-xl font-extrabold">Ajouter une offre</h2>
            <p id="offre-modal-description" class="mt-1 text-sm text-slate-500">Renseignez les informations de la nouvelle offre.</p>
        </div><button type="button" id="close-offre-modal" aria-label="Fermer la fenêtre" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100">×</button>
    </div>
    <form id="offre-form" method="post" action="index.php?page=ajouter-offre" class="space-y-5 px-6 py-6 sm:px-8"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_offre_token'], ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" id="offre-action" name="action" value="create"><input type="hidden" id="offre-id" name="id" value=""><input type="hidden" name="return_statut" value="<?= htmlspecialchars($statutFilter, ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="return_page" value="<?= $offrePage ?>">
        <p id="offre-form-error" role="alert" class="<?= $offreError && in_array($_POST['action'] ?? '', ['create', 'update'], true) ? '' : 'hidden' ?> rounded-xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700"><?= htmlspecialchars($offreError ?? '', ENT_QUOTES, 'UTF-8') ?></p>
        <div class="grid gap-5 sm:grid-cols-2">
            <label class="block text-sm font-semibold text-slate-700 sm:col-span-2">Intitulé <span class="text-rose-600">*</span><input id="offre-titre" name="titre" type="text" maxlength="150" required value="<?= htmlspecialchars($offreForm['titre'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 font-normal outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"></label>
            <label id="offre-description-wrap" class="block text-sm font-semibold text-slate-700 sm:col-span-2">Brève Description <span class="text-rose-600">*</span><textarea id="offre-description" name="description" rows="5" class="mt-2 w-full resize-y rounded-xl border border-slate-200 px-4 py-3 font-normal outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"><?= htmlspecialchars($offreForm['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea></label>
            <label class="block text-sm font-semibold text-slate-700 sm:col-span-2">Statut <select id="offre-statut" name="statut" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 font-normal outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                    <option value="ouverte" <?= ($offreForm['statut'] ?? 'ouverte') === 'ouverte' ? 'selected' : '' ?>>Ouverte</option>
                    <option value="<?= htmlspecialchars($statutFermee, ENT_QUOTES, 'UTF-8') ?>" <?= ($offreForm['statut'] ?? '') === $statutFermee ? 'selected' : '' ?>>Fermée</option>
                </select></label>
            <label id="offre-publication-wrap" class="hidden block text-sm font-semibold text-slate-700 sm:col-span-2">Date de publication <input id="offre-publication" name="date_publication" type="datetime-local" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 font-normal outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"></label>
            <label class="block text-sm font-semibold text-slate-700 sm:col-span-2">Date de clôture <input id="offre-cloture" name="date_cloture" type="datetime-local" value="<?= htmlspecialchars($offreForm['date_cloture'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 font-normal outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10" required></label>
        </div>
        <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end"><button type="button" id="cancel-offre-modal" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-bold text-slate-600">Annuler</button><button id="offre-submit" type="submit" class="rounded-xl bg-[#111c33] px-5 py-3 text-sm font-bold text-white">Enregistrer l'offre</button></div>
    </form>
</dialog>
<script>
    (() => {
        const modal = document.getElementById('offre-modal');
        const form = document.getElementById('offre-form');
        const publication = document.getElementById('offre-publication');
        const description = document.getElementById('offre-description');
        const resetForm = () => {
            form.reset();
            document.getElementById('offre-titre').value = '';
            description.value = '';
            document.getElementById('offre-statut').value = 'ouverte';
            document.getElementById('offre-cloture').value = '';
            document.getElementById('offre-action').value = 'create';
            document.getElementById('offre-id').value = '';
            document.getElementById('offre-modal-title').textContent = 'Ajouter une offre';
            document.getElementById('offre-modal-description').textContent = 'Renseignez les informations de la nouvelle offre.';
            document.getElementById('offre-submit').textContent = 'Enregistrer l’offre';
            document.getElementById('offre-description-wrap').classList.remove('hidden');
            description.required = true;
            publication.required = false;
            publication.value = '';
            document.getElementById('offre-publication-wrap').classList.add('hidden');
            document.getElementById('offre-form-error').classList.add('hidden');
            document.getElementById('offre-form-error').textContent = '';
        };
        const closeModal = () => modal.close();
        document.getElementById('open-offre-modal').addEventListener('click', () => {
            resetForm();
            modal.showModal();
        });
        document.getElementById('close-offre-modal').addEventListener('click', closeModal);
        document.getElementById('cancel-offre-modal').addEventListener('click', closeModal);
        modal.addEventListener('close', resetForm);
        document.querySelectorAll('[data-edit-offre]').forEach(button => button.addEventListener('click', () => {
            const offer = JSON.parse(button.dataset.editOffre);
            resetForm();
            document.getElementById('offre-action').value = 'update';
            document.getElementById('offre-id').value = offer.id;
            document.getElementById('offre-titre').value = offer.titre;
            document.getElementById('offre-statut').value = offer.statut;
            publication.value = offer.date_publication;
            publication.required = true;
            document.getElementById('offre-publication-wrap').classList.remove('hidden');
            document.getElementById('offre-cloture').value = offer.date_cloture;
            document.getElementById('offre-description-wrap').classList.add('hidden');
            description.required = false;
            document.getElementById('offre-modal-title').textContent = 'Modifier une offre';
            document.getElementById('offre-modal-description').textContent = 'Modifiez les informations de publication.';
            document.getElementById('offre-submit').textContent = 'Enregistrer les modifications';
            modal.showModal();
        }));
        modal.addEventListener('click', event => {
            if (event.target === modal) closeModal();
        });
        <?php if ($offreError && in_array($_POST['action'] ?? '', ['create', 'update'], true)): ?>
            <?php if (($_POST['action'] ?? '') === 'update'): ?>
                document.getElementById('offre-action').value = 'update';
                document.getElementById('offre-id').value = <?= json_encode($_POST['id'] ?? '') ?>;
                document.getElementById('offre-titre').value = <?= json_encode($_POST['titre'] ?? '', JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
                document.getElementById('offre-statut').value = <?= json_encode($_POST['statut'] ?? '', JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
                publication.value = <?= json_encode($_POST['date_publication'] ?? '', JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
                publication.required = true;
                document.getElementById('offre-publication-wrap').classList.remove('hidden');
                document.getElementById('offre-description-wrap').classList.add('hidden');
                description.required = false;
                document.getElementById('offre-modal-title').textContent = 'Modifier une offre';
            <?php endif; ?>
            modal.showModal();
        <?php endif; ?>
    })();
</script>
</body>

</html>