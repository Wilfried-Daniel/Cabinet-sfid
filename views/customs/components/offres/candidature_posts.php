<section aria-label="Offres ouvertes" class="w-full bg-white py-10 px-6 md:py-20 md:px-12 lg:px-24 transition-colors duration-500 dark:bg-[#142446]">
    <div class="max-w-7xl mx-auto" data-aos="fade-up" data-aos-duration="1500">
        <?php if (!empty($_SESSION['flash_offre_success'])): ?>
            <p role="status" class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-800"><?= htmlspecialchars($_SESSION['flash_offre_success'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php unset($_SESSION['flash_offre_success']); ?>
        <?php endif; ?>
        <?php if (empty($offresOuvertes)): ?>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 px-6 py-12 text-center dark:border-white/10 dark:bg-white/5"><p class="font-inter text-slate-600 dark:text-slate-300">Aucune offre ouverte pour le moment.</p></div>
        <?php else: ?>
            <div class="space-y-5">
                <?php foreach ($offresOuvertes as $offre): ?>
                    <article class="rounded-2xl border-2 border-slate-200 bg-blue-950/90 p-6 transition-colors duration-200 hover:border-violet-500 dark:border-slate-700">
                        <div class="flex flex-col gap-5 md:flex-row md:items-start md:justify-between">
                            <div class="min-w-0 flex-1">
                                <p class="mb-2 font-mono text-xs tracking-widest text-slate-400">OFFRE — REF. OFF-<?= str_pad((string) $offre['id'], 4, '0', STR_PAD_LEFT) ?></p>
                                <h3 class="text-xl font-semibold text-white"><?= htmlspecialchars($offre['titre'], ENT_QUOTES, 'UTF-8') ?></h3>
                                <?php if (!empty($offre['description'])): ?><p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-300"><?= nl2br(htmlspecialchars($offre['description'], ENT_QUOTES, 'UTF-8')) ?></p><?php endif; ?>
                                <p class="mt-4 text-xs font-medium text-slate-300"><?php if (!empty($offre['date_cloture'])): ?>Date limite de candidature : <?= date('d/m/Y', strtotime($offre['date_cloture'])) ?><?php else: ?>Date de clôture non précisée<?php endif; ?></p>
                            </div>
                            <button type="button" data-open-modal="form-postes" data-offre-id="<?= (int) $offre['id'] ?>" data-offre-titre="<?= htmlspecialchars($offre['titre'], ENT_QUOTES, 'UTF-8') ?>" class="cursor-pointer self-start whitespace-nowrap rounded-full border border-slate-600 px-5 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-white hover:text-slate-900">Postuler</button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>