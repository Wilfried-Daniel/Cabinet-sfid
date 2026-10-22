<?php $admin_active_page = $admin_active_page ?? 'stats'; ?>

<aside
    class="fixed inset-y-0 left-0 z-30 hidden w-1/5 min-w-64 max-w-80 flex-col border-r border-white/10 bg-[#111c33] px-5 py-7 text-white lg:flex">
    <a class="flex items-center gap-3 px-2" href="index.php?page=dashboard" aria-label="Accueil du dashboard SFID">
        <span class="grid size-11 place-items-center rounded-xl bg-white p-1.5 shadow-lg shadow-black/15">
            <img class="size-full rounded-lg object-contain" src="images/logo.webp" alt="Logo SFID">
        </span>
        <span class="font-jakarta text-base font-extrabold tracking-tight">Cabinet <span
                class="text-violet-300">SFID</span></span>
    </a>

    <p class="mt-12 px-2 text-[.68rem] font-bold tracking-[.16em] text-white/40 uppercase">Administration</p>
    <nav class="mt-4 space-y-1.5" aria-label="Navigation administrateur">
        <a href="index.php?page=dashboard"
            class="<?= $admin_active_page === 'stats'
                ? 'bg-white/10 text-white shadow-sm'
                : 'text-white/65 hover:bg-white/5 hover:text-white' ?> flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">
                <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                <rect x="14" y="14" width="6" height="6" rx="1"></rect>
            </svg>
            Vue d'ensemble
        </a>
        <a href="index.php?page=candidatures"
            class="<?= $admin_active_page === 'candidatures'
                ? 'bg-white/10 text-white shadow-sm'
                : 'text-white/65 hover:bg-white/5 hover:text-white' ?> flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            Candidatures
            <span
                class="ml-auto rounded-full bg-violet-300 px-2 py-0.5 text-[.68rem] font-bold text-[#111c33]">12</span>
        </a>
        <a href="index.php?page=spontanee"
            class="<?= $admin_active_page === 'spontanee'
                ? 'bg-white/10 text-white shadow-sm'
                : 'text-white/65 hover:bg-white/5 hover:text-white' ?> flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">
                <path d="M21 15a4 4 0 0 1-4 4H7l-4 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4Z"></path>
                <path d="M8 9h8M8 13h5"></path>
            </svg>
            Spontanées
            <span class="ml-auto rounded-full bg-white/10 px-2 py-0.5 text-[.68rem] font-bold text-white/80">08</span>
        </a>
        <a href="index.php?page=ajouter-offre"
            class="<?= $admin_active_page === 'offres'
                ? 'bg-white/10 text-white shadow-sm'
                : 'text-white/65 hover:bg-white/5 hover:text-white' ?> flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">
                <rect x="3" y="7" width="18" height="13" rx="2"></rect>
                <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 12h18"></path>
            </svg>
            Offres d'emploi
        </a>
    </nav>

    <div class="mt-auto border-t border-white/10 pt-5">
        <a href="index.php?page=accueil"
            class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-white/65 transition hover:bg-white/5 hover:text-white">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
            Voir le site
        </a>
        <form action="index.php?page=logout" method="POST" class="w-full">
            <button type="submit"
                class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-white/65 transition hover:bg-white/5 hover:text-white">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                    aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                Déconnexion
            </button>
        </form>
        <a href="index.php?page=profil"
            class="mt-3 flex items-center gap-3 rounded-xl bg-white/5 px-3 py-3 transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-violet-300"
            aria-label="Modifier mon profil administrateur">
            <span
                class="grid size-9 place-items-center rounded-full bg-violet-300 font-jakarta text-sm font-extrabold text-[#111c33]">A</span>
            <span class="min-w-0">
                <span class="block truncate text-sm font-bold">Administrateur</span>
                <span class="block truncate text-xs text-white/50">Cabinet SFID</span>
            </span>
            <svg class="ml-auto size-4 shrink-0 text-white/55" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" aria-hidden="true">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </a>
    </div>
</aside>

<header
    class="fixed inset-x-0 top-0 z-30 flex h-18 items-center justify-between border-b border-slate-200 bg-white/95 px-5 backdrop-blur lg:hidden">
    <a class="flex items-center gap-2" href="index.php?page=dashboard">
        <img class="size-10 rounded-xl object-contain" src="images/logo.webp" alt="Logo SFID">
        <span class="font-jakarta text-sm font-extrabold">Cabinet SFID</span>
    </a>
    <button
        class="inline-flex items-center gap-2 rounded-xl bg-[#111c33] px-3 py-2 text-xs font-bold text-white transition hover:bg-[#1d3159] focus:outline-none focus:ring-4 focus:ring-blue-600/20"
        type="button" data-admin-menu-toggle aria-controls="admin-mobile-menu" aria-expanded="false">
        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path d="M4 7h16M4 12h16M4 17h16"></path>
        </svg>
        Menu
    </button>
</header>

<div class="fixed inset-0 z-40 hidden bg-slate-950/45 opacity-0 transition-opacity duration-300 lg:hidden"
    data-admin-menu-backdrop></div>
<aside id="admin-mobile-menu"
    class="fixed inset-y-0 left-0 z-50 hidden w-[min(19rem,calc(100vw-3rem))] -translate-x-full flex-col bg-[#111c33] px-5 py-6 text-white shadow-2xl transition-transform duration-300 lg:hidden"
    aria-label="Navigation administrateur" aria-hidden="true">
    <div class="flex items-center justify-between gap-4">
        <a class="flex min-w-0 items-center gap-3" href="index.php?page=dashboard">
            <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-white p-1.5"><img
                    class="size-full rounded-lg object-contain" src="images/logo.webp" alt="Logo SFID"></span>
            <span class="truncate font-jakarta text-sm font-extrabold">Cabinet <span
                    class="text-violet-300">SFID</span></span>
        </a>
        <button
            class="grid size-10 shrink-0 place-items-center rounded-xl text-white/75 transition hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-violet-300"
            type="button" data-admin-menu-close aria-label="Fermer le menu">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                aria-hidden="true">
                <path d="m6 6 12 12M18 6 6 18"></path>
            </svg>
        </button>
    </div>

    <p class="mt-10 px-2 text-[.68rem] font-bold tracking-[.16em] text-white/40 uppercase">Administration</p>
    <nav class="mt-4 space-y-1.5">
        <a href="index.php?page=dashboard"
            class="<?= $admin_active_page === 'stats'
                ? 'bg-white/10 text-white'
                : 'text-white/65 hover:bg-white/5 hover:text-white' ?> flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition"><svg
                class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">
                <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                <rect x="14" y="14" width="6" height="6" rx="1"></rect>
            </svg>Vue d'ensemble</a>
        <a href="index.php?page=candidatures"
            class="<?= $admin_active_page === 'candidatures'
                ? 'bg-white/10 text-white'
                : 'text-white/65 hover:bg-white/5 hover:text-white' ?> flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition"><svg
                class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>Candidatures <span
                class="ml-auto rounded-full bg-violet-300 px-2 py-0.5 text-[.68rem] font-bold text-[#111c33]">12</span></a>
        <a href="index.php?page=spontanee"
            class="<?= $admin_active_page === 'spontanee'
                ? 'bg-white/10 text-white'
                : 'text-white/65 hover:bg-white/5 hover:text-white' ?> flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition"><svg
                class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">
                <path d="M21 15a4 4 0 0 1-4 4H7l-4 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4Z"></path>
                <path d="M8 9h8M8 13h5"></path>
            </svg>Candidatures spontanées <span
                class="ml-auto rounded-full bg-white/10 px-2 py-0.5 text-[.68rem] font-bold text-white/80">08</span></a>
        <a href="index.php?page=ajouter-offre"
            class="<?= $admin_active_page === 'offres'
                ? 'bg-white/10 text-white'
                : 'text-white/65 hover:bg-white/5 hover:text-white' ?> flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition"><svg
                class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">
                <rect x="3" y="7" width="18" height="13" rx="2"></rect>
                <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 12h18"></path>
            </svg>Offres d'emploi</a>
    </nav>

    <div class="mt-auto border-t border-white/10 pt-5">
        <a href="index.php?page=profil"
            class="flex items-center gap-3 rounded-xl bg-white/5 px-3 py-3 transition hover:bg-white/10"><span
                class="grid size-9 place-items-center rounded-full bg-violet-300 font-jakarta text-sm font-extrabold text-[#111c33]">A</span><span
                class="min-w-0"><span class="block truncate text-sm font-bold">Administrateur</span><span
                    class="block truncate text-xs text-white/50">Modifier mon profil</span></span><svg
                class="ml-auto size-4 shrink-0 text-white/55" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" aria-hidden="true">
                <path d="m9 18 6-6-6-6"></path>
            </svg></a>
        <a href="index.php?page=accueil"
            class="mt-2 flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-white/65 transition hover:bg-white/5 hover:text-white"><svg
                class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                aria-hidden="true">
                <path d="m15 18-6-6 6-6"></path>
            </svg>Voir le site</a>
        <form action="index.php?page=logout" method="POST" class="w-full">
            <button type="submit"
                class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-white/65 transition hover:bg-white/5 hover:text-white">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                    aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                Déconnexion
            </button>
        </form>
    </div>
</aside>

<script>
    (() => {
        const toggle = document.querySelector('[data-admin-menu-toggle]');
        const drawer = document.querySelector('#admin-mobile-menu');
        const backdrop = document.querySelector('[data-admin-menu-backdrop]');
        const closeButton = drawer?.querySelector('[data-admin-menu-close]');
        if (!toggle || !drawer || !backdrop || !closeButton) return;

        const closeMenu = () => {
            drawer.classList.add('-translate-x-full');
            backdrop.classList.remove('opacity-100');
            toggle.setAttribute('aria-expanded', 'false');
            drawer.setAttribute('aria-hidden', 'true');
            window.setTimeout(() => {
                drawer.classList.add('hidden');
                backdrop.classList.add('hidden');
            }, 300);
        };
        const openMenu = () => {
            backdrop.classList.remove('hidden');
            drawer.classList.remove('hidden');
            requestAnimationFrame(() => {
                backdrop.classList.add('opacity-100');
                drawer.classList.remove('-translate-x-full');
            });
            toggle.setAttribute('aria-expanded', 'true');
            drawer.setAttribute('aria-hidden', 'false');
            closeButton.focus();
        };

        toggle.addEventListener('click', openMenu);
        closeButton.addEventListener('click', closeMenu);
        backdrop.addEventListener('click', closeMenu);
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
                closeMenu();
                toggle.focus();
            }
        });
    })();
</script>