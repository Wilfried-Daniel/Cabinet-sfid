<main class="relative w-full">

    <!-- // offre section -->
    <?php require_once __DIR__ . '/../components/offres/titre_section.php'; ?>

    <!-- candidature posts -->
    <?php require_once __DIR__ . '/../components/offres/candidature_posts.php'; ?>
    <?php require_once __DIR__ . '/../components/offres/form_posts.php'; ?>
    
    <!-- candidature spontanée -->
    <?php require_once __DIR__ . '/../components/offres/candidature_spontanee.php'; ?>
    <?php require_once __DIR__ . '/../components/offres/form_spontanee.php'; ?>

</main>

<script>
    <?php if (!empty($offrePostErrors)): ?>
    document.getElementById('poste-nom').value = <?= json_encode($offrePostForm['nom_complet'] ?? '', JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
    document.getElementById('poste-email').value = <?= json_encode($offrePostForm['email'] ?? '', JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
    document.getElementById('poste-telephone').value = <?= json_encode($offrePostForm['telephone'] ?? '', JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
    document.getElementById('poste-intitule').value = <?= json_encode($selectedOffreTitle ?? '', JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
    document.getElementById('poste-offre-id').value = <?= json_encode($offrePostForm['offre_id'] ?? '', JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
    document.getElementById('form-postes').showModal();
    <?php endif; ?>
    document.querySelectorAll('[data-open-modal]').forEach((button) => {
        button.addEventListener('click', () => {
            if (button.dataset.offreId) {
                document.getElementById('poste-offre-id').value = button.dataset.offreId;
                document.getElementById('poste-intitule').value = button.dataset.offreTitre;
            }
            document.getElementById(button.dataset.openModal)?.showModal();
        });
    });

    document.querySelectorAll('dialog').forEach((modal) => {
        modal.querySelector('[data-close-modal]')?.addEventListener('click', () => modal.close());
        modal.addEventListener('click', (event) => {
            if (event.target === modal) modal.close();
        });
    });
</script>
