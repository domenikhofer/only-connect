<?php
	include('solutions.php');
	$counts = [0,0,0,0];
	$ids = $_POST['ids'];
	foreach($ids as $key=>$value){
		for($i = 0; $i<4;$i++){
			for($j = 0; $j<4;$j++){
			if($value === $options[$i][$j][0]){
			$counts[$i]++;
				}
			}
			}
		
		}
		
		
	if(array_search(4,$counts) > -1){
	echo json_encode($options[array_search(4,$counts)]);
	}
	?>