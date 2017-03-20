<?php
	session_start();
	include 'connection.php';

	$accountid = $_SESSION['USERID'];
	
      $sqlgethealer = "SELECT * FROM healer WHERE ACCT_ID = '$accountid'";
      $retrievehealer = $conn->query($sqlgethealer)->fetchAll();
      if($retrievehealer) {
         foreach($retrievehealer as $r) {
            $subexpiry = $r['SUBEXPIRY'];
            if($subexpiry == "") {
               $expmonth = date("m");
               $expday = date('d');
               $expyear = date('Y');
               $monthdays = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
               $expday = date('d') + 30;
               if($expyear%4==0) {
                  $monthdays[1] = 29;
               }
               while($expday>$monthdays[$expmonth-1]) {
                  $expday = $expday-$monthdays[$expmonth-1];
                  $expmonth++;
                  if($expmonth>12) {
                     $expyear++;
                     $expmonth=1;
                  }
               }
               if(strlen($expday) < 2) {
                  $expday = "0" .$expday;
               }
               if(strlen($expmonth) < 2) {
                  $expmonth = "0" .$expmonth;
               }
            $newexpiry = $expyear."-".$expmonth."-".$expday;
            }
            else {
               $newexpiry = $subexpiry;
            }
            }
         }
			else {
				die("Error!");
			}

	if(!isset($_FILES['picture'])) {
		$scheddays = "";
		$schedhours = "";
		$limit = $_POST['limit'];
		if(!empty($_POST['days'])) {
			$countdays = count($_POST['days']);
			$from = $_POST['from'];
			$to = $_POST['to'];
			if($countdays==7) {
				$scheddays = $scheddays. "Everyday";
			}
			else {
				$counter = 0;
				foreach($_POST['days'] as $key) {
					$scheddays = $scheddays. $key;
					$counter++;
					if($counter != $countdays) {
						$scheddays = $scheddays. ", ";
					}
				}
			}
			$schedhours = $schedhours. "" .$from. " - " .$to. "";
		}
		else {
			$scheddays = "Everyday";
			$schedhours = "24/7";
		}
      
      
		


		$sql = "UPDATE healer SET CLINICDAYS = '$scheddays', CLINICHOURS = '$schedhours', DAILYLIMIT = '$limit', SUBEXPIRY = '$newexpiry', STATUS = 'ACTIVE' WHERE ACCT_ID = '$accountid'";
	}
	else {
		$scheddays = "";
		$schedhours = "";
		$countdays;
		$limit = $_POST['limit'];
		$picture = $_FILES['picture'];
		if(!empty($_POST['days'])) {
			$countdays = count($_POST['days']);
			$from = $_POST['from'];
			$to = $_POST['to'];
			if($countdays==7) {
				$scheddays = $scheddays. "Everyday";
			}
			else {
				$counter = 0;
				foreach($_POST['days'] as $key) {
					$scheddays = $scheddays. $key;
					$counter++;
					if($counter != $countdays) {
						$scheddays = $scheddays. ", ";
					}
				}
			}
			$schedhours = $schedhours. "" .$from. " - " .$to. "";
		}
		else {
			$scheddays = "Everyday";
			$schedhours = "24/7";
		}

		$target_dir = "../images/healer/";
		if(!is_dir($target_dir)) {
			mkdir($target_dir);
		}
		$target_file = $target_dir . basename($picture["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$imageNewName;

		 if (move_uploaded_file($picture["tmp_name"], $target_file)) {
			 $imageNewName = rename($target_file, $target_dir. "healer_" .$accountid. "." .$imageFileType);
		 } else {
			 die("Error uploading file.");
		 }

		$filename = "healer_" .$accountid. "." .$imageFileType;

		$sql = "UPDATE healer SET CLINICDAYS = '$scheddays', CLINICHOURS = '$schedhours', PICTURE = '$filename', SUBEXPIRY = '$newexpiry', STATUS = 'ACTIVE', DAILYLIMIT = '$limit' WHERE ACCT_ID = '$accountid'";
	}

	$update = $conn->query($sql);

	if($update) {
		$_SESSION['STATUS'] = 'ACTIVE';
		header('Location: ../healerPages/profile.php?accountid=' .$accountid);
	}
	else {
		die("Error adding to database.");
	}
?>
