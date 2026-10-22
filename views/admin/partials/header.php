<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111c33">
    <title><?= htmlspecialchars(
        $admin_page_title ?? 'Administration',
        ENT_QUOTES,
        'UTF-8',
    ) ?> | Cabinet SFID</title>
    <link rel="shortcut icon" href="images/logo.webp" type="image/webp">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="min-w-80 bg-slate-100 font-inter text-[#17213b] antialiased">
