<?php

// template : creer ta pizza
// role : met en forme le formulaire de creation de pizza
//param : neant
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Creer Ma Pizza</title>
</head>

<body>
    <?php include 'templates/fragments/header.php' ?>
    <main class="container-1440 flex large-12 space-between border-radius5px">
        <div class="create large-6 border-radius5px">
            <div class="title-create border-radius5px">
                <h1 class="text-center margin-bottom5">Crée <span class="ta">TA</span> pizza</h1>
            </div>
            <div>
                <form method="POST" id="monform" action="createPizza" >
                    <fieldset class="radio border-radius5px margin-bottom5">
                        <legend>Choisissez votre taille :</legend>
                        <div id="taille">
                            <?php include_once "templates/fragments/taille.php"; ?><!-- on inclut le template taille.php -->
                        </div>
                    </fieldset>
                    <fieldset class="radio border-radius5px margin-bottom5">
                        <legend>Choisissez votre pâte :</legend>
                        <div id="pate">
                            <?php include_once "templates/fragments/pate.php"; ?> <!-- on inclut le template pate.php -->
                        </div>
                    </fieldset>
                    <fieldset class="radio border-radius5px margin-bottom5">
                        <legend>Choisissez votre base :</legend>
                        <div id="sauce">
                            <?php include_once "templates/fragments/sauce.php"; ?> <!-- on inclut le template base.php -->
                        </div>
                    </fieldset>
                    <fieldset class="checkbox border-radius5px margin-bottom5">
                        <legend>Choisissez vos ingrédients :</legend>
                        <div class="ingredients">
                            <?php include_once "templates/fragments/ingredients.php"; ?> <!-- on inclut le template ingredients.php -->
                        </div>
                    </fieldset>
                    <fieldset class="border-radius5px">
                        <div class="action">
                            <button class="btn btn-reset">Reinitiliser</button>
                            <button type="submit" class="btn btn-add">Enregistrer</button>
                            <button class="btn btn-create">Créer nouvelle pizza</button>
                            <button class="btn btn-submit">Ajouter au panier</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="your-pizza large-6">
            <?php include_once "templates/fragments/your_pizza.php"; ?> <!-- on inclut le template your_pizza.php -->
        </div>
    </main>
    <script src="../../js/app.js"></script>
</body>

</html>