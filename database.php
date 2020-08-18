<?php 
// Connexion variables
define('DB_HOST', 'localhost'); //wamp
define('DB_PORT', '3306'); //verifier port (ici mysql dans la premiere page wamp)
define('DB_NAME', 'todolist');// nom de la base de donnée (le tout 1er truc)
define('DB_USER', 'root');
define('DB_PASS', '');

try
{
    // Try to connect to database
    $pdo = new PDO(
        'mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT, 
        DB_USER, 
        DB_PASS
    );

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch (Exception $e)
{
    // Failed to connect
    die('Could not connect');
}

