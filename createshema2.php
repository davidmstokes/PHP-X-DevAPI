<?php
$uri  = 'mysqlx://myuser:mypass@127.0.0.1:33060/';
$sess = mysql_xdevapi\getSession($uri);

try {

    if ($schema = $sess->createSchema('fruit')) {
        echo "Info: I created a schema named 'fruit'\n";
    }
    
} catch (Exception $e) {

   echo $e->getMessage() . "\n";

} finally {

   echo "Proceeding\n";
}
?>
