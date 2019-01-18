<?php
try {
    $session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@host");
} catch(Exception $e) {
    die("Connection could not be established: " . $e->getMessage());
}

$schemas = $session->getSchema();
print_r($schemas);

$mysql_version = $session->getServerVersion();
print_r($mysql_version);

var_dump($collection->find("name = 'Alfred'")->execute()->fetchOne());
?>
