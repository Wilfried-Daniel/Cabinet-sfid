<dialog
    id="form-postes"
    aria-labelledby="form-postes-title"
    class="mx-auto w-[calc(100%-2rem)] max-w-5xl rounded-3xl bg-transparent p-0 backdrop:bg-blue-950/80">
    <div
        class="relative max-h-[calc(100vh-2rem)] overflow-y-auto rounded-3xl border border-blue-200 bg-gray-200 p-6 shadow-[0_12px_40px_rgba(0,27,75,0.08)] dark:border-white/15 dark:bg-[#313966] md:p-10">
        <button
            type="button"
            data-close-modal
            aria-label="Fermer le formulaire"
            class="absolute right-4 top-4 flex h-9 w-9 cursor-pointer items-center justify-center rounded-full border border-blue-200 text-blue-950 transition hover:bg-blue-950 hover:text-white dark:border-white/20 dark:text-white dark:hover:bg-white dark:hover:text-blue-950">
            &#10060;
        </button>

        <span class="font-bebas text-lg tracking-[0.2em] text-blue-600 dark:text-blue-300">
            CANDIDATURE À UNE OFFRE
        </span>
        <h2
            id="form-postes-title"
            class="font-cardo mt-3 text-3xl font-bold text-blue-950 dark:text-white md:text-5xl">
            Postulez au poste qui vous correspond.
        </h2>
        <p class="font-inter mt-4 max-w-2xl text-sm leading-relaxed text-slate-700 dark:text-slate-300">
            Complétez vos informations et joignez les documents nécessaires à l’étude de votre dossier.
        </p>

        <form
            action="index.php?page=offres#form-postes"
            id="postes-form"
            method="post"
            enctype="multipart/form-data"
            class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2">
            <input type="hidden" name="type_candidature" value="poste">
            <?php if (!empty($offrePostErrors)): ?>
                <div role="alert" class="md:col-span-2 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    <p class="font-semibold">Votre candidature n'a pas pu etre envoyee :</p>
                    <ul class="mt-2 list-disc pl-5"><?php foreach ($offrePostErrors as $error): ?><li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li><?php endforeach; ?></ul>
                </div>
            <?php endif; ?>

            <!-- Nom complet -->
            <div>
                <label
                    for="poste-nom"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Nom complet *
                </label>
                <input
                    id="poste-nom"
                    name="nom_complet" value="<?= htmlspecialchars($offrePostForm['nom_complet'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    type="text"
                    autocomplete="name"
                    required
                    placeholder="Votre nom et prénom"
                    class="font-inter w-full rounded-xl border border-blue-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-white/20 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-400">
                    <p id="msg-poste-nom" class="mt-1.5 hidden text-xs font-medium"></p>
            </div>

            <!-- Adresse e-mail -->
            <div>
                <label
                    for="poste-email"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Adresse e-mail *
                </label>
                <input
                    id="poste-email"
                    name="email" value="<?= htmlspecialchars($offrePostForm['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    type="email"
                    autocomplete="email"
                    required
                    placeholder="vous@exemple.com"
                    class="font-inter w-full rounded-xl border border-blue-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-white/20 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-400">
                    <p id="msg-poste-email" class="mt-1.5 hidden text-xs font-medium"></p>
            </div>

            <!-- Téléphone -->
            <div>
                <label
                    for="poste-telephone"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Téléphone *
                </label>
                <input
                    id="poste-telephone"
                    name="telephone" value="<?= htmlspecialchars($offrePostForm['telephone'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    type="tel"
                    autocomplete="tel"
                    required
                    placeholder="+225 00 00 00 00 00"
                    class="font-inter w-full rounded-xl border border-blue-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-white/20 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-400">
                    <p id="msg-poste-telephone" class="mt-1.5 hidden text-xs font-medium"></p>
            </div>

            <!-- Offre selectionnee -->
            <div>
                <label for="poste-intitule" class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">Offre choisie *</label>
                <input id="poste-intitule" type="text" value="<?= htmlspecialchars($selectedOffreTitle ?? '', ENT_QUOTES, 'UTF-8') ?>" required readonly placeholder="Choisissez une offre avec le bouton Postuler" class="font-inter w-full rounded-xl border border-blue-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none dark:border-white/20 dark:bg-white/5 dark:text-white">
                <input id="poste-offre-id" name="offre_id" type="hidden" value="<?= htmlspecialchars($offrePostForm['offre_id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <p id="msg-poste-intitule" class="mt-1.5 hidden text-xs font-medium"></p>
            </div>
            <!-- Message de candidature -->
            <div class="md:col-span-2">
                <label
                    for="poste-message"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Message de candidature
                </label>
                <textarea
                    id="poste-message"
                    name="message"
                    rows="4"
                    placeholder="Pourquoi souhaitez-vous rejoindre le Cabinet SFID ?"
                    class="font-inter w-full resize-y rounded-xl border border-blue-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-white/20 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-400"><?= htmlspecialchars($offrePostForm['message'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <!-- CV -->
            <div>
                <label
                    for="poste-cv"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    CV *
                </label>
                <input
                    id="poste-cv"
                    name="cv"
                    type="file"
                    accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                    required
                    class="font-inter block w-full cursor-pointer rounded-xl border border-dashed border-blue-300 bg-blue-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-950 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-900 dark:border-white/30 dark:bg-white/5 dark:text-slate-300 dark:file:bg-violet-300 dark:file:text-blue-950">
                <p id="msg-poste-cv" class="mt-1.5 hidden text-xs font-medium"></p>
            </div>

            <!-- Lettre de motivation -->
            <div>
                <label
                    for="poste-lm"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Lettre de motivation *
                </label>
                <input
                    id="poste-lm"
                    name="lettre_motivation"
                    type="file"
                    accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                    required
                    class="font-inter block w-full cursor-pointer rounded-xl border border-dashed border-blue-300 bg-blue-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-950 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-900 dark:border-white/30 dark:bg-white/5 dark:text-slate-300 dark:file:bg-violet-300 dark:file:text-blue-950">
                <p id="msg-poste-lm" class="mt-1.5 hidden text-xs font-medium"></p>
            </div>

            <div
                class="md:col-span-2 flex flex-col items-start justify-between gap-4 border-t border-blue-100 pt-6 dark:border-white/10 sm:flex-row sm:items-center">
                <p class="font-inter max-w-xl text-xs leading-relaxed text-slate-500 dark:text-slate-400">
                    Formats acceptés : PDF, DOC ou DOCX (Max 5 Mo par fichier).
                </p>
                <button
                    type="submit"
                    id="btn-submit-postes"
                    disabled
                    class="font-inter inline-flex cursor-not-allowed items-center gap-2 rounded-xl bg-slate-300 px-5 py-3 text-sm font-semibold text-slate-500 opacity-60 transition-all dark:bg-slate-700 dark:text-slate-400">
                    Envoyer ma candidature
                    <span aria-hidden="true">→</span>
                </button>
                <!-- <button
                    type="submit"
                    class="font-inter inline-flex cursor-pointer items-center gap-2 rounded-xl bg-blue-950 px-5 py-3 text-sm font-semibold text-white transition-transform hover:-translate-y-1 hover:bg-blue-900 dark:bg-violet-300 dark:text-blue-950 dark:hover:bg-violet-200">
                    Envoyer ma candidature
                    <span aria-hidden="true">→</span>
                </button> -->
            </div>
        </form>
    </div>
</dialog>