<?php
$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost");
$session->sql("DROP DATABASE IF EXISTS addressbook")->execute();
$session->sql("CREATE DATABASE addressbook")->execute();

$schema = $session->getSchema("addressbook");
$create = $schema->createCollection("people");

echo "Collection 'people' created\n And deleting\n";
$schema->dropCollection("people");
// ...

$collection = $schema->getCollection("people");

// ...

if (!$collection->existsInDatabase()) {
    echo "The collection no longer exists in the database named addressbook. What happened?";
}
?>
