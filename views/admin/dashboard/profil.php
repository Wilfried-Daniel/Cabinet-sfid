<?php
$admin_page_title = 'Mon profil';
$admin_active_page = 'profil';
require_once __DIR__ . '/../partials/header.php';
?>
<div class="min-h-screen lg:pl-[20%]">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="px-5 pt-26 pb-10 sm:px-8 lg:px-10 lg:pt-11 xl:px-14">
        <div>
            <p class="text-xs font-bold tracking-[.14em] text-blue-600 uppercase">Compte administrateur</p>
            <h1 class="mt-2 font-jakarta text-3xl font-extrabold tracking-[-.045em] text-[#111c33]">Mon profil</h1>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">Mettez à jour votre nom et votre mot de passe. La
                sauvegarde sera reliée au serveur ultérieurement.</p>
        </div>

        <section class="mt-8 grid max-w-5xl gap-6 lg:grid-cols-[.7fr_1.3fr]" aria-label="Informations du profil">
            <aside class="rounded-2xl bg-[#111c33] p-6 text-white shadow-xl shadow-slate-900/10">
                <span
                    class="grid size-14 place-items-center rounded-2xl bg-violet-300 font-jakarta text-xl font-extrabold text-[#111c33]">A</span>
                <h2 class="mt-5 font-jakarta text-xl font-extrabold">Administrateur</h2>
                <p class="mt-1 text-sm text-white/60">Cabinet SFID</p>
                <div class="mt-7 border-t border-white/10 pt-5 text-sm leading-6 text-white/65"><span
                        class="font-bold text-white">Conseil de sécurité</span><br>Utilisez un mot de passe long et
                    unique pour cet accès.</div>
            </aside>

            <form class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7" action="#" method="post"
                data-profile-form>
                <div class="flex items-start gap-3">
                    <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-blue-50 text-blue-600"><svg
                            class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            aria-hidden="true">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M4 21a8 8 0 0 1 16 0"></path>
                        </svg></span>
                    <div>
                        <h2 class="font-jakarta text-lg font-extrabold">Informations personnelles</h2>
                        <p class="mt-1 text-sm text-slate-500">Modifiez le nom affiché dans l’espace d’administration.
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="mb-2 block text-sm font-bold text-slate-700" for="admin-name">Nom de
                        l’administrateur</label>
                    <input
                        class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10"
                        id="admin-name" name="name" type="text" value="Administrateur" autocomplete="name" required>
                </div>

                <div class="mt-8 border-t border-slate-100 pt-7">
                    <h2 class="font-jakarta text-lg font-extrabold">Changer le mot de passe</h2>
                    <p class="mt-1 text-sm text-slate-500">Saisissez d’abord votre mot de passe actuel pour confirmer la
                        modification.</p>
                    <div class="mt-5 grid gap-5">
                        <div><label class="mb-2 block text-sm font-bold text-slate-700" for="current-password">Mot de
                                passe actuel</label><input
                                class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10"
                                id="current-password" name="current_password" type="password"
                                autocomplete="current-password" required></div>
                        <div><label class="mb-2 block text-sm font-bold text-slate-700" for="new-password">Nouveau mot
                                de passe</label><input
                                class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10"
                                id="new-password" name="new_password" type="password" autocomplete="new-password"
                                minlength="8" required aria-describedby="password-help">
                            <p id="password-help" class="mt-2 text-xs text-slate-400">8 caractères minimum.</p>
                        </div>
                        <div><label class="mb-2 block text-sm font-bold text-slate-700" for="confirm-password">Confirmer
                                le nouveau mot de passe</label><input
                                class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10"
                                id="confirm-password" name="confirm_password" type="password"
                                autocomplete="new-password" required>
                            <p class="mt-2 hidden text-xs font-medium text-red-600" data-password-error>Les deux
                                nouveaux mots de passe doivent être identiques.</p>
                        </div>
                    </div>
                </div>
                <div
                    class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs text-slate-400">Laissez intact pour ne rien modifier.</p>
                    <button
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[#111c33] px-5 text-sm font-bold text-white transition hover:bg-[#1d3159] focus:outline-none focus:ring-4 focus:ring-blue-600/20"
                        type="submit">Enregistrer<svg class="size-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6"></path>
                        </svg></button>
                </div>
            </form>
        </section>
    </main>
</div>
<script>
    document.querySelector('[data-profile-form]')?.addEventListener('submit', (event) => {
        const newPassword = document.querySelector('#new-password');
        const confirmation = document.querySelector('#confirm-password');
        const error = document.querySelector('[data-password-error]');
        const matches = newPassword.value === confirmation.value;
        confirmation.setCustomValidity(matches ? '' : 'Les mots de passe ne correspondent pas.');
        error.classList.toggle('hidden', matches);
        if (!matches) confirmation.focus();
        event.preventDefault();
    });
</script>
</body>

</html>