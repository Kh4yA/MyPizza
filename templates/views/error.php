<?php

// template error
// role : affichage des erreurs
// param : 
        // message : message a afficher

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    <p><?php echo nL2br(htmlspecialchars(file_get_contents("error.log"))) ?></p>
</body>
</html>