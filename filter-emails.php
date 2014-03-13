<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Filter duplicate emails</title>
    <meta charset="utf-8">
  </head>
  <body>	
	<?php
		function readCSV($csvFile){
			$file_handle = fopen($csvFile, 'r');
			while (!feof($file_handle) ) {
				$line_of_text[] = fgetcsv($file_handle, 1024);
			}
			fclose($file_handle);
			$values = arrayOrganize($line_of_text);
			return $values;
		}
		function arrayOrganize($array){
			$values = array();
			foreach($array as $a){
				$values[] = (is_array($a)) ? $a[0] : $a;
			}
			return $values;
		}
		// Set path to CSV file
		//$source = 'elle-list-active.csv';
		$source = 'marry3-dot-3-active.csv';
		$array1 = readCSV($source);
		$filter = 'marry3-opened.csv';
		$array2 = readCSV($filter);
		$result = array_diff($array1, $array2);
		foreach($result as $r){
			if(!empty($r) && filter_var($r, FILTER_VALIDATE_EMAIL)) {
				echo $r.'<br />';
			}
		}
	?>
	</body>
</html>