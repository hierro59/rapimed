<?php
$dirBase = explode('cronjobs', dirname(__FILE__));
require_once($dirBase[0]."/system/db.fnc.php");
//require_once('../system/db.fnc.php');

global $pdo;
$pdo = dbPDO(DB_ENGN, DB_HOST, DB_NAME);

function CheckMetadata() {

    global $pdo;
    $qryCheckMetadata = "SELECT * FROM metadata_users WHERE city = 'Sin datos'";
    $sqlCheckMetadata = $pdo->prepare($qryCheckMetadata);
    $sqlCheckMetadata->execute();
    $regCheckMetadata = $sqlCheckMetadata->fetchAll();
    
    return $regCheckMetadata;
}

$datos = CheckMetadata();

//var_dump($datos);

/* foreach ($datos as $key => $value) {
    var_dump($value->id);
} */


for ($i=0; $i < count($datos); $i++) { 
    var_dump($datos[$i]['id']);
}