<?php
// templates des checkob ingredients
// param : $listeIngredient ( tableau indexé des ingredient a afficher)


foreach ($listeIngredient as $ingredient) {
?>
    <div class="box-ingredient flex item-center">
        <div class="ingredient-content flex item-center">
            <input type="checkbox" name="ingredient[]" id="<?= $ingredient->get("nom") ?>" value="<?= $ingredient->getId() ?>"
            <?php if ($pizza_ingredient->exist($ingredient->getId(), $this->getIdPizza()) == true){
                 ?> checked= <?php 
                 }elseif($ingredient->getId()===0){
                    ?> /> <?php 
                 } ?>/>
            <label for=""><?= $ingredient->get("nom") ?> + <?= $ingredient->get("prix") ?>€</label>
            <img class="img-ingredient" src="../../img/<?php echo $ingredient->get("photo") ?>.png" alt="<?= $ingredient->get("description") ?>">
        </div>
        <p><?= $ingredient->get("description") ?></p>
    </div>
<?php
}

// <div>
//     <input type="checkbox" name="ingredient" id="jambon" value="jambon">
//     <label for="">Jambon + 2,00€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="mozzarella" value="mozzarella">
//     <label for="">Mozzarella + 1,50€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="Merguez" value="Merguez">
//     <label for="">Merguez + 3,00€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="origan" value="origan">
//     <label for="">Origan + 1,00€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="raclette" value="raclette">
//     <label for="">Raclette + 2,50€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="peperroni" value="peperroni">
//     <label for="">Peperroni + 2,20€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="oignon" value="oignon">
//     <label for="">Oignons + 1,50€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="steack" value="steack">
//     <label for="">Steack + 3,50€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="chevre" value="chevre">
//     <label for="">Chèvre + 2,80€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="poivron" value="poivron">
//     <label for="">Poivron + 1,70€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="poulet" value="poulet">
//     <label for="">Poulet + 2,40€</label>
// </div>
// <div>
//     <input type="checkbox" name="ingredient" id="lardon" value="lardon">
//     <label for="">Lardon + 2,40€</label>
// </div>