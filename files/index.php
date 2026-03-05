<?php
    $baseDir = realpath(__DIR__);
    $path = isset($_GET['path']) ? realpath($baseDir . '/' . $_GET['path']) : $baseDir;
    if (strpos($path, $baseDir) !== 0) $path = $baseDir;
    $items = array_diff(scandir($path), ['.', '..']);
    $relativePath = trim(str_replace($baseDir, '', $path), '/');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sylvain L. - Fichiers PHP</title>
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

    <!-- Arborescence -->
    <section class="section container">
        <h2 class="title is-4 is-flex is-justify-content-space-between">Fichiers
            <?php if ($path !== $baseDir): ?>
                <a href="?path=<?= str_replace(['%2F', '.', '\\'], '/', dirname($relativePath)) ?>" class="button is-link px-4 py-1">Retour</a>
            <?php endif; ?>
        </h2>

        <table class="table is-fullwidth">
            <tbody>
                <?php foreach ($items as $item):
                    $itemPath = $path . '/' . $item;
                    $relativeItemPath = trim(str_replace($baseDir, '', $itemPath), '/');
                ?>
                    <tr>
                        <td class="description">
                            <?php if (is_dir($itemPath)): ?>
                                <i class="fa-solid fa-folder mr-3" style="color: #ffe36e;"></i><a href="?path=<?=  str_replace('%2F', '/', urlencode(str_replace('\\', '/', $relativeItemPath))) ?>"><?= $item ?></a>
                            <?php else: ?>
                                <i class="fa-solid fa-file-lines mr-4" style="color: var(--bg-invert);"></i><a href="/files/viewer.php?view=<?=  str_replace('%2F', '/', urlencode(str_replace('\\', '/', $relativeItemPath))) ?>"><?= $item ?></a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!is_dir($itemPath)): ?>
                                <a href="/files<?= str_replace('\\', '/', $relativeItemPath) ?>" class="buttons is-small is-right" download><i class="fa-solid fa-download" style="color: var(--bg-invert);"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

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
