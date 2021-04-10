<?php
main();


function main () {
	
	$apiCall = 'https://api.covid19api.com/summary';
	// $json_string = file_get_contents($apiCall); 
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);
	//$data = $obj->Global->NewConfirmed;
    $arr1 = Array();
    $arr2 = Array();
    foreach($obj->Countries as $i){
        //$data = $obj->Countries[$i]->Country . " : " . $obj->Countries[$i]->TotalDeaths;
        array_push($arr1, $i->Country);
        array_push($arr2, $i->TotalDeaths);
    }
	//$data = $obj->Countries[170]->Country . " : " . $obj->Countries[170]->TotalDeaths;
	//echo $data." <br><br> ";
    array_multisort($arr2, SORT_DESC, $arr1);
   // print_r($arr1);
    //echo "<br>";
   // print_r($arr2);
   echo "<body>";
   echo "<div>";
   echo "<header>";
   echo "<title>AS18</title>";
   echo "<h1>Assignment 18</h1>";
   echo "<h3><a href='https://github.com/mmsimsac/as18' style='color:red;'>GitHub repo</a></h3> <br></header>";
   echo "<style>
        table, th, td {
            border: 1px solid chartreuse;
            border-collapse: collapse;
            padding: 15px
            
        }
        div {
        }
        header {
            
            color: white;
        }
        body {
            background-color: black;
        }
        </style>";

   echo "<table style='color:white;'><tr><th>Countries</th><th>Total Deaths</th></tr>";
   for($i=0;$i<10;$i++){
        echo "<tr><td>" . $arr1[$i] . "</td><td>" . $arr2[$i] . "</td></tr>";
   }
   echo "</table></div></body><br>";
}


function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}