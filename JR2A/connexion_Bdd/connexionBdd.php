<?php
    try
    {
        $bdd = new PDO('mysql:host=mysql-sedinsedir.alwaysdata.net;dbname=sedinsedir_groupe4g4;charset=utf8', '197430_admin', 'W1x2c3v4b5');
    }
    catch(Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
?>