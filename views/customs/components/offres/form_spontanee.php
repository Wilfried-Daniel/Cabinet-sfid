<dialog
    id="form-spontanee"
    aria-labelledby="form-spontanee-title"
    class="m-auto w-[calc(100%-2rem)] max-w-5xl rounded-3xl bg-transparent p-0 backdrop:bg-blue-950/80">
    <div
        class="relative max-h-[calc(100vh-2rem)] overflow-y-auto rounded-3xl border border-blue-200 bg-white p-6 shadow-[0_12px_40px_rgba(0,27,75,0.08)] dark:border-white/15 dark:bg-[#142446] md:p-10">
        <button
            type="button"
            data-close-modal
            aria-label="Fermer le formulaire"
            class="absolute right-4 top-4 flex h-9 w-9 cursor-pointer items-center justify-center rounded-full border border-blue-200 text-blue-950 transition hover:bg-blue-950 hover:text-white dark:border-white/20 dark:text-white dark:hover:bg-white dark:hover:text-blue-950">
            &#10060;
        </button>

        <span class="font-bebas text-lg tracking-[0.2em] text-blue-600 dark:text-blue-300">
            CANDIDATURE SPONTANÉE
        </span>
        <h2
            id="form-spontanee-title"
            class="font-cardo mt-3 text-3xl font-bold text-blue-950 dark:text-white md:text-5xl">
            Faisons connaissance.
        </h2>
        <p class="font-inter mt-4 max-w-2xl text-sm leading-relaxed text-slate-700 dark:text-slate-300">
            Votre profil sera étudié pour nos futures opportunités. Les champs marqués d’un astérisque sont
            obligatoires.
        </p>


        <!-- Messages erreur venant du backend -->
        <!-- Message de succès -->
        <?php if (isset($_SESSION['flash_success'])): ?>
            <div id="flash-success-msg" class="mb-6 mt-2 rounded-2xl border border-emerald-200 bg-emerald-100 p-4 text-sm font-medium text-emerald-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300">
                <?= htmlspecialchars($_SESSION['flash_success']) ?>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <!-- Erreur globale -->
        <?php if (isset($errors['global'])): ?>
            <div id="flash-error-msg" class="mb-6 mt-2 rounded-2xl border border-red-200 bg-red-100 p-4 text-sm font-medium text-red-800 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-300">
                <?= htmlspecialchars($errors['global']) ?>
            </div>
        <?php endif; ?>


        <form
            action="index.php?page=offres#form-spontanee"
            id="spontanee-form"
            method="post"
            enctype="multipart/form-data"
            class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2">
            <input type="hidden" name="type_candidature" value="spontanee">

            <!-- Nom complet -->
            <div>
                <label
                    for="spontanee-nom"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Nom complet *
                </label>
                <input
                    id="spontanee-nom"
                    name="nom_complet"
                    type="text"
                    autocomplete="name"
                    required
                    placeholder="Votre nom et prénom"
                    class="font-inter w-full rounded-xl border border-blue-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-white/20 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-400">
                <!-- <p id="msg-spontanee-nom" class="mt-1.5 hidden text-xs font-medium"></p> -->
                <p id="msg-spontanee-nom" class="mt-1.5 <?= isset(
                    $errors['nom_complet'],
                )
                    ? 'block text-red-500 dark:text-red-400'
                    : 'hidden' ?> text-xs font-medium">
                    <?= htmlspecialchars($errors['nom_complet'] ?? '') ?>
                </p>
            </div>

            <!-- Adresse e-mail -->
            <div>
                <label
                    for="spontanee-email"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Adresse e-mail *
                </label>
                <input
                    id="spontanee-email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required
                    placeholder="vous@exemple.com"
                    class="font-inter w-full rounded-xl border border-blue-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-white/20 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-400">
                <!-- <p id="msg-spontanee-email" class="mt-1.5 hidden text-xs font-medium"></p> -->
                <p id="msg-spontanee-email" class="mt-1.5 <?= isset(
                    $errors['email'],
                )
                    ? 'block text-red-500 dark:text-red-400'
                    : 'hidden' ?> text-xs font-medium">
                    <?= htmlspecialchars($errors['email'] ?? '') ?>
                </p>
            </div>

            <!-- Téléphone -->
            <div>
                <label
                    for="spontanee-telephone"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Téléphone *
                </label>
                <input
                    id="spontanee-telephone"
                    name="telephone"
                    type="tel"
                    autocomplete="tel"
                    required
                    placeholder="+225 00 00 00 00 00"
                    class="font-inter w-full rounded-xl border border-blue-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-white/20 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-400">
                <!-- <p id="msg-spontanee-telephone" class="mt-1.5 hidden text-xs font-medium"></p> -->
                <p id="msg-spontanee-telephone" class="mt-1.5 <?= isset(
                    $errors['telephone'],
                )
                    ? 'block text-red-500 dark:text-red-400'
                    : 'hidden' ?> text-xs font-medium">
                    <?= htmlspecialchars($errors['telephone'] ?? '') ?>
                </p>
            </div>

            <!-- Domaine recherché -->
            <div>
                <label
                    for="spontanee-domaine"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Domaine recherché *
                </label>
                <?php $selectedDomaine = $_POST['domaine'] ?? ''; ?>
                <select
                    id="spontanee-domaine"
                    name="domaine"
                    required
                    class="font-inter w-full rounded-xl border <?= isset(
                        $errors['domaine'],
                    )
                        ? 'border-red-500 dark:border-red-500'
                        : 'border-blue-200 dark:border-white/20' ?> bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:bg-white/5 dark:text-white dark:scheme-dark">
                    <option value="" disabled <?= empty($selectedDomaine)
                        ? 'selected'
                        : '' ?> class="bg-white text-slate-400 dark:bg-slate-500 dark:text-slate-300">-- Sélectionnez un domaine --</option>
                    <option value="comptabilite-fiscalite" <?= $selectedDomaine ===
                    'comptabilite-fiscalite'
                        ? 'selected'
                        : '' ?>>Comptabilité & fiscalité</option>
                    <option value="juridique-social" <?= $selectedDomaine ===
                    'juridique-social'
                        ? 'selected'
                        : '' ?>>Juridique & social</option>
                    <option value="communication" <?= $selectedDomaine ===
                    'communication'
                        ? 'selected'
                        : '' ?>>Communication</option>
                    <option value="finance" <?= $selectedDomaine === 'finance'
                        ? 'selected'
                        : '' ?>>Finance & investissement</option>
                    <option value="autre" <?= $selectedDomaine === 'autre'
                        ? 'selected'
                        : '' ?>>Autre</option>
                </select>
                <!-- <p id="msg-spontanee-domaine" class="mt-1.5 hidden text-xs font-medium"></p> -->
                <p id="msg-spontanee-domaine" class="mt-1.5 <?= isset(
                    $errors['domaine'],
                )
                    ? 'block text-red-500 dark:text-red-400'
                    : 'hidden' ?> text-xs font-medium">
                    <?= htmlspecialchars($errors['domaine'] ?? '') ?>
                </p>
            </div>

            <!-- Message de candidature -->
            <div class="md:col-span-2">
                <label
                    for="spontanee-message"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Quelques mots sur votre profil
                </label>
                <textarea
                    id="spontanee-message"
                    name="message"
                    rows="4"
                    placeholder="Vos compétences, disponibilités ou motivations…"
                    class="font-inter w-full resize-y rounded-xl border border-blue-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-white/20 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-400"></textarea>
            </div>

            <!-- CV -->
            <div>
                <label
                    for="spontanee-cv"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    CV *
                </label>
                <input
                    id="spontanee-cv"
                    name="cv"
                    type="file"
                    accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                    required
                    class="font-inter block w-full cursor-pointer rounded-xl border border-dashed <?= isset(
                        $errors['cv'],
                    )
                        ? 'border-red-500'
                        : 'border-blue-300' ?> bg-blue-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-950 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-900 dark:border-white/30 dark:bg-white/5 dark:text-slate-300 dark:file:bg-violet-300 dark:file:text-blue-950">
                    <!-- <p id="msg-spontanee-cv" class="mt-1.5 hidden text-xs font-medium"></p> -->
                    <p id="msg-spontanee-cv" class="mt-1.5 <?= isset(
                        $errors['cv'],
                    )
                        ? 'block text-red-500 dark:text-red-400'
                        : 'hidden' ?> text-xs font-medium">
                        <?= htmlspecialchars($errors['cv'] ?? '') ?>
                    </p>
            </div>

            <!-- Lettre de motivation -->
            <div>
                <label
                    for="spontanee-lm"
                    class="font-inter mb-2 block text-sm font-semibold text-blue-950 dark:text-white">
                    Lettre de motivation *
                </label>
                <input
                    id="spontanee-lm"
                    name="lettre_motivation"
                    type="file"
                    accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                    required
                    class="font-inter block w-full cursor-pointer rounded-xl border border-dashed <?= isset(
                        $errors['lettre_motivation'],
                    )
                        ? 'border-red-500'
                        : 'border-blue-300' ?> bg-blue-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-950 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-900 dark:border-white/30 dark:bg-white/5 dark:text-slate-300 dark:file:bg-violet-300 dark:file:text-blue-950">
                    <!-- <p id="msg-spontanee-lm" class="mt-1.5 hidden text-xs font-medium"></p> -->
                     <p id="msg-spontanee-lm" class="mt-1.5 <?= isset(
                         $errors['lettre_motivation'],
                     )
                         ? 'block text-red-500 dark:text-red-400'
                         : 'hidden' ?> text-xs font-medium">
                        <?= htmlspecialchars($errors['lettre_motivation'] ?? '') ?>
                    </p>        
            </div>

            <div
                class="md:col-span-2 flex flex-col items-start justify-between gap-4 border-t border-blue-100 pt-6 dark:border-white/10 sm:flex-row sm:items-center">
                <p class="font-inter max-w-xl text-xs leading-relaxed text-slate-500 dark:text-slate-400">
                    Formats acceptés : PDF, DOC ou DOCX (Max 5 Mo par fichier).
                </p>
                <button
                    type="submit"
                    disabled
                    id="btn-submit-spontanee"
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

<!-- Réouverture automatique de la modale <dialog> lors d'un retour avec erreurs ou succès -->
<?php if (!empty($errors) || isset($_GET['status']) || isset($_SESSION['flash_success'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('form-spontanee');
        if (modal && typeof modal.showModal === 'function') {
            modal.showModal();
        }
    });
</script>
<?php endif; ?>

<!-- FAIRE DISPARAITRE LES MSG DE SUCCES ET D'ERREUR AU BOUT D'UN MOMENT -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const successAlert = document.getElementById('flash-success-msg');
    if (successAlert) {
        // Attendre 5 secondes (5000ms) avant de commencer la disparition
        setTimeout(() => {
            // Effet de fondu (disparition progressive)
            successAlert.classList.add('opacity-0');
            
            // Suppression définitive de l'élément du DOM après la fin de la transition (500ms)
            setTimeout(() => {
                successAlert.remove();
            }, 500);
        }, 5000);
    }
    const errorAlert = document.getElementById('flash-error-msg');
    if (errorAlert) {
        // Attendre 5 secondes (5000ms) avant de commencer la disparition
        setTimeout(() => {
            // Effet de fondu (disparition progressive)
            errorAlert.classList.add('opacity-0');
            
            // Suppression définitive de l'élément du DOM après la fin de la transition (500ms)
            setTimeout(() => {
                errorAlert.remove();
            }, 500);
        }, 5000);
    }
});
</script>