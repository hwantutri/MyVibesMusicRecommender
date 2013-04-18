	<?php


include "/home/myvibes/myvibes/PageRank/adjacency_matrix.php";

function rowStochastic($damping_factor, $matrix){
	$graph_size = sizeof($matrix);
	$d = (1 - $damping_factor) / $graph_size;
	$row_total = array();

	for($i = 0; $i  < $graph_size; $i++){
		array_push($row_total, 0);
		for($j = 0; $j < $graph_size; $j++){
			$row_total[$i] += $matrix[$i][$j];
		}
	}
	
	$new_matrix = $matrix;
	
	for($i = 0; $i < $graph_size; $i++) {
		for($j = 0; $j < $graph_size; $j++) {
			if($row_total[$i] > 0) {
				$new_matrix[$i][$j] = $new_matrix[$i][$j] / $row_total[$i]	+ $d;	
			}
			else {
				$new_matrix[$i][$j] = (1 / $graph_size) + $d;			
			}
		}
	}
	return $new_matrix;
}


function normalizeVector($eigen_vector) {
	$size = sizeof($eigen_vector);	
	$t = 0;
	$normalized_eigenvector = array();
	
	for($i = 0; $i < $size; $i++) {
		$t += $eigen_vector[$i];
	}
	for($i = 0; $i < $size; $i++) {
		$normalized_eigenvector[$i] = $eigen_vector[$i] * (1.0 / $t);
	}
	return $normalized_eigenvector;
}


function eigenVector($transposed_matrix) {
	$tolerance = 0.000001;
	$graph_size = sizeof($transposed_matrix);
	$vector = array();
	$sum = array();

	for($i = 0; $i < $graph_size; $i++) {
		array_push($vector, 1);
	}
	
	$c_old = 0;

	for($i = 0; $i < 100; $i++) {
		$new_vector = normalizeVector($vector);
		$vector_size = sizeof($new_vector);
		$c_new = $new_vector[0];
		
		$e = 100 * ($c_new - $c_old) / $c_new;
		
		if(abs($e) < $tolerance) {
			break;		
		}
		for($j = 0; $j < $graph_size; $j++) {
			$vector[$j] = 0;
			for($k = 0; $k < $vector_size; $k++) {
				$vector[$j] += ($transposed_matrix[$j][$k] * $new_vector[$k]);
			}
		}
		
		$c_old = $c_new;
	}
	return $vector;
}


function transpose($arr) {
	ini_set('memory_limit','200M');
	$out = array();
	foreach ($arr as $key => $subarr) {
    		foreach ($subarr as $subkey => $subvalue) {
    			$out[$subkey][$key] = $subvalue;
    		}
    	}
    	return $out;
}

?>
