<?php
function connexion(){
    return $bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');
}
$bdd = connexion();
?>