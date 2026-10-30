<?php
$admin_page_title = 'Mon profil';
$admin_active_page = 'profil';
$adminName = (string) ($admin['name'] ?? $_SESSION['admin_name'] ?? 'Administrateur');
$initial = strtoupper(substr($adminName, 0, 1));
require_once __DIR__ . '/../partials/header.php';
?>
<div class="min-h-screen lg:pl-[20%]">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>
    <main class="px-5 pt-26 pb-10 sm:px-8 lg:px-10 lg:pt-11 xl:px-14">
        <div>
            <p class="text-xs font-bold tracking-[.14em] text-blue-600 uppercase">Compte administrateur</p>
            <h1 class="mt-2 font-jakarta text-3xl font-extrabold tracking-[-.045em] text-[#111c33]">Mon profil</h1>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">Mettez à jour votre nom et votre mot de passe.</p>
        </div>

        <?php if (!empty($profileFlash)): ?>
            <div class="mt-6 max-w-5xl rounded-xl border px-4 py-3 text-sm font-semibold <?= $profileFlash['type'] === 'success' ? 'border-emerald-200 bg-emerald-50 text-emerald-800' : 'border-rose-200 bg-rose-50 text-rose-800' ?>" role="status">
                <?= htmlspecialchars($profileFlash['message'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <section class="mt-8 grid max-w-5xl gap-6 lg:grid-cols-[.7fr_1.3fr]" aria-label="Informations du profil">
            <aside class="rounded-2xl bg-[#111c33] p-6 text-white shadow-xl shadow-slate-900/10">
                <span class="grid size-14 place-items-center rounded-2xl bg-violet-300 font-jakarta text-xl font-extrabold text-[#111c33]"><?= htmlspecialchars($initial, ENT_QUOTES, 'UTF-8') ?></span>
                <h2 class="mt-5 font-jakarta text-xl font-extrabold"><?= htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8') ?></h2>
                <p class="mt-1 text-sm text-white/60"><?= htmlspecialchars($admin['email'], ENT_QUOTES, 'UTF-8') ?></p>
                <div class="mt-7 border-t border-white/10 pt-5 text-sm leading-6 text-white/65"><span class="font-bold text-white">Conseil de sécurité</span><br>Utilisez un mot de passe long et unique pour cet accès.</div>
            </aside>

            <div class="space-y-6">
                <form class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7" action="index.php?page=profil" method="post">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['profile_csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="action" value="update_name">
                    <div>
                        <h2 class="font-jakarta text-lg font-extrabold">Informations personnelles</h2>
                        <p class="mt-1 text-sm text-slate-500">Modifiez le nom affiché dans l'espace d'administration.</p>
                    </div>
                    <div class="mt-6">
                        <label class="mb-2 block text-sm font-bold text-slate-700" for="admin-name">Nom de l'administrateur</label>
                        <input class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10" id="admin-name" name="name" type="text" value="<?= htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8') ?>" autocomplete="name" maxlength="255" required>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button class="inline-flex h-11 items-center justify-center rounded-xl bg-[#111c33] px-5 text-sm font-bold text-white transition hover:bg-[#1d3159] focus:outline-none focus:ring-4 focus:ring-blue-600/20" type="submit">Enregistrer le nom</button>
                    </div>
                </form>

                <form id="password-form" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7" action="index.php?page=profil" method="post" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['profile_csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="action" value="change_password">
                    <h2 class="font-jakarta text-lg font-extrabold">Changer le mot de passe</h2>
                    <p class="mt-1 text-sm text-slate-500">Confirmez votre identité avec votre mot de passe actuel.</p>
                    <div class="mt-5 grid gap-5">
                        <div><label class="mb-2 block text-sm font-bold text-slate-700" for="current-password">Mot de passe actuel</label><input class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10" id="current-password" name="current_password" type="password" autocomplete="current-password" required></div>
                        <div><label class="mb-2 block text-sm font-bold text-slate-700" for="new-password">Nouveau mot de passe</label><input class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10" id="new-password" name="new_password" type="password" autocomplete="new-password" minlength="8" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{8,}" required aria-describedby="password-help password-error"><p id="password-help" class="mt-2 text-xs text-slate-500">8 caracteres minimum, avec au moins une majuscule, une minuscule et un caractere special.</p><p id="password-error" class="mt-2 hidden text-xs font-medium text-rose-600" aria-live="polite"></p></div>
                        <div><label class="mb-2 block text-sm font-bold text-slate-700" for="confirm-password">Confirmer le nouveau mot de passe</label><input class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10" id="confirm-password" name="confirm_password" type="password" autocomplete="new-password" required></div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button class="inline-flex h-11 items-center justify-center rounded-xl bg-[#111c33] px-5 text-sm font-bold text-white transition hover:bg-[#1d3159] focus:outline-none focus:ring-4 focus:ring-blue-600/20" type="submit">Modifier le mot de passe</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</div>
<script>
(() => {
    const form = document.getElementById('password-form');
    const currentPassword = document.getElementById('current-password');
    const password = document.getElementById('new-password');
    const confirmation = document.getElementById('confirm-password');
    const error = document.getElementById('password-error');
    if (!form || !password || !confirmation || !error) return;

    const validatePassword = () => {
        const value = password.value;
        let message = '';
        if (!currentPassword.value) message = 'Saisissez votre mot de passe actuel.';
        else if (value.length < 8) message = 'Le mot de passe doit contenir au moins 8 caracteres.';
        else if (!/[A-Z]/.test(value)) message = 'Ajoutez au moins une lettre majuscule.';
        else if (!/[a-z]/.test(value)) message = 'Ajoutez au moins une lettre minuscule.';
        else if (!/[^A-Za-z0-9]/.test(value)) message = 'Ajoutez au moins un caractere special.';
        else if (!confirmation.value) message = 'Confirmez le nouveau mot de passe.';
        else if (value !== confirmation.value) message = 'Les deux nouveaux mots de passe ne correspondent pas.';
        password.setCustomValidity(message && !message.startsWith('Confirmez') && !message.startsWith('Les deux') && !message.startsWith('Saisissez') ? message : '');
        confirmation.setCustomValidity(!confirmation.value || value !== confirmation.value ? 'La confirmation du mot de passe est obligatoire et doit etre identique.' : '');
        error.textContent = message;
        error.classList.toggle('hidden', !message);
        return !message;
    };
    currentPassword.addEventListener('input', validatePassword);
    password.addEventListener('input', validatePassword);
    confirmation.addEventListener('input', validatePassword);
    form.addEventListener('submit', (event) => {
        if (!validatePassword()) {
            event.preventDefault();
            if (!currentPassword.value) currentPassword.focus();
            else if (password.value.length < 8 || !/[A-Z]/.test(password.value) || !/[a-z]/.test(password.value) || !/[^A-Za-z0-9]/.test(password.value)) password.focus();
            else confirmation.focus();
        }
    });
})();
</script>
</body>
</html>
