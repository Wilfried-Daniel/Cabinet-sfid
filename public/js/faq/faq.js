document.querySelectorAll('.faq-item').forEach((item) => {
    const trigger = item.querySelector('.faq-trigger');
    const panel = item.querySelector('.faq-panel');
    const icon = item.querySelector('.faq-icon');
    const title = item.querySelector('.faq-title');

    trigger.addEventListener('click', () => {
        const isOpen = panel.classList.contains('grid-rows-[1fr]');

        // Ferme tous les autres items (comportement accordéon exclusif)
        document.querySelectorAll('.faq-item').forEach((other) => {
            if (other !== item) {
                other.querySelector('.faq-panel').classList.remove('grid-rows-[1fr]');
                other.querySelector('.faq-panel').classList.add('grid-rows-[0fr]');
                other.querySelector('.faq-icon').classList.remove('rotate-180', 'bg-purple-200', 'text-slate-900');
                other.querySelector('.faq-icon').classList.add('bg-slate-900', 'text-white');
                other.classList.remove('bg-white', 'shadow-sm', 'dark:bg-blue-200');
                other.classList.add('bg-white/60', 'dark:bg-[#313966]');
            }

            // <--- 2. Remet le titre en blanc/clair pour les autres éléments fermés
            const otherTitle = other.querySelector('.faq-title');
            if (otherTitle) {
                otherTitle.classList.remove('dark:text-slate-900');
                otherTitle.classList.add('dark:text-slate-200');
            }
        });

        // Toggle l'item cliqué
        if (isOpen) {
            panel.classList.remove('grid-rows-[1fr]');
            panel.classList.add('grid-rows-[0fr]');
            icon.classList.remove('rotate-180', 'bg-purple-200', 'text-slate-900');
            icon.classList.add('bg-slate-900', 'text-white');
            item.classList.remove('bg-white', 'shadow-sm', 'dark:bg-blue-200');
            item.classList.add('bg-white/60', 'dark:bg-[#313966]');

            // <--- 3. Titre devient blanc/clair en mode sombre
            title.classList.remove('dark:text-slate-900');
            title.classList.add('dark:text-slate-200');
        } else {
            panel.classList.remove('grid-rows-[0fr]');
            panel.classList.add('grid-rows-[1fr]');
            icon.classList.add('bg-purple-200', 'text-slate-900');
            icon.classList.remove('bg-slate-900', 'text-white');
            item.classList.add('bg-white', 'shadow-sm', 'dark:bg-blue-200');
            item.classList.remove('bg-white/60', 'dark:bg-[#313966]');

            // <--- 4. Titre devient sombre pour être lisible sur fond bleu clair (dark:bg-blue-200)
            title.classList.remove('dark:text-slate-200');
            title.classList.add('dark:text-slate-900');
        }
    });
});