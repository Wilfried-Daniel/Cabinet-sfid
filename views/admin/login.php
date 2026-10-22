<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111c33">
    <title>Connexion administrateur | Cabinet SFID</title>
    <link rel="shortcut icon" href="images/logo.webp" type="image/webp">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="min-w-80 bg-slate-100 font-inter text-[#17213b]">
    <main class="grid min-h-screen lg:grid-cols-[1.08fr_.92fr]">
        <section class="relative hidden min-h-screen overflow-hidden bg-[#111c33] px-16 py-12 text-white lg:flex lg:flex-col lg:justify-between xl:px-28">
            <div class="pointer-events-none absolute -right-44 -top-64 h-130 w-130 rounded-full bg-[radial-gradient(circle,rgba(71,137,216,.55),rgba(71,137,216,0)_68%)]"></div>
            <div class="pointer-events-none absolute -bottom-56 -left-40 h-108 w-108 rounded-full border border-white/15 shadow-[0_0_0_52px_rgba(255,255,255,.025),0_0_0_105px_rgba(255,255,255,.02)]"></div>

            <a class="relative z-10 inline-flex w-max rounded-2xl bg-white p-2 shadow-xl shadow-black/15" href="index.php?page=accueil" aria-label="Retour à l'accueil du Cabinet SFID">
                <img class="size-19 rounded-xl object-contain" src="images/logo.webp" alt="Logo Cabinet SFID">
            </a>

            <div class="relative z-10 my-auto max-w-145 py-17">
                <p class="mb-5 flex items-center gap-2 text-xs font-bold tracking-[.16em] text-violet-300 uppercase before:block before:h-px before:w-7 before:bg-current">Espace sécurisé</p>
                <h1 class="max-w-140 font-jakarta text-6xl font-extrabold tracking-[-.055em] text-balance">Bienvenue dans votre espace d'administration.</h1>
                <p class="mt-6 max-w-117 text-base leading-7 text-white/70">Gérez les opportunités et les contenus du Cabinet SFID depuis un seul espace sécurisé.</p>
            </div>

            <p class="relative z-10 text-xs text-white/45">© <?= date(
                'Y',
            ) ?> Société Financière de l'Innovation et du Développement</p>
        </section>

        <section class="flex min-h-screen items-center justify-center bg-linear-to-br from-slate-100 via-white to-white px-6 py-8 lg:px-7">
            <div class="w-full max-w-102">
                <a class="mb-9 inline-flex rounded-2xl bg-white p-1.5 shadow-lg shadow-slate-900/10 lg:hidden" href="index.php?page=accueil" aria-label="Retour à l'accueil du Cabinet SFID">
                    <img class="size-16 rounded-xl object-contain" src="images/logo.webp" alt="Logo Cabinet SFID">
                </a>

                <h2 id="login-title" class="font-jakarta text-3xl font-extrabold tracking-[-.04em]">Connexion</h2>
                <p class="mt-2.5 mb-8.5 text-sm leading-6 text-slate-500">Renseignez vos identifiants administrateur pour accéder au tableau de bord.</p>

                <!-- Affichage de l'erreur s'il y en a une -->
                <?php if (isset($error)): ?>
                    <div class="mb-4 rounded-xl bg-red-50 p-4 text-sm text-red-600 border border-red-200" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="" autocomplete="on" aria-labelledby="login-title">
                    <div>
                        <label class="mb-2 block text-sm font-bold" for="email">Adresse e-mail</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute top-1/2 left-4 size-5 -translate-y-1/2 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                <path d="m3 7 9 6 9-6"></path>
                            </svg>
                            <input class="h-13 w-full rounded-2xl border border-slate-200 bg-slate-50 py-0 pr-12 pl-12 text-sm outline-none transition placeholder:text-slate-400 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10" id="email" name="email" type="email" inputmode="email" autocomplete="email" placeholder="nom@cabinet-sfid.com" <?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?> required>
                        </div>
                    </div>

                    <div class="mt-5.5">
                        <label class="mb-2 block text-sm font-bold" for="password">Mot de passe</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute top-1/2 left-4 size-5 -translate-y-1/2 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <rect x="4" y="10" width="16" height="10" rx="2"></rect>
                                <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                            </svg>
                            <input class="h-13 w-full rounded-2xl border border-slate-200 bg-slate-50 py-0 pr-12 pl-12 text-sm outline-none transition placeholder:text-slate-400 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10" id="password" name="password" type="password" autocomplete="current-password" placeholder="Votre mot de passe" required>
                            <button class="absolute top-1/2 right-2 grid size-9 -translate-y-1/2 place-items-center rounded-xl p-2 text-slate-500 transition hover:bg-blue-50 hover:text-blue-600 focus:bg-blue-50 focus:text-blue-600 focus:outline-none" type="button" aria-controls="password" aria-label="Afficher le mot de passe" aria-pressed="false">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"></path>
                                    <circle cx="12" cy="12" r="2.5"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button class="mt-8 flex h-13 w-full items-center justify-center gap-2 rounded-2xl bg-violet-300 font-bold text-[#111c33] shadow-lg shadow-violet-500/20 transition hover:-translate-y-0.5 hover:bg-violet-200 hover:shadow-xl focus:ring-4 focus:ring-violet-300/50 focus:outline-none" type="submit">
                        Se connecter
                        <svg class="size-4.5 transition hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"></path>
                        </svg>
                    </button>
                </form>

                <p class="mt-6 flex items-center justify-center gap-2 text-center text-xs text-slate-400">
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                        <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                    </svg>
                    Accès réservé aux administrateurs autorisés.
                </p>
            </div>
        </section>
    </main>

    <script>
        const passwordInput = document.querySelector('#password');
        const passwordToggle = document.querySelector('[aria-controls="password"]') || document.querySelector('button[aria-pressed]');

        passwordToggle.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            passwordToggle.setAttribute('aria-pressed', String(isPassword));
            passwordToggle.setAttribute('aria-label', isPassword ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
        });
    </script>
</body>

</html>