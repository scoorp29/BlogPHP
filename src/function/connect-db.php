<?php

$bdd = '';
$createTable = '';
$server = 'db';
$user = 'ipssi';
$mdp = 'ipssi';
$db = 'ippsi_db';

//Function Connect Data Base
function connect($server, $user, $mdp, $db, &$bdd)
{
    try {
        $bdd = new PDO('mysql:host=' . $server . ';dbname=' . $db . '', $user, $mdp);
    } catch (Exception $e) {
        die('Erreur  : ' . $e->getMessage());
    }
}

connect($server, $user, $mdp, $db, $bdd);

//Function Create Table
function createTable($db, $table, $columns, &$createTable, $bdd)
{
    //Create table if not exist
    $createTable = $bdd->exec("CREATE TABLE IF NOT EXISTS $db.$table ($columns)");

}


