<main class="relative isolate min-h-screen overflow-hidden bg-blue-950/90 px-6 pb-16 pt-36 text-white md:px-12 md:pb-24 md:pt-48 lg:px-24">
    <!-- Décor de fond -->
    <div aria-hidden="true" class="pointer-events-none absolute -left-24 top-20 h-72 w-72 rounded-full bg-blue-500/20 blur-3xl"></div>
    <div aria-hidden="true" class="pointer-events-none absolute -bottom-32 -right-24 h-96 w-96 rounded-full bg-violet-300/15 blur-3xl"></div>

    <section aria-labelledby="error-title" class="relative mx-auto flex max-w-5xl flex-col items-center text-center">
        <p class="font-bebas text-lg tracking-[0.35em] text-blue-300 md:text-xl">ERREUR DE NAVIGATION</p>

        <div class="relative mt-4 select-none">
            <span aria-hidden="true" class="font-bebas text-[10rem] leading-none tracking-tight text-white/10 sm:text-[14rem] md:text-[18rem]">404</span>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-white/15 bg-white/10 shadow-2xl backdrop-blur-sm md:h-20 md:w-20">
                    <svg aria-hidden="true" class="h-8 w-8 text-violet-300 md:h-10 md:w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 9-3.75 3.75L8.25 9M12 12.75V3m7.5 9.75a7.5 7.5 0 1 1-15 0" />
                    </svg>
                </div>
            </div>
        </div>

        <h1 id="error-title" class="font-cardo mt-2 max-w-3xl text-4xl font-bold leading-tight md:text-6xl">Cette page semble introuvable.</h1>
        <p class="font-inter mt-5 max-w-xl text-sm leading-relaxed text-slate-300 md:text-base">
            Le lien que vous avez suivi est peut-être erroné, ou la page a été déplacée. Retrouvons ensemble le bon chemin.
        </p>

        <div class="mt-9 flex flex-col items-center gap-3 sm:flex-row">
            <a href="index.php?page=accueil" class="font-inter inline-flex items-center gap-2 rounded-xl bg-violet-300 px-5 py-3 text-sm font-semibold text-blue-950 transition-transform duration-300 hover:-translate-y-1 hover:bg-violet-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-950">
                Retour à l'accueil
                <svg aria-hidden="true" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
            <a href="index.php?page=contact" class="font-inter inline-flex items-center gap-2 rounded-xl border border-white/35 px-5 py-3 text-sm font-medium text-white transition-colors duration-300 hover:bg-white hover:text-blue-950 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-950">
                Contacter le cabinet
            </a>
        </div>

        <div class="mt-14 grid w-full max-w-3xl grid-cols-1 gap-3 text-left sm:grid-cols-3">
            <a href="index.php?page=services" class="group rounded-2xl border border-white/10 bg-white/5 p-5 transition-colors duration-300 hover:bg-white/10">
                <span class="font-bebas tracking-widest text-blue-300">01</span>
                <p class="font-inter mt-2 text-sm font-semibold">Nos services</p>
                <span class="font-inter mt-1 block text-xs text-slate-400 group-hover:text-slate-300">Découvrir notre expertise</span>
            </a>
            <a href="index.php?page=apropos" class="group rounded-2xl border border-white/10 bg-white/5 p-5 transition-colors duration-300 hover:bg-white/10">
                <span class="font-bebas tracking-widest text-blue-300">02</span>
                <p class="font-inter mt-2 text-sm font-semibold">À propos</p>
                <span class="font-inter mt-1 block text-xs text-slate-400 group-hover:text-slate-300">Connaître le cabinet</span>
            </a>
            <a href="index.php?page=contact" class="group rounded-2xl border border-white/10 bg-white/5 p-5 transition-colors duration-300 hover:bg-white/10">
                <span class="font-bebas tracking-widest text-blue-300">03</span>
                <p class="font-inter mt-2 text-sm font-semibold">Nous contacter</p>
                <span class="font-inter mt-1 block text-xs text-slate-400 group-hover:text-slate-300">Parlons de votre projet</span>
            </a>
        </div>
    </section>
</main>
