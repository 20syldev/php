<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sylvain L. - Testez votre PHP</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.6.0/css/all.css"/>
    <link rel="stylesheet" href="https://sylvain.sh/assets/css/bulma.css"/>
    <link rel="stylesheet" href="https://sylvain.sh/assets/css/index.css"/>
    <link rel="stylesheet" href="https://php.sylvain.sh/assets/css/tester.css"/>
    <link rel="icon shortcut" href="https://php.sylvain.sh/assets/images/logo.png"/>
</head>
<body>
    <!-- Notification de changement de thème -->
    <div class="theme-notif"></div>

    <!-- Bouton pour changer de thème -->
    <button class="switch-btn"></button>

    <!-- Bouton retourner à l'accueil -->
    <a href="https://sylvain.sh" class="home-btn"><i class="fa-solid fa-home"></i></a>

    <!-- Tester le PHP -->
    <section class="p-4">
        <h2 class="title">Testez votre PHP</h2>

        <textarea id="code" placeholder="function example() { ..."></textarea>
        <button class="button is-primary mt-1" onclick="runPHP();">Exécuter</button>

        <div class="console" id="console"></div>
    </section>

    <!-- Bas de page -->
    <div class="has-text-centered p-4 bottom">
        <p><strong>
            <a href="/">php.sylvain.sh</a> &copy; 2025. Tous droits réservés.
        </strong></p>
    </div>

    <!-- Charger le Js -->
    <script type="text/javascript" src="https://php.sylvain.sh/assets/js/console.js"></script>
    <script type="text/javascript" src="https://sylvain.sh/assets/js/theme.js"></script>
</body>
</html>
