<?php

function connect_to_db($host_name, $user_name, $password, $db){

	if (!empty($host_name) && !empty($user_name) /* && !empty($password) */ && !empty($db) && @mysqli_connect($host_name, $user_name, '', $db) !== false){
		return mysqli_connect($host_name, $user_name, '', $db);
	}else{
		echo mysqli_connect_error(). '<br><hr> <b>ORDER ERROR: </b> ' ." missing, empty or undefined <b>variable/arguments</b> in (connect_to_db)! function";
		return false;
	}

}

function run_query($con, $query){

	if (!empty($con) && !empty($query)){
		return mysqli_query($con, $query);
	}else{
		echo '<b>run_query_error: </b> '. 'missing, empty or undefined <b>variable/arguments</b> in (run_query)! function';
		return false;
	}
}

function comfirm_query($con){
	if (mysqli_error($con)){
		echo mysqli_error($con);
		return false;
	}
}

function clean_query_var($con, $var){
	$var = strtolower(trim($var));
	$var = mysqli_real_escape_string($con, $var);
	$var = htmlentities($var);
	return $var;
}

?>
