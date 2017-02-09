<!DOCTYPE html>
<!--
Ecran pour deconnexion de l'usager
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bye Bye</title>
    </head>
    <body>
        Logoff
        <?php
            session_start();
            session_destroy();
            header('Location: index.php');
        ?>
    </body>
</html>
