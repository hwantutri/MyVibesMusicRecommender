<?php

/*
start of execution time
*/

$mtime = microtime(); 
$mtime = explode(" ",$mtime); 
$mtime = $mtime[1] + $mtime[0]; 
$starttime = $mtime;


include "/home/myvibes/myvibes/PageRank/to_page_rank.php";
include "/home/myvibes/myvibes/PageRank/top_songs.php";

function pagerank($uid) {
	$damping_factor = 0.85;
	$matrix = array();
	$matrix = adjacencyMatrix($uid);
	if(sizeof($matrix) > 0){
		$row_stochastic_matrix = rowStochastic($damping_factor, $matrix);
		$transposed_matrix = transpose($row_stochastic_matrix);
		$eigen_vector = eigenVector($transposed_matrix);
		$normalized_eigenvector = normalizeVector($eigen_vector);
		insertToUsrPR($uid, $normalized_eigenvector);
	}else{
		exit();	
	}
}

function pagerankGrp($uid) {
	$damping_factor = 0.85;
	$matrix = array();
	$matrix = adjacencyMatrixGrp($uid);
	if(sizeof($matrix) > 0){
		$row_stochastic_matrix = rowStochastic($damping_factor, $matrix);
		$transposed_matrix = transpose($row_stochastic_matrix);
		$eigen_vector = eigenVector($transposed_matrix);
		$normalized_eigenvector = normalizeVector($eigen_vector);
		insertToGrpPR($uid, $normalized_eigenvector);
	}else{
		exit();	
	}
}

function pagerankGlb() {
	$damping_factor = 0.85;
	$matrix = array();
	$matrix = adjacencyMatrixGlb();
	if(sizeof($matrix) > 0){
		$row_stochastic_matrix = rowStochastic($damping_factor, $matrix);
		$transposed_matrix = transpose($row_stochastic_matrix);
		$eigen_vector = eigenVector($transposed_matrix);
		$normalized_eigenvector = normalizeVector($eigen_vector);
		insertToGlbPR($normalized_eigenvector);
	}else{
		exit();	
	}
}

$users = array();
$users = users();
/*
foreach($users as &$uid){
	pagerank($uid);
	pagerankGrp($uid);
}
*/
pagerankGlb();

// end of execution

 $mtime = microtime(); 
 $mtime = explode(" ",$mtime); 
 $mtime = $mtime[1] + $mtime[0]; 
 $endtime = $mtime; 
 $totaltime = ($endtime - $starttime); 
 echo "This page was created in ".$totaltime." seconds";
 echo "\n";
?>
