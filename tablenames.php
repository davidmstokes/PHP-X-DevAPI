<?php
$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost");

$session->sql("CREATE DATABASE IF NOT EXISTS addressbook")->execute();
$session->sql("CREATE TABLE addressbook.test_table (name char(5),x int)")->execute();
$session->sql("INSERT INTO addressbook.test_table values ('John', 42), ('Sam', 33)")->execute();

$sql = $session->sql("SELECT * from addressbook.test_table")->execute();

$colnames = $sql->getColumnNames();
  
print_r($colnames);
