<?php
require_once("db.def.php");

/**
 * dbPDO
 * Crea un objeto PDO para su uso en la aplicación utilizando los
 * parámetros recibidos como origen.
 *
 * @param  string $engn    Manejador de BD (MySQL, Postgres, SQLite, etc.)
 * @param  string $host    Nombre / IP del servidor de BD
 * @param  string $dbname  Nombre de la BD a usar
 * @param  string $charset Juego de caracteres a ser usados. Por omisión se
 *                         usa utf8mb4
 *
 * @return object          Objeto PDO para manejar la conexión a la BD.
 */
function dbPDO($engn = DB_ENGN, $host = DB_HOST, $dbname = DB_NAME, $charset = "utf8mb4")
{
    // Cadena DNS
    $dns = "$engn:host=$host;dbname=$dbname;charset=$charset;";

    try {
        $pdo = new PDO($dns, DB_USER, DB_PWRD);
        $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exc) {
        // Mensaje que debe mostrarse con formato Bootstrap
        echo "¡No se pudo establecer una conexión a la base de datos!<br />";

        // Función para almacenar el error
        ErrorPDO($exc->getMessage());
    }

    return ($pdo);                                                           // Retorno el objeto PDO
}

/**
 * ErrorPDO
 * Muestra los mensajes de error de excepción que pudieran generarse al
 * momento de intentar una conexión a una BD.
 *
 * @param string $err Mensaje de error de excepción
 *
 */
function ErrorPDO($err)
{
    if (!defined("PDO::ATTR_DRIVER_NAME")) {
        $errmsg = "PDO NO está disponible<br />";
    } else {
        $errmsg = "no se sabe";
    }
    echo $errmsg . "Error: <strong>" . $err . "</strong>";
}

/**
 * CheckPDO
 * Termina la ejecución del programa y muestra el mensaje generado por
 * ErrorPDO().
 *
 * @param object $pdo Objeto PDO retornado por la función dbPDO().
 * 
 */
function CheckPDO($pdo)
{
    if (!$pdo) {
        exit;
    }
}
