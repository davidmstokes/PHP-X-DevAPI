#!/bin/php
<?php

$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost:33060");
if ($session === NULL) {
  die("Connection could not be established");
} 

$marco = [
  "name" => "Marco",
  "age"  => 19,
  "job"  => "Programmer"
];
$mike = [
  "name" => "Mike",
  "age"  => 39,
  "job"  => "Manager"
];

$schema = $session->getSchema("testxx");
$collection = $schema->createCollection("example");
$collection = $schema->getCollection("example");

$collection->add($marco, $mike)->execute();

var_dump($collection->find("name = 'Mike'")->execute()->fetchOne());
?>

