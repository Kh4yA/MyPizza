<?php

// fragment qui affiche les radios taillz
// param : $listeTaille (tableau indexé des taille de pizza)
//         $pizza (objet pizza)


?>
<div class="flex space-around item-center">
    <?php
    foreach ($listeTaille as $taille) {
    ?>
        <div class="flex item-center gap-10px">
            <label for=""><?= $taille->get("nom") ?> <?= $taille->get("prix") ?>€</label>
            <input type="radio" name="taille" id="<?= $taille->get("taille")  ?>" value="<?= $taille->getId()?>" <?php if($taille->getId() == $pizza->get("taille"))  {
                ?>
                checked
                <?php
            } ?> />
        </div>
    <?php
    }

    // <div class="flex item-center gap-10px">
    //     <label for="">Medium : 28cm</label>
    //     <input type="radio" name="taille" id="baseM" value="M">
    // </div>
    // <div class="line"></div>
    // <div class="flex item-center gap-10px">
    //     <label for="">L : 33 cm + 3,00€</label>
    //     <input type="radio" name="taille" id="baseL" value="L">
    // </div>
    // <div class="line"></div>
    // <div class="flex item-center gap-10px">
    //     <label for="">XL : 40 cm + 6,00€</label>
    //     <input type="radio" name="taille" id="baseXL" value="XL">
    // </div>
    ?>
</div>