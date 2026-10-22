<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet SFID</title>

    <!-- lien css tailwind compilé -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Le favicon -->
    <link rel="shortcut icon" href="images/logo.webp" type="image/x-icon">

    <!-- POLICE -->
    <!-- Police PLUS JAKARTA SANS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <!-- Police INTER -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Police CARDO -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Police BEBAS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!-- SCRIPT JAVASCRIPT -->
    <!-- Script pour l'anim du header (ABSOLUTE à STICKY) -->
    <script src="js/header/header.js" defer></script>

    <!-- Script pour rendre dynamique la section témoignages -->
    <script src="js/testimony/testimony.js" defer></script>

    <!-- Script pour rendre dynamique la section faq -->
    <script src="js/faq/faq.js" defer></script>

    <!-- Script pour alimenter le btn de schroll auto vers le haut -->
    <script src="js/header/schroll-to-top.js" defer></script>

    <!-- Script Bouton pour le Dark mode -->
    <script src="js/dark-mode/dark.js" defer></script>

    <!-- Script de validation du formulaire de contact -->
    <script src="js/validation-contact-form/validation-form.js" defer></script>

    <!-- Script de validation du formulaire de candidature spontanée -->
    <script src="js/validation-candidature/spontanee/validation-spontanee.js" defer></script>
    
    <!-- Script de validation du formulaire de candidature spontanée -->
    <script src="js/validation-candidature/offre/validation-offre.js" defer></script>

    <!-- Librairie AOS pour animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>
    <script src="js/aos-animate/aos.js" defer></script>

</head>

<body>
    <!-- L'élément témoin invisible (Observer Trigger) placé tout en haut de la page -->
    <div id="scroll-trigger" class="absolute top-0 left-0 w-full h-1 pointer-events-none"></div>

    <!-- Barre de Navigation Absolue (Par-dessus le Hero) -->
    <header id="main-header" class="absolute top-4 left-4 right-4 lg:top-10 xl:left-20 xl:right-20 2xl:left-50 2xl:right-50 z-50 bg-white/10 backdrop-blur-2xl rounded-5xl flex items-center justify-center transition-all duration-500 ease-out shadow-sm border border-white/5">
        <div class="w-full mx-auto px-4 md:px-10 py-3 md:py-4">
            <div class="flex justify-between items-center">
                <!-- Logo en Blanc -->
                <div class="shrink-0 h-8 flex items-center">
                    <a href="index.php?page=accueil" class="text-white font-jakarta text-lg 2xl:text-xl h-full font-black flex items-center gap-3">
                        <img src="images/logo.webp" class="object-contain rounded-md w-full h-full" alt="logo du cabinet sfid">
                        <p class="hidden sm:flex sm:gap-1">Cabinet<span class="text-blue-500">SFID</span></p>
                    </a>
                </div>

                <!-- BOUTON BURGER (Visible uniquement sur Mobile) -->
                <!-- Astuce CSS : Un label lié à un input checkbox pour ouvrir le menu sans JS -->
                <input type="checkbox" id="menu-toggle" class="peer hidden" />
                <label for="menu-toggle" class="flex flex-col gap-1.5 md:hidden cursor-pointer z-50 text-white p-2">
                    <span class="w-6 h-0.5 bg-white rounded transition-all peer-checked:rotate-45 peer-checked:translate-y-2"></span>
                    <span class="w-6 h-0.5 bg-white rounded transition-all peer-checked:opacity-0"></span>
                    <span class="w-6 h-0.5 bg-white rounded transition-all peer-checked:-rotate-45 peer-checked:-translate-y-2"></span>
                </label>

                <!-- Liens du Menu en Blanc -->
                <nav class="absolute top-full left-0 right-0 mt-2 hidden peer-checked:flex flex-col bg-slate-900/95 backdrop-blur-xl rounded-2xl p-6 space-y-4 shadow-xl border border-white/10 md:relative md:top-auto md:left-auto md:right-auto md:mt-0 md:flex md:flex-row md:bg-transparent md:backdrop-blur-none md:p-0 md:space-y-0 md:space-x-4 2xl:space-x-8 md:border-none md:shadow-none">
                    <a href="index.php?page=accueil" class="<?php echo ($page ??
                        '') ===
                    'accueil'
                        ? 'text-sm border-b-2 border-white/70 pb-1 text-white font-semibold'
                        : 'text-white/80 hover:text-white font-medium text-sm transition'; ?>">Accueil</a>
                    <a href="index.php?page=apropos" class="<?php echo ($page ??
                        '') ===
                    'apropos'
                        ? 'text-sm border-b-2 border-white/70 pb-1 text-white font-semibold'
                        : 'text-white/80 hover:text-white font-medium text-sm transition'; ?>">A propos</a>
                    <a href="index.php?page=services" class="<?php echo ($page ??
                        '') ===
                    'services'
                        ? 'text-sm border-b-2 border-white/70 pb-1 text-white font-semibold'
                        : 'text-white/80 hover:text-white font-medium text-sm transition'; ?>">Nos services</a>
                    <a href="index.php?page=contact" class="<?php echo ($page ??
                        '') ===
                    'contact'
                        ? 'text-sm border-b-2 border-white/70 pb-1 text-white font-semibold'
                        : 'text-white/80 hover:text-white font-medium text-sm transition'; ?>">Contact</a>
                    <a href="index.php?page=offres" class="<?php echo ($page ??
                        '') ===
                    'offres'
                        ? 'text-sm border-b-2 border-white/70 pb-1 text-white font-semibold'
                        : 'text-white/80 hover:text-white font-medium text-sm transition'; ?>">Carrière</a>
                </nav>

                <!-- mode sombre et cta -->
                <div class="hidden sm:flex items-center justify-center gap-3">
                    <!-- icone dark/light mode -->
                    <button
                        type="button"
                        id="theme-toggle"
                        aria-label="Mode sombre / clair"
                        class="border border-white/50 p-1.5 rounded-xl cursor-pointer hover:bg-white/10 transition-colors">
                        <!-- Icône Soleil : visible uniquement en mode sombre (pour repasser en clair) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden dark:block text-amber-400 dark:text-white/80 size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>

                        <!-- Icône Lune : visible uniquement en mode clair (pour passer en sombre) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block dark:hidden text-white/80 size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>
                    </button>
                    <!-- bouton cta -->
                    <a href="index.php?page=contact">
                        <button class="flex items-center gap-2 font-inter font-medium bg-violet-300 rounded-2xl px-3 py-1.5 hover:bg-violet-200 cursor-pointer transition-colors duration-300">
                            <!-- Le cercle blanc sans bordure -->
                            <div class="flex items-center justify-center w-6 h-6 bg-white rounded-full border-none shadow-sm">
                                <!-- L'icône contenant uniquement la flèche (sans le cercle autour) -->
                                <svg xmlns="http://www.w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-900">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                            <span class="text-sm 2xl:text-md">Nous contacter</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- bouton pour remonter -->
    <button
        id="scrollToTopBtn"
        aria-label="Remonter en haut de la page"
        class="fixed cursor-pointer bottom-10 right-10 z-50 flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg opacity-0 pointer-events-none transition-all duration-300 hover:-translate-y-1 hover:bg-blue-700 focus:outline-none">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>
    </button>