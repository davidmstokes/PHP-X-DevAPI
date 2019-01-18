<?php
$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost");
$session->sql("DROP DATABASE IF EXISTS addressbook")->execute();
$session->sql("CREATE DATABASE addressbook")->execute();

$schema = $session->getSchema("addressbook");
$create = $schema->createCollection("people");

$collection = $schema->getCollection("people");

// Using add()
$result = $collection->add('{"name": "Wilma", "age": 23, "job": "Teacher"}')->execute();

// Using addOrReplaceOne()
// Note: we're passing in a known _id value here
$result = $collection->addOrReplaceOne('00005b6b53610000000000000056', '{"name": "Fred",  "age": 21, "job": "Construction"}');

?>
