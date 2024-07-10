<?php

// fragment des radio sauces
//param : $listeBase (liste indexé des base) 
//         $pizza (objet pizza)



?>
<div class="flex space-around">
    <?php
    foreach ($listeBase as $base) {
    ?>
        <div class="flex item-center gap-10px">
            <label for=""><?= $base->get("nom") ?></label>
            <img class="img-base" src="../../img/<?= $base->get("photo") ?>.png" alt="photo de <?= $base->get("nom") ?>">
            <input type="radio" name="base" id="<?= $base->get("description") ?>" value="<?= $base->getId() ?> " <?php if ($base->getId() == $pizza->get("base")) {
                                                                                                                    ?> checked <?php
                                                                                                                    } ?> />
        </div>

    <?php
    }
    ?>
</div>

<?php
// <div class="flex item-center gap-10px">
//     <label for="">crème fraiche</label>
//     <input type="radio" name="base" id="creme" value="creme">
// </div>
// <div class="line"></div>
// <div class="flex item-center gap-10px">
//     <label for="">sauce tomate</label>
//     <input type="radio" name="base" id="tomate" value="tomate">
// </div>
// <div class="line"></div>
// <div class="flex item-center gap-10px">
//     <label for="">Sauce BBQ</label>
//     <input type="radio" name="base" id="bbq" value="bbq">
// </div>
?>
</div>