<section aria-label="Témoignages clients" class="w-full bg-white py-10 px-6 md:py-22 md:px-12 lg:px-24 transition-colors duration-500 dark:bg-blue-950/90">
    <div class="max-w-7xl mx-auto">

        <!-- Bloc Titre : Titre principal -->
        <div class="mb-8 md:mb-14"  data-aos="fade-up" data-aos-duration="1500">
            <span class="font-bebas text-sm tracking-widest text-blue-600 uppercase block mb-6 md:text-md lg:text-lg">
                -- Temoignages
            </span>
            <div class="">
                <h2 class="font-cardo font-semibold text-3xl md:text-5xl xl:text-6xl text-[#001b4b] leading-none dark:text-white">
                    Ce que disent nos clients.
                </h2>
            </div>
        </div>

        <!-- Bloc contenu -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 items-stretch">

            <!-- Carte témoignage -->
            <article class="flex flex-col justify-between">
                <div class="bg-blue-100 rounded-3xl p-6"  data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                    <div id="rating" class="flex gap-1 mb-3" role="img" aria-label="Note sur 5 étoiles">
                        <!-- étoiles injectées en JS -->
                    </div>

                    <blockquote class="font-inter text-gray-700 text-justify text-sm leading-relaxed mb-6">
                        <p id="quote">Chargement du témoignage…</p>
                    </blockquote>

                    <figcaption class="flex items-center gap-3">
                        <img id="avatar" src="" alt="" class="w-10 h-10 rounded-full object-cover">
                        <div class="font-jakarta">
                            <p id="author-name" class="font-semibold text-gray-900 text-sm"></p>
                            <p id="author-role" class="text-gray-500 text-xs"></p>
                        </div>
                    </figcaption>
                </div>

                <!-- Flèches de navigation -->
                <nav aria-label="Navigation des témoignages" class="flex items-center gap-3 mt-6">
                    <button id="prev-btn" aria-label="Témoignage précédent"
                        class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-blue-300 hover:bg-blue-400 text-gray-600 transition duration">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="next-btn" aria-label="Témoignage suivant"
                        class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-100 text-gray-600 transition duration">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </nav>
            </article>

            <!-- Image -->
            <figure class="rounded-2xl overflow-hidden h-64 md:h-full m-0">
                <img id="testimonial-image" src="" alt="" class="w-full h-full object-cover transition-opacity duration-500">
            </figure>
        </div>
</section>