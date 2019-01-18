<?php
$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost");

$session->sql("DROP DATABASE IF EXISTS addressbook")->execute();
$session->sql("CREATE DATABASE addressbook")->execute();

$schema     = $session->getSchema("addressbook");
$collection = $schema->createCollection("people");

$collection->add('{"name": "Alfred", "age": 18, "job": "Butler"}')->execute();
$collection->add('{"name": "Bob",    "age": 19, "job": "Painter"}')->execute();
$collection->add('{"name": "Cal",    "age": 99, "job": "Presenter"}')->execute();
$collection->add('{"name": "Adam",    "age": 89, "job": "Organizer"}')->execute();
$collection->add('{"name": "Ada",    "age": 22, "job": "Programmer"}')->execute();

echo "All records\n";
$result = $collection->find()->execute();
print_r($result->fetchALL());

// Remove all painters
$result = $collection->remove("job in ('Painter')")->execute();

// Remove the oldest butler
$collection
  ->remove("job in ('Butler')")
  ->sort('age desc')
  ->limit(1)
  ->execute();

// Remove record with lowest age
$collection
  ->remove('true')
  ->sort('age desc')
  ->limit(1)
  ->execute();

echo "After we have removed painter, Butler, and youngest\n";
$result = $collection->find()->execute();
print_r($result->fetchAll());
?>

