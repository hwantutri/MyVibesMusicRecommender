<?php

pg_connect("host=localhost port=5432 dbname=myvibes user=myvibes password=tseree");

//echo pg_num_rows(pg_query("SELECT * FROM userprof"));

$loo = pg_query("SELECT * FROM songs");

echo pg_num_rows($loo);
?>
