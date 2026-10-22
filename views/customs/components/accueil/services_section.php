<section aria-label="Services section SFID" class="w-full bg-gray-200 py-10 px-6 md:py-22 md:px-12 lg:px-24 transition-colors duration-500 dark:bg-blue-950/90">
    <div class="max-w-7xl mx-auto">

        <!-- Bloc Titre : Titre principal -->
        <div class="mb-12" data-aos="fade-up" data-aos-duration="1500">
            <span class="font-bebas text-sm tracking-widest text-blue-600 uppercase block mb-6 md:text-md lg:text-lg">
                -- Nos services
            </span>
            <div class="flex items-end justify-between">
                <h2 class="font-cardo font-semibold text-3xl md:text-5xl xl:text-6xl text-[#001b4b] leading-none transition-colors duration-500 dark:text-white">
                    Huit pôles, un seul dossier<br>
                    à suivre.
                </h2>
                <a href="index.php?page=services">
                    <button class="flex items-center gap-2 cursor-pointer md:py-3 md:text-sm bg-blue-950 rounded-xl text-white transition-colors duration-300 hover:bg-blue-900 px-4 py-1.5 text-[12px] dark:bg-transparent dark:border dark:border-gray-400 dark:hover:bg-gray-200 dark:hover:text-[#111c33]">
                        Tous les services
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right">
                            <path d="M18 8L22 12L18 16" />
                            <path d="M2 12H22" />
                        </svg>
                    </button>
                </a>
            </div>
        </div>

        <!-- Bloc contenu: grille des services -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3 lg:col-span-7 items-start">

            <!-- carte 1 : création d'entreprise -->
            <?php require_once __DIR__ . '/sous-components/services_section/creation-entreprise.php'; ?>

            <!-- carte 2 : assistance comptable & fiscale -->
            <?php require_once __DIR__ . '/sous-components/services_section/assistance-comptable.php'; ?>

            <!-- carte 3 : assistance juridique et sociale -->
            <?php require_once __DIR__ . '/sous-components/services_section/assistance-juridique.php'; ?>

            <!-- carte 4 : recherche de financement -->
            <?php require_once __DIR__ . '/sous-components/services_section/recherche-fin.php'; ?>

            <!-- carte 5 : etats financiers -->
            <?php require_once __DIR__ . '/sous-components/services_section/etats-fin.php'; ?>

            <!-- carte 6 : formation -->
            <?php require_once __DIR__ . '/sous-components/services_section/formation-pro.php'; ?>
        </div>

    </div>
</section>