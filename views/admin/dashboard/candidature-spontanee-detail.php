<?php
$admin_page_title = 'Profil candidat';
$admin_active_page = 'spontanee';
require_once __DIR__ . '/../partials/header.php';
$domaines = [
    'comptabilite-fiscalite' => 'Comptabilité & Fiscalité',
    'juridique-social' => 'Juridique & Social',
    'communication' => 'Communication & Marketing',
    'finance' => 'Finance & Gestion',
    'autre' => 'Autre domaine',
];
?>
<div class="min-h-screen lg:pl-[20%]">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>
    <main class="px-5 pt-26 pb-10 sm:px-8 lg:px-10 lg:pt-11 xl:px-14">
        <a href="index.php?page=spontanee" class="text-sm font-bold text-blue-700 hover:underline">← Retour aux candidatures spontanées</a>
        <section class="mt-6 max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <p class="text-xs font-bold tracking-[.14em] text-blue-600 uppercase">Profil candidat</p>
            <h1 class="mt-2 font-jakarta text-3xl font-extrabold tracking-tight text-[#111c33]"><?= htmlspecialchars($candidature['nom_complet'], ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="mt-2 text-sm text-slate-500">Candidature reçue le <?= date('d/m/Y à H:i', strtotime($candidature['date_candidature'])) ?></p>
            <dl class="mt-8 grid gap-5 border-t border-slate-100 pt-6 sm:grid-cols-2">
                <div><dt class="text-xs font-bold uppercase tracking-wider text-slate-400">E-mail</dt><dd class="mt-1"><a class="font-semibold text-blue-700 hover:underline" href="mailto:<?= htmlspecialchars($candidature['email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($candidature['email'], ENT_QUOTES, 'UTF-8') ?></a></dd></div>
                <div><dt class="text-xs font-bold uppercase tracking-wider text-slate-400">Téléphone</dt><dd class="mt-1"><a class="font-semibold text-blue-700 hover:underline" href="tel:<?= htmlspecialchars($candidature['telephone'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($candidature['telephone'], ENT_QUOTES, 'UTF-8') ?></a></dd></div>
                <div><dt class="text-xs font-bold uppercase tracking-wider text-slate-400">Domaine</dt><dd class="mt-1 font-semibold text-slate-700"><?= htmlspecialchars($domaines[$candidature['domaine']] ?? ucfirst($candidature['domaine'] ?? ''), ENT_QUOTES, 'UTF-8') ?></dd></div>
                <div><dt class="text-xs font-bold uppercase tracking-wider text-slate-400">Date de réception</dt><dd class="mt-1 font-semibold text-slate-700"><?= date('d/m/Y à H:i', strtotime($candidature['date_candidature'])) ?></dd></div>
            </dl>
            <div class="mt-7"><h2 class="text-xs font-bold uppercase tracking-wider text-slate-400">Message</h2><p class="mt-2 whitespace-pre-line text-sm leading-relaxed text-slate-700"><?= !empty($candidature['message']) ? nl2br(htmlspecialchars($candidature['message'], ENT_QUOTES, 'UTF-8')) : 'Aucun message fourni.' ?></p></div>
            <div class="mt-7 border-t border-slate-100 pt-6">
                <h2 class="font-jakarta text-lg font-extrabold text-[#111c33]">Pièces jointes</h2>
                <?php if (!$candidature['documents']): ?>
                    <p class="mt-2 text-sm text-slate-500">Aucun fichier joint.</p>
                <?php else: ?>
                    <ul class="mt-3 space-y-2">
                        <?php foreach ($candidature['documents'] as $document): ?>
                            <li><a class="inline-flex items-center gap-2 rounded-lg bg-blue-50 px-4 py-2.5 text-sm font-bold text-blue-700 hover:bg-blue-100" href="<?= htmlspecialchars($document['chemin'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener"><?= htmlspecialchars($document['type'] === 'cv' ? 'CV' : 'Lettre de motivation', ENT_QUOTES, 'UTF-8') ?> — <?= htmlspecialchars($document['nom_original'], ENT_QUOTES, 'UTF-8') ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </section>
    </main>
</div>
</body>
</html>
