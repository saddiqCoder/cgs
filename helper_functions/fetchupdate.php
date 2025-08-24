<?php

include "loader.php";

function echo_out_updateresult($rows, $row_counter){
    for ($counter1 = 0; $counter1 < $row_counter; $counter1++){
		$updatecontent = '
            <li class="full_width_items">
                <a href="'.$rows[$counter1][2].'" class="full_width_img"> 
                    <img src="'.$rows[$counter1][0].'">
                    <span class="full_width_cati">'.$rows[$counter1][1].'</span>
                </a>
                <div class="full_width_content">
                    <a href="'.$rows[$counter1][2].'" class="full_width_title">
                        <h1>'.$rows[$counter1][4]." ".$rows[$counter1][5].'</h1>
                    </a>
                    <span class="full_width_poster">
                        posted by: <span>'.$rows[$counter1][3].'</span>
                    </span>
                </div>
            </li>
		';
		echo $updatecontent;
    }
}

function fetchupdate(){

// muisc column to search 
$musicdbcolumn1 = "artistName";
	$musicdbcolumn2 = "songTitle";




// connecting Varible 
$con = connect_to_db($hostname, $dbusername, $dbpass, $dbname);

// declaring and empty array to hold different querys
$query = [];
$queryarray = [];
$currentdate = date("F d, Y");
	
// Query to search only music table in the database
$query['musicquery'] = "
    SELECT `imagePath`, `category`, `pagePath`, `userName`,`".$musicdbcolumn1."`, `".$musicdbcolumn2."`  FROM ".$musicdbtable." 
    WHERE 1=1 OR `date` = '".$currentdate."' OR `checkout` = 'on'  ORDER BY CONCAT(`date`, `time`) DESC LIMIT 5 OFFSET 0
";





$runmusic = run_query($con, $query['musicquery']);
$runmusicresult = mysqli_fetch_all($runmusic);



$queryarray['result'] = array_merge($runmusicresult);

shuffle($queryarray['result']);
// print_r($queryarray);
// echo count($queryarray['result']);

echo_out_updateresult($queryarray['result'], count($queryarray['result']));

}


?>