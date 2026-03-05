<?php
    $baseDir = realpath(__DIR__);
    $path = isset($_GET['view']) ? realpath($baseDir . '/' . $_GET['view']) : null;
    if (!$path || strpos($path, $baseDir) !== 0 || !file_exists($path) || is_dir($path)) header('Location: /');
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sylvain L. - Visualiseur de PHP</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.6.0/css/all.css"/>
    <link rel="stylesheet" href="https://sylvain.sh/assets/css/bulma.css"/>
    <link rel="stylesheet" href="https://sylvain.sh/assets/css/index.css"/>
    <link rel="icon shortcut" href="https://php.sylvain.sh/assets/images/logo.png"/>
</head>
<body>
    <!-- Notification de changement de thème -->
    <div class="theme-notif"></div>

    <!-- Bouton pour changer de thème -->
    <button class="switch-btn"></button>

    <!-- Bouton retourner à l'accueil -->
    <a href="https://sylvain.sh" class="home-btn"><i class="fa-solid fa-home"></i></a>

    <!-- Visualisation -->
    <section class="section container">
        <h2 class="title is-5 is-flex is-justify-content-space-between is-align-items-center">
            <?= htmlspecialchars(basename($path)) ?>
            <?php if ($path !== $baseDir): ?>
                <a href="/files?path=<?= str_replace(['%2F', '.', '\\'], '/', dirname($_GET['view'])) ?>" class="button is-link px-4 py-1">Retour</a>
            <?php endif; ?>
        </h2>

        <div class="box">
            <?php if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif', 'svg'])): ?>
                <img src="<?= htmlspecialchars($_GET['view']) ?>" style="max-width: 100%;">
            <?php elseif (in_array($ext, ['txt', 'html', 'css', 'js', 'php', 'md', 'log'])): ?>
                <pre><?= htmlspecialchars(file_get_contents($path)) ?></pre>
            <?php elseif ($ext === 'pdf'): ?>
                <embed src="<?= htmlspecialchars($_GET['view']) ?>" type="application/pdf" width="100%" height="600px" />
            <?php else: ?>
                <p>Type non supporté.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="pt-5"></section>

    <!-- Bas de page -->
    <div class="has-text-centered p-4 bottom">
        <p><strong>
            <a href="/">php.sylvain.sh</a> &copy; 2025. Tous droits réservés.
        </strong></p>
    </div>

    <!-- Charger le Js -->
    <script type="text/javascript" src="https://sylvain.sh/assets/js/theme.js"></script>
</body>
</html>
