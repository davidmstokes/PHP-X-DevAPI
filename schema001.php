#!/bin/php
<?php

$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost:33060");
if ($session === NULL) {
  die("Connection could not be established");
} 


try {

    if ($collection = $session->getSchema("testxx")->getCollection("example1")) {
        echo "Info: Connected to schema 'fruit' and collection 'example1'\n";
    }

} catch (Exception $e) {

   echo $e->getMessage() . "\n";

} finally {

   echo "Proceeding\n";
}

$mySchema = $session->getSchema("world_x");
$myCollection = $mySchema->getCollection("example1");

if ($mySchema->existsInDatabase()) {
	echo "Yes, schema 'world_x' is present\n";
}

if ($myCollection->existsInDatabase()) {
	echo "Yes, collection 'example1' is present\n";
} else {
	echo "Nope 2\n";
}


var_dump($collection->find("name = 'Mike'")->execute()->fetchOne());

$result = $collection->find()->execute();
foreach ($result as $doc) {
  echo "${doc["name"]} is a ${doc["job"]}.\n";
}
?>

