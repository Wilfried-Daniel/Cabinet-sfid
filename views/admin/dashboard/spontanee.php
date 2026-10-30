<?php
$admin_page_title = 'Candidatures spontanées';
$admin_active_page = 'spontanee';
require_once __DIR__ . '/../partials/header.php';

// Mappage des slugs de domaines vers des libellés lisibles
$domaines_labels = [
    'comptabilite-fiscalite' => 'Comptabilité & Fiscalité',
    'juridique-social' => 'Juridique & Social',
    'communication' => 'Communication & Marketing',
    'finance' => 'Finance & Gestion',
    'autre' => 'Autre domaine',
];

// Fonction d'extraction des initiales
function getInitiales(string $nom): string
{
    $mots = array_filter(explode(' ', trim($nom)));
    $initiales = strtoupper(substr($mots[0] ?? '', 0, 1));
    if (count($mots) > 1) {
        $initiales .= strtoupper(substr(end($mots), 0, 1));
    }
    return $initiales ?: 'C';
}

// Couleurs d'avatars dynamiques
$colors = [
    ['bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
    ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700'],
    ['bg' => 'bg-rose-100', 'text' => 'text-rose-700'],
    ['bg' => 'bg-amber-100', 'text' => 'text-amber-700'],
    ['bg' => 'bg-violet-100', 'text' => 'text-violet-700'],
];
?>

<div class="min-h-screen lg:pl-[20%]">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>
    <main class="px-5 pt-26 pb-10 sm:px-8 lg:px-10 lg:pt-11 xl:px-14">
        
        <!-- En-tête -->
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-bold tracking-[.14em] text-blue-600 uppercase">Recrutement</p>
                <h1 class="mt-2 font-jakarta text-3xl font-extrabold tracking-[-.045em] text-[#111c33]">Candidatures spontanées</h1>
                <p class="mt-2 text-sm text-slate-500">Découvrez les profils qui souhaitent rejoindre le Cabinet SFID.</p>
            </div>
            <span class="w-max rounded-xl bg-violet-100 px-4 py-2.5 text-sm font-bold text-violet-700">
                <?= sprintf(
                    '%d',
                    ($totalCandidatures ?? 0),
                ) ?> profil(s) reçu(s)
            </span>
        </div>

        <!-- Grille des cartes -->
        <section id="cards-grid" class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            
            <?php if (!empty($candidatures)): ?>
                <?php foreach ($candidatures as $index => $item):

                    $color = $colors[$index % count($colors)];
                    $domaineLabel =
                        $domaines_labels[$item['domaine']] ??
                        ucfirst($item['domaine']);
                    $initiales = getInitiales($item['nom_complet']);
                    $dateCandidature = date(
                        'd/m/Y à H:i',
                        strtotime($item['date_candidature']),
                    );
                    ?>
                    <article class="flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div>
                            <!-- Header de la carte : Avatars + Badge Domaine -->
                            <div class="flex items-start justify-between gap-2">
                                <span class="grid size-13 place-items-center rounded-2xl <?= $color[
                                    'bg'
                                ] ?> font-jakarta text-lg font-extrabold <?= $color[
     'text'
 ] ?>">
                                    <?= htmlspecialchars($initiales) ?>
                                </span>
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-700">
                                    <?= htmlspecialchars($domaineLabel) ?>
                                </span>
                            </div>

                            <!-- Nom & Contact -->
                            <h2 class="mt-5 font-jakarta text-xl font-extrabold tracking-tight text-slate-900">
                                <?= htmlspecialchars($item['nom_complet']) ?>
                            </h2>
                            <p class="mt-1 text-xs font-medium text-slate-500">
                                <?= htmlspecialchars(
                                    $item['email'],
                                ) ?> • <?= htmlspecialchars(
     $item['telephone'],
 ) ?>
                            </p>

                            <!-- Extrait du message de motivation -->
                            <?php if (!empty($item['message'])): ?>
                                <p class="mt-3 text-sm text-slate-600 line-clamp-2 italic">
                                    « <?= htmlspecialchars(
                                        $item['message'],
                                    ) ?> »
                                </p>
                            <?php endif; ?>

                            <!-- Badges des Pièces Jointes -->
                            <div class="mt-4 flex flex-wrap gap-2">
                                <?php if (!empty($item['has_cv'])): ?>
                                    <span class="inline-flex items-center gap-1 rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700 border border-blue-100">
                                        📄 CV joint
                                    </span>
                                <?php endif; ?>
                                <?php if (!empty($item['has_lm'])): ?>
                                    <span class="inline-flex items-center gap-1 rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 border border-emerald-100">
                                        ✉️ Lettre motiv.
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Footer de la carte -->
                        <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4">
                            <span class="text-xs text-slate-400">
                                Reçue le <?= $dateCandidature ?>
                            </span>
                            <a href="index.php?page=admin-candidature-detail&id=<?= $item[
                                'id'
                            ] ?>" class="text-sm font-bold text-blue-600 transition hover:text-blue-800">
                                Voir le profil →
                            </a>
                        </div>
                    </article>
                <?php
                endforeach; ?>

            <?php else: ?>
                <!-- État vide si aucune candidature -->
                <div class="col-span-full rounded-2xl border border-dashed border-slate-200 bg-white p-12 text-center">
                    <p class="text-slate-500 font-medium">Aucune candidature spontanée reçue pour le moment.</p>
                </div>
            <?php endif; ?>

        </section>

        <!-- Bouton Voir Plus -->
        <div id="load-more-wrapper" class="mt-8 flex justify-center <?= $hasMore ??
        false
            ? ''
            : 'hidden' ?>">
            <button id="btn-load-more" data-offset="6" class="flex items-center gap-2 rounded-2xl border border-slate-300 bg-white px-8 py-3.5 font-bold text-slate-700 shadow-sm transition hover:border-blue-600 hover:bg-blue-50 hover:text-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-600/10">
                <span>Voir 6 profils suivants</span>
                <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"></path></svg>
            </button>
        </div>
    </main>
</div>





<!-- Script AJAX -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnLoadMore = document.getElementById('btn-load-more');
    const loadMoreWrapper = document.getElementById('load-more-wrapper');
    const cardsGrid = document.getElementById('cards-grid');

    const domainLabels = {
        'comptabilite-fiscalite': 'Comptabilité & Fiscalité',
        'juridique-social': 'Juridique & Social',
        'communication': 'Communication & Marketing',
        'finance': 'Finance & Gestion',
        'autre': 'Autre domaine'
    };

    const colors = [
        {bg: 'bg-blue-100', text: 'text-blue-700'},
        {bg: 'bg-emerald-100', text: 'text-emerald-700'},
        {bg: 'bg-rose-100', text: 'text-rose-700'},
        {bg: 'bg-amber-100', text: 'text-amber-700'},
        {bg: 'bg-violet-100', text: 'text-violet-700'}
    ];

    let currentCardIndex = <?= count($candidatures ?? []) ?>;

    function getInitiales(nom) {
        const mots = nom.trim().split(' ').filter(Boolean);
        let init = (mots[0] || '').charAt(0).toUpperCase();
        if (mots.length > 1) {
            init += mots[mots.length - 1].charAt(0).toUpperCase();
        }
        return init || 'C';
    }

    function formatDate(dateStr) {
        const d = new Date(dateStr);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        const hours = String(d.getHours()).padStart(2, '0');
        const minutes = String(d.getMinutes()).padStart(2, '0');
        return `${day}/${month}/${year} à ${hours}:${minutes}`;
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }

    if (btnLoadMore) {
        btnLoadMore.addEventListener('click', function () {
            const offset = parseInt(btnLoadMore.getAttribute('data-offset'));
            btnLoadMore.disabled = true;
            btnLoadMore.innerHTML = `<span>Chargement...</span>`;

            fetch(`index.php?page=spontanee&ajax=1&offset=${offset}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.candidatures.length > 0) {
                        data.candidatures.forEach((item) => {
                            const color = colors[currentCardIndex % colors.length];
                            currentCardIndex++;
                            const domaineLabel = domainLabels[item.domaine] || item.domaine;
                            const initiales = getInitiales(item.nom_complet);
                            const dateFormatted = formatDate(item.date_candidature);

                            const article = document.createElement('article');
                            article.className = "flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg";
                            article.innerHTML = `
                                <div>
                                    <div class="flex items-start justify-between gap-2">
                                        <span class="grid size-13 place-items-center rounded-2xl ${color.bg} font-jakarta text-lg font-extrabold ${color.text}">
                                            ${initiales}
                                        </span>
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-700">
                                            ${escapeHtml(domaineLabel)}
                                        </span>
                                    </div>

                                    <h2 class="mt-5 font-jakarta text-xl font-extrabold tracking-tight text-slate-900">
                                        ${escapeHtml(item.nom_complet)}
                                    </h2>
                                    <p class="mt-1 text-xs font-medium text-slate-500">
                                        ${escapeHtml(item.email)} • ${escapeHtml(item.telephone)}
                                    </p>

                                    ${item.message ? `<p class="mt-3 text-sm text-slate-600 line-clamp-2 italic">« ${escapeHtml(item.message)} »</p>` : ''}

                                    <div class="mt-4 flex flex-wrap gap-2">
                                        ${item.has_cv == 1 ? `<span class="inline-flex items-center gap-1 rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700 border border-blue-100">📄 CV joint</span>` : ''}
                                        ${item.has_lm == 1 ? `<span class="inline-flex items-center gap-1 rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 border border-emerald-100">✉️ Lettre motiv.</span>` : ''}
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4">
                                    <span class="text-xs text-slate-400">
                                        Reçue le ${dateFormatted}
                                    </span>
                                    <a href="index.php?page=admin-candidature-detail&id=${item.id}" class="text-sm font-bold text-blue-600 transition hover:text-blue-800">
                                        Voir le profil →
                                    </a>
                                </div>
                            `;
                            cardsGrid.appendChild(article);
                        });

                        btnLoadMore.setAttribute('data-offset', offset + 6);

                        if (!data.hasMore) {
                            loadMoreWrapper.classList.add('hidden');
                        } else {
                            btnLoadMore.disabled = false;
                            btnLoadMore.innerHTML = `<span>Voir 6 profils suivants</span><svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"></path></svg>`;
                        }
                    } else {
                        loadMoreWrapper.classList.add('hidden');
                    }
                })
                .catch(err => {
                    console.error('Erreur lors du chargement des profils :', err);
                    btnLoadMore.disabled = false;
                    btnLoadMore.innerHTML = `<span>Erreur, réamorcez</span>`;
                });
        });
    }
});
</script>
</body>
</html>