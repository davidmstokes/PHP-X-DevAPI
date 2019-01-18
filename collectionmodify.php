<?php
$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost");

$session->sql("DROP DATABASE IF EXISTS addressbook")->execute();
$session->sql("CREATE DATABASE addressbook")->execute();

$schema     = $session->getSchema("addressbook");
$collection = $schema->createCollection("people");

$collection->add('{"name": "Alfred", "age": 18, "job": "Butler"}')->execute();
$collection->add('{"name": "Bob",    "age": 19, "job": "Painter"}')->execute();
$result1 = $collection->find()->execute();
print_r($result1->fetchALL());
echo "^ before, after below\n";

// Add two new jobs for all Painters: Artist and Crafter
$collection
  ->modify("job in ('Butler', 'Painter')")
  ->arrayAppend('job', 'Artist')
  ->arrayAppend('job', 'Crafter')
  ->execute();

// Remove the 'beer' field from all documents with the age 21
$collection
  ->modify('age < 21')
  ->unset(['beer'])
  ->execute();

// And peek at the results 
$result2 = $collection->find()->execute();
print_r($result2->fetchAll());
#$result3 = $collection->find()->execute();
foreach ($result2 as $doc) {
  echo "${doc["name"]} is ${doc["age"]}.\n";
}
?>
