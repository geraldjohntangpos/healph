<?php
   session_start();
   include 'connection.php';
   $accountid = $_SESSION['USERID'];
   
   if(isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "UPDATE notification SET SEEN = 'SEEN' WHERE NOTIF_ID = '$id'";
      $update = $conn->query($sql);
      if($update) {
         header('Location: ../profile.php?accountid=' .$accountid);
      }
      else {
         header('Location: ../promotion.php');
      }
   }
   else {
      header('Location: ../promotion.php');
   }
?>
