<section aria-label="Processus SFID" id="processus" class="w-full bg-gray-200 py-10 px-6 md:py-22 md:px-12 lg:px-24 transition-colors duration-500 dark:bg-blue-950/90">
    <div class="max-w-7xl mx-auto">

        <!-- Bloc Titre : Titre principal -->
        <div class="mb-14" data-aos="fade-up" data-aos-duration="1500">
            <span class="font-bebas text-sm tracking-widest text-blue-600 uppercase block mb-6 md:text-md lg:text-lg">
                -- Notre processus
            </span>
            <div class="">
                <h2 class="font-cardo font-semibold text-3xl md:text-5xl xl:text-6xl text-[#001b4b] leading-none dark:text-white">
                    Le parcours de votre dossier,<br>
                    étape par étape.
                </h2>
            </div>
        </div>

        <!-- les étapes   -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-14 gap-x-6 lg:gap-x-4 relative">

            <!-- Étape 1 -->
            <?php require_once __DIR__ . '/sous-components/process_section/etape-un.php'; ?>
            
            <!-- Étape 2 -->
            <?php require_once __DIR__ . '/sous-components/process_section/etape-deux.php'; ?>
            
            <!-- Étape 3 -->
            <?php require_once __DIR__ . '/sous-components/process_section/etape-trois.php'; ?>
            
            <!-- Étape 4 -->
            <?php require_once __DIR__ . '/sous-components/process_section/etape-quatre.php'; ?>

        </div>



    </div>
</section>