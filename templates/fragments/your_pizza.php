<?php

// fragement qui afiche les composant de la pizza
// param : $pizzaCurrent (tableau indexé de la piiza)
//         $listeIngredientPizzaCurrent (tableau indexé des ingredient selectionner)
?>
<div>
    <h2 class=" text-center margin-bottom5">Votre pizza</h2>
    <div class="large-12 flex space-between">
        <div class="content-pizza large-6">
            <h3 class="text-center">Votre séléction :</h3>
            <ul>
                <li>Prix de la pizza : 7,90€</li>
                <li>Type de pâte : <?= $pizzaCurrent["nom_pate"] ?></li>
                <li>Taille : <?= $pizzaCurrent["nom_taille"] ?></li>
                <li>Sauce : <?= $pizzaCurrent["nom_base"] ?></li>
                <li>description : Vôtre pizza n'est pas encore construite.</li>
            </ul>
            <br>
        </div>
        <div class="ingredient-pizza large-6">
            <h3 class="text-center">Ingrédients :</h3>
            <?php
            foreach ($listeIngredientPizzaCurrent as $ingredient) {
                if ($ingredient["nom"] > 1) {
                    echo "";
                } else {
                    echo "<p>" . $ingredient["nom"] . "</p>";
                }
            }
            ?>
        </div>
        <div class="sum-pizza large-12 flex item-center justify-center">
            <p>Total : <?= $pizzaCurrent["prix"] ?>€</p>
        </div>
    </div>
</div>
<div>
</div>