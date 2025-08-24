<?php
// importing database functions to be use for connecting to database and validating SQL querys
require_once("db_functions01.php");

// initializing a connection variable that will hold the connection status to a database 
// Getting database variables ready
$hostname = "localhost";
$dbusername = "root";
$dbpass = "";
$dbname = "loan_db";

$con = connect_to_db($hostname, $dbusername, $dbpass, $dbname);


// This class contains functions that will validates the form details been submitted for manual PHP(validation only).
class validators{
    // This Function is responsible of validating Image fields alone
    function validateImage($name="", $storingLocation="", $con="", $tabledb=""){
        // Getting details about the image to be uploaded
        $file_name = @$_FILES[$name]['name'];
        $file_size = @$_FILES[$name]['size'];
        $file_type =  @$_FILES[$name]['type'];
        $file_tmp_name =  @$_FILES[$name]['tmp_name'];
        $file_extension = @strtolower(pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION));

        // Storing all the details collected into an associative array
        $complete_detail = [];

        $complete_detail["name"] = $file_name;
        $complete_detail["size"] = $file_size;
        $complete_detail["type"] = $file_type;
        $complete_detail["tmp_name"] = $file_tmp_name;
        $complete_detail["extension"] = $file_extension;
        $complete_detail["location"] = $storingLocation;
        $complete_detail["error"] = "";
        $complete_detail['rename'] = "";
        $complete_detail['exist'] = "no";


        
        // making sure the file selected for uploading is actually a Picture 
        if (($file_extension=='jpg' || $file_extension=='jpeg' || $file_extension=='png') && ($file_type=='image/jpeg' || $file_type=='image/png')){
            
            $rname = rand(4028,999).'_'.md5($file_name).'_'.rand(8728,999).'.'.$file_extension; 
            $fileLimit = 1000000;
            $complete_detail['rename'] = $rname;

            // Query and Variable to check if the selected Image already existed in database
            $u = $complete_detail["name"];     
            $q = "SELECT `imageName`, `imageRename`, `imagePath` FROM  ".$tabledb." WHERE `imageName` = "."'".$u."'"." LIMIT 1";
            $run = @mysqli_fetch_assoc(run_query($con, $q));
            
            // Checking and Making sure the Location for Storing Images Existed on the server if not create it.
            if(file_exists($complete_detail["location"])){
              
              //Checking if the file selected for uploading already existed in the Database
              if(!$run['imageName']){               
                
                //Checking if the file selected for uploading already exist on the server
                if (!file_exists($complete_detail["location"]."/".$file_name)){
      
                  // Making sure file size dose not exceed 1mb(1024)
                    if($file_size < $fileLimit){
                        return $complete_detail;
                    }else{
                        $complete_detail["error"] = 'Oops..file size must be lesser than <b>1MB</b>';
                        // returning the array
                        return $complete_detail;
                    }

                }else{
                  $complete_detail["error"] = 'File already exists <b>'.$file_name.'</b>';
                  // returning the array
                    return $complete_detail;  
                }
                
              }else{
                $complete_detail['exist'] = "yes";
                $complete_detail['name'] = $run['imageName'];
                $complete_detail['rename'] = $run['imageRename'];

                // returning the array
                return $complete_detail; 
              }

            }else{

              // this part deal with creating the directory for uploading image if it does not exits already
              if(mkdir($complete_detail["location"])){

                //Checking if the file selected for uploading already existed in the Database
                if(!$run['imageName']){ 

                  // Making sure file size dose not exceed 1mb(1024)
                  if($file_size < $fileLimit){
                      return $complete_detail;
                  }else{
                      $complete_detail["error"] = 'Oops..file size must be lesser than <b>1MB</b>';
                      // returning the array
                      return $complete_detail;
                  }
                  clearstatcache();

                }else{
                  $complete_detail['exist'] = "yes";
                  $complete_detail['name'] = $run['imageName'];
                  $complete_detail['rename'] = $run['imageRename'];
  
                  // returning the array
                  return $complete_detail; 
                }

              }else{
                $complete_detail["error"] = "Oops...Sorry the Directory: <b>{$complete_detail["location"]}</b> does not exists!";
                // returning the array
                return $complete_detail;
              }
            }

        }else{
            if (empty($file_name)){
              $file_name = "Image";
              $complete_detail["error"] = "Please Select a valid Image!";
              return $complete_detail;
            }else{
              $complete_detail["error"] = "Oops...Sorry <b>".$file_name."</b> is not a valid format";
              return $complete_detail;
            }
            
        }
        
        
    }

    // This Function is responsible of validating Audio fields alone
    function validateAudio($name="", $storingLocation="", $con="", $tabledb="", $dbcolumn=""){
      // Getting details about the audio to be uploaded
      $file_name = @$_FILES[$name]['name'];
      $file_size = @$_FILES[$name]['size'];
      $file_type =  @$_FILES[$name]['type'];
      $file_tmp_name =  @$_FILES[$name]['tmp_name'];
      $file_extension = @strtolower(pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION));

      // Storing all the details collected into an associative array
      $complete_detail = [];

      $complete_detail["name"] = $file_name;
      $complete_detail["size"] = $file_size;
      $complete_detail["type"] = $file_type;
      $complete_detail["tmp_name"] = $file_tmp_name;
      $complete_detail["extension"] = $file_extension;
      $complete_detail["location"] = $storingLocation;
      $complete_detail["error"] = "";

      // making sure the file selected for uploading is actually an audio 
      if (($file_extension=='mp3' || $file_extension=='mp4') && ($file_type == "audio/mpeg")){
          
          $rname = rand(4028,999).'_'.md5($file_name).'_'.rand(8728,999).'.'.$file_extension; 
          $fileLimit = (1000000 * 100);
          $complete_detail['rename'] = $rname;

          // Query and Variable to check if the selected Audio/Song already existed in database
          $u = $complete_detail["name"];     
          $q = "SELECT `".$dbcolumn."` FROM  ".$tabledb." WHERE `".$dbcolumn."` = "."'".$u."'"." LIMIT 1";
          $run = @mysqli_fetch_assoc(run_query($con, $q));
          
          if(file_exists($complete_detail["location"])){

              //Checking if the file selected for uploading already existed in the Database
              if(!$run['songName']){

                  //Checking if the file selected for uploading already exist 
                  if (!file_exists($complete_detail["location"]."/".$file_name)){
                      
                  // Making sure file size dose not exide 100mb(1048)
                  if($file_size < $fileLimit){
                      return $complete_detail;
                  }else{
                      $complete_detail["error"] = 'Oops..Sorry <strong>Audio</strong> size must be lesser than <b>100MB</b>';
                      // returning the array
                      return $complete_detail;
                  }

                  }else{
                  $complete_detail["error"] = 'File already exists <b>'.$file_name.'</b>';
                  // returning the array
                  return $complete_detail;  
                  }

              }else{
                  $complete_detail["error"] = 'File already exists <b>'.$file_name.'</b>';
                  // returning the array
                  return $complete_detail; 
              }

          }else{

            // this part deal with creating the directory for uploading image if it does not exits already
            if(mkdir($complete_detail["location"])){

              //Checking if the file selected for uploading already existed in the Database
              if(!$run['songName']){  

                // Making sure file size dose not exide 100mb(1048)
                if($file_size < $fileLimit){
                  return $complete_detail;
                }else{
                    $complete_detail["error"] = 'Oops..Sorry <strong>Audio</strong> size must be lesser than <b>100MB</b>';
                    // returning the array
                    return $complete_detail;
                }

              }else{
                  $complete_detail["error"] = 'File already exists <b>'.$file_name.'</b>';
                  // returning the array
                  return $complete_detail; 
              }

            }else{
              $complete_detail["error"] = "Oops...Sorry the Directory: <b>{$complete_detail["location"]}</b> does not exists!";
              // returning the array
              return $complete_detail;
            }

          }

      }else{
        if (empty($file_name)){
          $file_name = "Audio";
          $complete_detail["error"] = "Please Select a valid Audio file";
          return $complete_detail;
        }else{
          $complete_detail["error"] = "Oops...Sorry <b>".$file_name."</b> is not a valid audio format";
          return $complete_detail;
        }
        
      }
            
    }

    // This Function is responsible of validating Video fields alone
    function validateVideo($name="", $storingLocation="", $con="", $tabledb="", $dbcolumn=""){
      // Getting details about the video to be uploaded
      $file_name = @$_FILES[$name]['name'];
      $file_size = @$_FILES[$name]['size'];
      $file_type =  @$_FILES[$name]['type'];
      $file_tmp_name =  @$_FILES[$name]['tmp_name'];
      $file_extension = @strtolower(pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION));

      // Storing all the details collected into an associative array
      $complete_detail = [];

      $complete_detail["name"] = $file_name;
      $complete_detail["size"] = $file_size;
      $complete_detail["type"] = $file_type;
      $complete_detail["tmp_name"] = $file_tmp_name;
      $complete_detail["extension"] = $file_extension;
      $complete_detail["location"] = $storingLocation;
      $complete_detail["error"] = "";

      // making sure the file selected for uploading is actually an video 
      if (($file_extension=='mkv' || $file_extension=='mp4' || $file_extension=='avi' || $file_extension=='mov') && 
                ($file_type == "video/mp4" || $file_type == "video/x-matroska" || $file_type == "video/quicktime" || $file_type == "video/avi")){
          
          $rname = rand(4028,999).'_'.md5($file_name).'_'.rand(8728,999).'.'.$file_extension; 
          $fileLimit = (1000000 * 100);
          $complete_detail['rename'] = $rname;

          // Query and Variable to check if the selected Video already existed in database
          $u = $complete_detail["name"];     
          $q = "SELECT `".$dbcolumn."` FROM  ".$tabledb." WHERE `".$dbcolumn."` = "."'".$u."'"." LIMIT 1";
          $run = @mysqli_fetch_assoc(run_query($con, $q));
          
          if (file_exists($complete_detail["location"])){
            //Checking if the file selected for uploading already existed in the Database
              if(!$run['videoName']){
                  //Checking if the file selected for uploading already exist 
                  if (!file_exists($complete_detail["location"]."/".$file_name)){
                      
                  // Making sure file size dose not exide 100mb(1048)
                  if($file_size <= $fileLimit){
                      return $complete_detail;
                  }else{
                      $complete_detail["error"] = 'Oops..video size must be lesser than <b>100MB</b>';
                      // returning the array
                      return $complete_detail;
                  }

                  }else{
                  $complete_detail["error"] = 'File already exists <b>'.$file_name.'</b>';
                  // returning the array
                  return $complete_detail;  
                  }
                  
              }else{
                  $complete_detail["error"] = 'File already exists <b>'.$file_name.'</b>';
                  // returning the array
                  return $complete_detail;
              }

          }else{

            if(mkdir($complete_detail["location"])){
                  //Checking if the file selected for uploading already existed in the Database
                  if(!$run['videoName']){ 
                      // Making sure file size dose not exide 100mb(1048)
                      if($file_size <= $fileLimit){
                          return $complete_detail;
                      }else{
                          $complete_detail["error"] = 'Oops..video size must be lesser than <b>100MB</b>';
                          // returning the array
                          return $complete_detail;
                      }
                      
                  }else{
                      $complete_detail["error"] = 'File already exists <b>'.$file_name.'</b>';
                      // returning the array
                      return $complete_detail;
                  }

            }else{
              $complete_detail["error"] = "Oops...Sorry the Directory: <b>{$complete_detail["location"]}</b> does not exists!";
              // returning the array
              return $complete_detail;
            }

          }

      }else{
        if (empty($file_name)){
          $complete_detail["error"] = "Please Select a valid video";
          return $complete_detail;
        }else{
          $complete_detail["error"] = "Oops...Sorry <b>".$file_name."</b> is not a valid videos format";
          echo $file_type;
          return $complete_detail;
        }

      }

    }

    // This Function is responsible of validating Name fields alone
    function validateName($name=""){  
      $msg = [];
      $msg['error'] = "";
      $msg['name'] = "";

      //mysqli_real_escape_string(mysqli_connect("localhost", "root", ""),$name);

      if (empty($name)){
        $msg['error'] = 'Name can not be empty';
        return $msg;
      }else if (strlen($name) <= 2){
        $msg['error'] = 'Name most contain a minimum of 3 character!';
        return $msg;
      }else if (str_word_count($name) >= 30){
        $msg['error'] = 'Name can not be greater than 30 world!';
        return $msg;
      }/*else if (!preg_match("/^[a-zA-Z ]*$/", $name)){
        $msg['error'] = 'Only letters are allowed';
        return $msg;
      }*/else{
        $msg['name'] = $name;
        return $msg;
      }
    }

     // This Function is responsible of validating username fields alone
     function validateUserName($username=""){  
      $msg = [];
      $msg['error'] = "";
      $msg['username'] = "";

      if (empty($username)){
        $msg['error'] = 'User Name can not be empty';
        return $msg;
      }else if (strlen($username) <= 2){
        $msg['error'] = 'User Name most contain a minimum of 3 character!';
        return $msg;
      }else if (str_word_count($username) >= 30){
        $msg['error'] = 'User Name can not be greater than 30 character!';
        return $msg;
      }else{
        $msg['username'] = $username;
        return $msg;
      }
    }

    // This Function is responsible of validating username fields alone
    function validateUserNameDb($username="", $con="", $tabledb=""){  
      $msg = [];
      $msg['error'] = "";
      $msg['username'] = "";

      if (empty($username)){
        $msg['error'] = 'User Name can not be empty';
        return $msg;
      }else if (strlen($username) <= 2){
        $msg['error'] = 'User Name most contain a minimum of 3 character!';
        return $msg;
      }else if (strlen($username) >= 30){
        $msg['error'] = 'User Name can not be greater than 30 character!';
        return $msg;
      }else{

        $u = clean_query_var($con, $username);     
        $q = "SELECT `username` FROM  ".$tabledb." WHERE `username` = "."'".$u."'";

        if( mysqli_num_rows(run_query($con, $q)) >= 1){
            $msg['error'] = "Oops... Sorry user name already taken";
            return $msg;
        }else{
            $msg['username'] = $username;
            return $msg;    
        }
      }
  }

    // This Function is responsible of validating FullName fields alone
    function validateFullName($fullname=""){  
      $msg = [];
      $msg['error'] = "";
      $msg['fullname'] = "";

      //mysqli_real_escape_string(mysqli_connect("localhost", "root", ""),$name);

      if (empty($fullname)){
        $msg['error'] = 'fullname can not be empty';
        return $msg;
      }else if (strlen($fullname) <= 2){
        $msg['error'] = 'fullname most contain a minimum of 3 character!';
        return $msg;
      }else if (strlen($fullname) >= 30){
        $msg['error'] = 'fullname can not be greater than 30 character!';
        return $msg;
      }else if (!preg_match("/^[a-zA-Z ]*$/", $fullname)){
        $msg['error'] = 'Only letters are allowed';
        return $msg;
      }else{
        $msg['fullname'] = $fullname;
        return $msg;
      }
    }

    // This Function is responsible of validating Title fields alone
    function validateTitle($title=""){  
      $msg = [];
      $msg['error'] = "";
      $msg['title'] = "";

      if (empty($title)){
        $msg['error'] = 'Title can not be empty';
        return $msg;
      }else if (strlen($title) <= 2){
        $msg['error'] = 'Title most contain a minimum of 3 character!';
        return $msg;
      }else if (str_word_count($title) >= 30){
        $msg['error'] = 'Title can not be greater than 30 word!';
        return $msg;
      }/*else if (!preg_match("/^[a-zA-Z ]*$/", $title)){
        $msg['error'] = 'Only letters are allowed';
        return $msg;
      }*/else{
        $msg['title'] = $title;
        return $msg;
      }
    }

    // This Function is responsible of validating Biography/Text fields alone
    function validateBio($bio = ""){

      $msg = [];
      $msg['error'] = "";
      $msg['bio'] = "";

      global $con;
      $wordCounter = 1;

      $bio = clean_query_var($con, $bio);

      if (str_word_count($bio) >= $wordCounter){
        $msg['bio'] = $bio;
        return $msg;
      }else{
        $msg['bio'] = $bio;
        $msg['error'] = "Biography filed must contain at least 50 word or more!";
        return $msg;
      }

    }

    // This function validates additional Options checked for the files to be uploaded 
    function optionsValidator($fav="", $chkout="", $trend="", $makepage=""){
      $details = []; // Declaring an array that will be holding all my meta Datas
      
      //setting all Meta datas to off  
      $details['favourite'] = "";
      $details['checkout'] = "";
      $details['trending'] = "";
      $details['makepage'] = "";
      $details['error'] = "";

      // Validating the Options Selected.
      if((isset($fav) && !empty($fav)) || (isset($chkout) && !empty($chkout)) || (isset($trend) && !empty($trend)) || (isset($makepage) && !empty($makepage))){
        $details['favourite'] = $fav;
        $details['checkout'] = $chkout;
        $details['trending'] = $trend;
        $details['makepage'] = $makepage;
        return $details;
      }else{
        // $details['error'] = "One Option Must Be Checked";
        return $details;
      }
    }

    // This Function is responsible of validating password fields only
    function validatePassword($password){
      $msg = [];
      $msg["error"] ="";
      $msg["password"]="";
    
      if (empty($password)){
        $msg['error'] = 'Please enter a password';
        return $msg;
      }else if (strlen($password) < 5){
        $msg['error'] = 'Password must contain at least 8 character or more';
        return $msg;
      }else{
        
        if ($password == @$_POST['pass'] || $password == @$_GET['pass']){
          $msg['password'] = $password;
          return $msg;
        }else{
          $msg['error'] = 'Password not match';
          return $msg;
        }
        
      }	
    }

  // This Function is responsible for validating password re-enter fields only
    function validatePasswordC($password){
      $msg = [];
      $msg['error'] = "";
      $msg['password'] = "";
    
      if (empty($password)){
        $msg['error'] = 'Please re-enter your password';
        return $msg;
      }else if (strlen($password) < 5){
        $msg['error'] = 'Password must contain atlist 8 character or more';
        return $msg;
      }else{
        
        if ($password == @$_POST['pass'] || $password == @$_GET['pass']){
          $msg['password'] = $password;
          return $msg;
        }else{
          $msg['error'] = 'Password not match';
          return $msg;
        }
        
      }	
    }

     // This Function is responsible of validating password fields only
     function validatePass($password){
      $msg = [];
      $msg["error"] ="";
      $msg["password"]="";
    
      if (empty($password)){
        $msg['error'] = 'Please enter a password';
        return $msg;
      }else if (strlen($password) < 5){
        $msg['error'] = 'Password must contain at least 8 character or more';
        return $msg;
      }else{
        
        if ($password == @$_POST['passreg'] || $password == @$_GET['passreg']){
          $msg['password'] = $password;
          return $msg;
        }else{
          $msg['error'] = 'Password not match';
          return $msg;
        }
        
      }	
    }

  // This Function is responsible for validating Emial fields only
    function validateEmail($email="", $con="", $dbtable=""){
      $msg = [];
      $msg['error'] = "";
      $msg['mail'] = "";
            
      if (empty($email)){
        $msg['error'] = 'Email field can not be empty';
        return $msg;
      }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $msg['error'] = 'Invalid email Address';
        return $msg;
      }else{
        $query = "SELECT `mail` FROM $dbtable WHERE `mail` = '".$email."'";
        
        if (mysqli_num_rows(run_query($con, $query)) >= 1){
          $msg['error'] = 'Email already exist... try using another one';
          return $msg;
        }else{
          $msg['mail'] = $email;
          return $msg;
        }
      }
    }

    // This Function is responsible of validating gender fields only
    function validateGender($gender = ""){
      $msg = [];
      $msg['error'] = "";
      $msg['gender'] = "";

      if (empty($gender)){
        $msg['error'] = "Please select your gender";
        return $msg;
      }else{
        $msg['gender'] = $gender;
        return $msg;
      }
    }

    // This Function is responsible of validating Tell phone number fields only
    function validateTel($tel){
      $msg = [];
      $msg['error'] = "";
      $msg['tel'] = "";
      
      if (empty($tel)){
        $msg['error'] = 'this field can not be empty';
        return $msg;
      }else if ($tel == 0 || $tel < 0){
        $msg['error'] = 'invalid phone number';
        return $msg;
      }else if (strlen($tel) < 11 || strlen($tel) > 15){
        $msg['error'] = 'please enter a valid phone number';
        return $msg;
      }else if (preg_match('/[a-zA-Z]/', $tel)){
        $msg['error'] = 'Only number are allowed!';
        return $msg;
      }else{
        $msg['tel'] = $tel;
        return $msg;
      }
      
    }
    
     
}
  
?>