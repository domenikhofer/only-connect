<?php

	function getRand(){
	$random_string_length = 3;
	$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$string = '';
	$max = strlen($characters) - 1;
	for ($i = 0; $i < $random_string_length; $i++) {
		$string .= $characters[mt_rand(0, $max)];
	}
	return $string;
	}
	
	$filename = "solutions.php";
$ourFileName =$filename;
$ourFileHandle = fopen($ourFileName, 'w');



$written =  "<?php
   \$options = [
	[['".getRand()."' , 'Mickey'],[ '".getRand()."' , 'Minnie'],[ '".getRand()."' , 'Pluto'],[ '".getRand()."' , 'Donald']],
	[['".getRand()."' , 'Venus'],[ '".getRand()."' , 'Mars'],[ '".getRand()."' , 'Jupiter'],[ '".getRand()."' , 'Saturn']],
	[['".getRand()."' , 'Snickers'],[ '".getRand()."' , 'Bounty'],[ '".getRand()."' , 'Milkyway'],[ '".getRand()."' , 'Twix']],
	[['".getRand()."' , 'Barack'],[ '".getRand()."' , 'Bill'],[ '".getRand()."' , 'George'],[ '".getRand()."' , 'Ronald']],
	];
?>
";

fwrite($ourFileHandle,$written);

fclose($ourFileHandle);
	
?>