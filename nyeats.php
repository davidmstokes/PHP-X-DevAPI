#!/bin/php
<?php

$session = mysql_xdevapi\getSession("mysqlx://myuser:mypass@localhost:33060");
if ($session === NULL) {
  die("Connection could not be established");
} 

$schema = $session->getSchema("nyeats");
$table  = $schema->getTable("restaurants");

$sqlx =
"WITH cte1 AS (SELECT doc->>\"$.name\" AS 'name',
 doc->>\"$.cuisine\" AS 'cuisine',
        (SELECT AVG(score) FROM 
        JSON_TABLE(doc, \"$.grades[*]\"
        COLUMNS (score INT PATH \"$.score\")) as r ) AS avg_score
 FROM restaurants)
 SELECT *, rank() OVER 
  (PARTITION BY cuisine ORDER BY avg_score) AS `rank`
  FROM cte1 
  ORDER by `rank`, avg_score DESC limit 10";

$row->sql($sqlx)->execute()-fetchAll();
print_r($row);

