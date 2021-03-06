<?php
$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost");

$session->sql("DROP DATABASE IF EXISTS addressbook")->execute();
$session->sql("CREATE DATABASE addressbook")->execute();
$session->sql("CREATE TABLE addressbook.names(name text, age int)")->execute();
$session->sql("INSERT INTO addressbook.names values ('John', 42), ('Sam', 33)")->execute();

$schema = $session->getSchema("addressbook");
$table  = $schema->getTable("names");

$row = $table->select('name', 'age')->execute()->fetchAll();

print_r($row);

echo "Deleting\n";
$table->delete()
  ->where("age = :id")
  ->bind(['id' => 42])
  ->limit(1)
  ->execute();

echo "After delete\n";
$row = $table->select('name', 'age')->execute()->fetchAll();
print_r($row);

?>
