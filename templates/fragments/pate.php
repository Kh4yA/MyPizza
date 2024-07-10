<?php

// fragament des radios pate
//param : $listePate(tabeau indexé de pate )
//         $pizza (objet pizza)

?>

<div class="flex space-around item-center">
    <?php
    foreach ($listePate as $pate) {
    ?>
        <div class="pate flex item-center gap-10px">
            <label for=""><?= $pate->get("nom") ?> <?php
                                                    if ($pate->get("nom") == 0.00) {
                                                        echo $pate->get("prix");
                                                    } else {
                                                        echo "";
                                                    }
                                                    ?></label>
            <p class="infoPate">&#x24D8;</p>
            <input type="radio" name="pate" id="<?= $pate->get("nom") ?>" value="<?= $pate->getId() ?> " <?php if ($pate->getId() == $pizza->get("pate")) {
                                                                                                            ?> checked <?php
                                                                                                                            } ?> />
        </div>

    <?php
    }
    ?>

    <?php
    // <div class="flex item-center gap-10px">
    //     <label for="">Fine</label>
    //     <input type="radio" name="pate" id="fine" value="fine">
    // </div>
    // <div class="line"></div>
    // <div class="flex item-center gap-10px">
    //     <label for="">Classique</label>
    //     <input type="radio" name="pate" id="classique" value="classique">
    // </div>
    // <div class="line"></div>
    // <div class="flex item-center gap-10px ">
    //     <label for="">Pâte cheese + 3,50€</label>
    //     <input type="radio" name="pate" id="cheese" value="cheese">
    // </div>
    ?>
</div>