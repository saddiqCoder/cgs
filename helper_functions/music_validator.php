<?php

include_once "creatpage.php";
include_once "generatenavigationpage.php";

$music_artwork = 'music_artwork';
$musicToUpload = 'music_to_upload';
$makeFavourite = hideError($_POST['song_favourite']);
$addToCheckoutList = hideError($_POST['song_checkout']);
$makeTrending = hideError($_POST['song_trending']);
$creatPersonalPage = hideError($_POST['song_personal_page']);
$artiseName = hideError($_POST['song_artise_name']);
$songTitle = hideError($_POST['song_title']);
$biography = hideError($_POST['song_bio']);



function validateMusic($con="", $tabledb="", $musicArtwork="", $musicToUpload="", $makeFavourite="", $addToCheckoutList="", $makeTrending="", $creatPersonalPage="", $artiseName = "", $songTitle = "", $biography = "", $status="pending", $poster="bestxound", $posterid=""){ 
  
  if ($_POST['song']){  
      
      $validate= new validators();
      $report = [];
    
      /*initializing varibles that will hold the directory(folder) to store image and audio files
      which are selected at the time of upload*/
      $imgStoringLocation = "../img/".date("Y", time());
      $audStoringLocation  = "../music/".date("Y", time());

      // Validating The Image which is selected for uploading and returning a complete Array about the Image
      $imgVal = $validate->validateImage($musicArtwork, $imgStoringLocation, $con, $tabledb);
      if ($imgVal['error'] == ""){
        $report['image'] = $imgVal;       
      }else{
        $report['image'] = $imgVal;
      }

      // Validating The Audio/Song which is selected for uploading and returning a complete Array about the Song/Audio
      $audVal = $validate->validateAudio($musicToUpload, $audStoringLocation, $con, $tabledb, "songName");
      if ($audVal['error'] == ""){
        $report['song'] = $audVal;
      }else{
        $report['song'] = $audVal;
      }

      // Validating Artise Name filed and returning a complete Array about the Artise Name
      $artiseNameVal = $validate->validateName($artiseName);
      if ($artiseNameVal['error'] == ""){
        $report['artisename'] = $artiseNameVal;
      }else{
        $report['artisename'] = $artiseNameVal;
      }

      // Validating Song Title and returning a complete Array about the Song Title
      $songTitleVal = $validate->validateTitle($songTitle);
      if ($songTitleVal['error'] == ""){
        $report['songtitle'] = $songTitleVal;
      }else{
        $report['songtitle'] = $songTitleVal;
      }

      // Validating The Addition options for uploading and returning a complete Array
      $optVal = $validate->optionsValidator($makeFavourite, $addToCheckoutList, $makeTrending, $creatPersonalPage);
      if ($optVal['error'] == ""){
        $report['options'] = $optVal;
      }else{
        $report['options'] = $optVal;
      }

      // Validating Biography and returning a complete Array about Biography
      $biographyVal = $validate->validateBio($biography);
      if ($biographyVal['error'] == ""){
        $report['bio'] = $biographyVal;
      }else{
        $report['bio'] = $biographyVal;
      }

      // Checking and Making sure All validation is Successful and No Error was returned
      if ($report['bio']['error'] !== "" || $report['songtitle']['error'] !== "" || $report['image']['error'] !== "" || $report['song']['error'] !== "" || $report['artisename']['error'] !=="" || $report['options']['error'] !== ""){
        return $report;
      }else{
        // Initializing Variable to hold Image and song Parmenet Location
        $imageTo = $imgStoringLocation."/".$report['image']['rename'];
        $songTo = $audStoringLocation."/".$report['artisename']['name']."_".$report['songtitle']['title']."_.".$report['song']['extension'];

        if($report['image']['exist'] == "no"){
          // Moving and uploading image to thier Permenet location
          $moveImage = move_uploaded_file($report['image']['tmp_name'], $imageTo);
        }else{
          $moveImage = true;
        }
        
        // Moving and uploading song to thier Permenet location
        $moveSong = move_uploaded_file($report['song']['tmp_name'], $songTo);
        

        // checking and making sure the uploaded song and image are moved to their permenet location successfuly 
        if ($moveImage && $moveSong){
            $datee = date("F d, Y");
            $timee = date("G:i:s");
            $year = date("Y");

            $generalImagePath = str_replace("../", "", $imageTo);
            $generalSongPath = str_replace("../", "", $songTo);


            // Declaring and initializing Variables for creating personal pages
            $pageURL = $report['artisename']['name']."_".$report['songtitle']['title'].".php";
            $categoryP = "music";
            $pagelocationP = "../".$categoryP."/".$year."/".$pageURL;
            $headingP = $report['artisename']['name']."_".$report['songtitle']['title'];
            $artisenameP = $report['artisename']['name'];
            $imgpathP = "../../".$generalImagePath;
            $downloadiconP = "../../img/download.gif";
            $filepathP = str_replace($categoryP."/".$year."/", "", $generalSongPath);
            $posterP = $poster;
            $filesizeP = $report['song']['size']." Byte";
            $dateeP = date("F d, Y");
            $bioP = $report['bio']['bio'];

            // Generating direct link(URL) for this page
            $pagePath = "https://bestxound.com/".$categoryP."/".$year."/".$pageURL;

            // Setting Music name||title to the current Name and title enter during uploading 
            $report['song']['rename'] = $filepathP;

            // Initializing creatpage function which is from creatpage.php to creat personal page
            $creatPage = creatpage($pagelocationP, $categoryP, $headingP, $posterP, $dateeP, $imgpathP, $downloadiconP, $bioP, $filepathP, $filesizeP, $artisenameP);

            // Making sure the page was created successfuly before inserting into Date
            if($creatPage['error'] == ""){
                  $q = "
                  INSERT INTO `musicdetails`(`userID`, `userName`, `imageName`, `imageRename`, `imagePath`, `songName`, `songRename`, `songPath`, `pagePath`, `artistName`, `songTitle`, `biography`, `favourite`, `checkout`, `trending`, `year`, `date`, `time`) VALUES ( 
                  '".$posterid."',
                  '".$poster."',
                  '".$report['image']['name']."',
                  '".$report['image']['rename']."',
                  '".$generalImagePath."',
                  '".$report['song']['name']."',
                  '".$report['song']['rename']."',
                  '".$generalSongPath."',
                  '".$pagePath."',
                  '".$report['artisename']['name']."',
                  '".$report['songtitle']['title']."',
                  '".$report['bio']['bio']."',
                  '".$report['options']['favourite']."',
                  '".$report['options']['checkout']."',
                  '".$report['options']['trending']."',
                  '".$year."',
                  '".$datee."',
                  '".$timee."'
                  )";

                  // Runing/Executing Query to insert/upload the details of the selected image and audio/song in to the database.
                  if (run_query($con, $q)){
                    $report['tempLink'] = $songTo;
                    $report['artisename']['name'] = "";
                    $report['songtitle']['title'] = "";
                    $report['bio']['bio'] = $status !== 'pending' ? $pagePath : "";
                    generateNavPage('../', $con, 'music', 'musicdetails', "../music/");
                    return $report;
                  }else{
                    $report['error'] = "Not Uploaded!";
                    return $report;
                  }
            }

        }else{
          $report['error'] = "Oops...sorry an error have occure on Line ".__LINE__." please contact the Programmer || Admin ";
        }
      }
      
   }
}



?>