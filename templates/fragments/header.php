<?php

// fragment header 
// role : met en forme le header 

?>

<header class="flex item-center">
        <h1>MyPizza</h1>
        <?php
        if(empty($_GET)){
            ?>
            <a href="controller/createPizza" class="btn-primary">Créer ta pizza</a>
            <a href="panier" class="btn-primary">Panier</a>
            <?php
        }elseif($_GET['p'] === 'controller/createPizza'){
            ?>
            <a href="controller/panier" class="btn-primary">Panier</a>
            <a href="home">Retour</a>
            <?php
        }else{
            ?>
            <a href="createPizza" class="btn-primary">Créer ta pizza</a>
            <a href="home" class="btn-primary">Panier</a>
            <?php
        }
        ?>
    </header>
