<?php
//include('class/paginator.class.php');
//$conn = new pgsql_db();
//error_reporting(0);

pg_connect("host=localhost port=5432 dbname=Myvibes user=postgres password=tseree");

$sid = $_GET['id'];

$sql = pg_query("SELECT * FROM songs WHERE sid='$sid'");
while($row = pg_fetch_object($sql)){
	$title = $row->title;
	$artist = $row->artist;
	$album = $row->album;
	$year = $row->year;
	$genre = $row->genre;
}

//echo json_encode(array("a"=>$title,"b"=>$artist,"c"=>$genre));
echo "<b>Title:</b> ". $title . "<br/><b>Artist:</b> ". $artist . "<br/><b>Album:</b> " . $album . "<br/><b>Year:</b> ". $year . "<br/><b>Genre:</b> " . $genre . "<br/>";

?>