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
    document.querySelectorAll('[data-open-modal]').forEach((button) => {
        button.addEventListener('click', () => document.getElementById(button.dataset.openModal)?.showModal());
    });

    document.querySelectorAll('dialog').forEach((modal) => {
        modal.querySelector('[data-close-modal]')?.addEventListener('click', () => modal.close());
        modal.addEventListener('click', (event) => {
            if (event.target === modal) modal.close();
        });
    });
</script>
