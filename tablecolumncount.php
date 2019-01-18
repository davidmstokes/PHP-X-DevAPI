<?php
$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost");

$session->sql("CREATE DATABASE IF NOT EXISTS foo")->execute();
$session->sql("DROP TABLE foo.test_table")->execute();
$session->sql("CREATE TABLE foo.test_table(x int, y int)")->execute();
$session->sql("INSERT INTO foo.test_table(x,y) VALUES ('1','2')")->execute();

$sql = $session->sql("SELECT * from foo.test_table")->execute();

echo "Column count ".  $sql->getColumnCount() . "\n";
