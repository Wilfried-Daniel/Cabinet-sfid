const scrollToTopBtn = document.getElementById('scrollToTopBtn');

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
        scrollToTopBtn.classList.add('opacity-100', 'pointer-events-auto');
    } else {
        scrollToTopBtn.classList.remove('opacity-100', 'pointer-events-auto');
        scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
    }
});

scrollToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});