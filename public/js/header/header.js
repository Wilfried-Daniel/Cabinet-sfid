// SCRIPT QUI MET LE HEADER EN STICKY QD ON SCHROLLE CAR IL EST EN ABSOLUTE DE BASE

const header = document.getElementById('main-header');
const trigger = document.getElementById('scroll-trigger');

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (!entry.isIntersecting) {
            // L'utilisateur a défilé : transformation fluide en bandeau fixé
            // On conserve le backdrop-blur-2xl et on utilise un fond blanc transparent ultra-léger (bg-white/5) avec une ombre portée
            header.classList.remove('absolute', 'top-4', 'left-4', 'right-4', 'lg:top-10', 'xl:left-20', 'xl:right-20', '2xl:left-50', '2xl:right-50', 'rounded-4xl', 'bg-white/10');
            header.classList.add('fixed', 'top-0', 'left-0', 'right-0', 'rounded-none', 'bg-blue-950/50', 'shadow-md', 'border-b', 'border-white/10');
        } else {
            // Retour tout en haut : reprise de la forme capsule d'origine
            header.classList.remove('fixed', 'top-0', 'left-0', 'right-0', 'rounded-none', 'bg-white/5', 'shadow-md', 'border-b', 'border-white/10');
            header.classList.add('absolute', 'top-4', 'left-4', 'right-4', 'lg:top-10', 'xl:left-20', 'xl:right-20', '2xl:left-50', '2xl:right-50', 'rounded-4xl', 'bg-white/10');
        }
    });
}, {
    threshold: 0
});

observer.observe(trigger);
