<?php
    // Page principale index.php

    include 'modules/session.php';
    include 'config.php';
    include 'modules/comptes.php';
    include 'modules/traitement.php';

    $comptes = lireComptesCSV('modules/bqe_comptes.csv');
    $actions = lireMouvementsCSV('modules/bqe_mouvements.csv');
    $comptes_apres = appliquerMouvements($comptes, $actions);
    ecrireComptesCSV('modules/bqe_comptes.csv', $comptes_apres);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sylvain L. - PHP - TP Banque CSV</title>
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

    <!-- Tableaux -->
    <section class="container pt-6">
        <h2 class="title is-3 pb-3 has-text-centered">Gestion des Comptes Bancaires en CSV</h2>

        <div class="box">
            <h3 class="subtitle is-5">Tableau des Comptes Avant Application des Mouvements</h3>
            <table class="table is-striped is-fullwidth">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Solde</th>
                    </tr>
                </thead>
                <tbody>
                    <?php afficherComptes($comptes); ?>
                </tbody>
            </table>
        </div>

        <div class="box">
            <h3 class="subtitle is-5">Tableau des Mouvements à Appliquer</h3>
            <table class="table is-striped is-fullwidth">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Type</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($actions as $mouvement) {
                        echo "<tr><td>" . $mouvement['numero'] . "</td><td>" . $mouvement['type'] . "</td><td>" . $mouvement['montant'] . " €</td></tr>";
                    } ?>
                </tbody>
            </table>
        </div>

        <div class="box">
            <h3 class="subtitle is-5">Tableau des Comptes Après Application des Mouvements</h3>
            <table class="table is-striped is-fullwidth">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Solde</th>
                    </tr>
                </thead>
                <tbody>
                    <?php afficherComptes($comptes_apres); ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="container py-5"><hr></section>

    <!-- Formulaire pour ajouter un compte -->
    <section class="container box">
        <h2 class="title is-4 has-text-centered">Ajouter un Compte</h2>

        <form action="banque-csv/modules/traitement.php" method="POST">
            <input type="hidden" name="ajouter_compte" value="1">
            <div class="field">
                <label class="label">Numéro</label>
                <div class="control">
                    <input class="input" type="text" name="numero" placeholder="Numéro du compte" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Nom</label>
                <div class="control">
                    <input class="input" type="text" name="nom" placeholder="Nom" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Prénom</label>
                <div class="control">
                    <input class="input" type="text" name="prenom" placeholder="Prénom" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Solde</label>
                <div class="control is-flex">
                    <input class="input mr-3" type="number" name="solde" placeholder="Solde initial" step="1" required>
                    <button class="button is-link" type="submit">Ajouter en CSV</button>
                </div>
            </div>
        </form>
    </section>

    <!-- Formulaire pour modifier un compte -->
    <section class="container box mt-5">
        <h2 class="title is-4 has-text-centered">Modifier un Compte</h2>
        <form action="banque-csv/modules/traitement.php" method="POST">
            <input type="hidden" name="modifier_compte" value="1">
            <div class="field">
                <label class="label">Numéro</label>
                <div class="control">
                    <input class="input" type="text" name="numero" placeholder="Numéro du compte" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Type</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="type">
                            <option value="CB">Carte Bancaire (CB)</option>
                            <option value="CHQ">Chèque (CHQ)</option>
                            <option value="VIR">Virement (VIR)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label">Montant</label>
                <div class="control is-flex">
                    <input class="input mr-3" type="number" name="montant" placeholder="Montant" step="1" required>
                    <button class="button is-link" type="submit">Modifier le CSV</button>
                </div>
            </div>
        </form>
    </section>

    <section class="container p-6"></section>

    <!-- Bas de page -->
    <div class="has-text-centered p-4 bottom">
        <p><strong>
            <a href="/">php.sylvain.sh</a> &copy; 2025. Tous droits réservés.
        </strong></p>
    </div>

    <!-- Charger le Js -->
    <script src="https://sylvain.sh/assets/js/theme.js"></script>
</body>
</html>
