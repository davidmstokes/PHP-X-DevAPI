<?php

$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost");

$schemas = $session->getSchemas();
echo "Available Schemas:\n";
print_r($schemas);
?>
