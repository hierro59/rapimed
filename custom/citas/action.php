<?php

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}

switch ($action) {
    case 'acept-cita':
        echo "Aceptada";
        break;
}
