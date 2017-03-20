<?php
   include 'connection.php';
   $clientid = $_SESSION['USERID'];
   $sql = "SELECT R.CLIENT_ID, R.HEALER_ID, R.PRODUCT_ID, R.PROD_QTY, R.PRICE, R.STATUS, H.LASTNAME, H.FIRSTNAME, H.ACCT_ID, P.PRODUCT_ID, P.NAME FROM reservation AS R INNER JOIN healer AS H ON R.HEALER_ID = H.ACCT_ID INNER JOIN product AS P ON R.PRODUCT_ID = P.PRODUCT_ID WHERE R.STATUS = 'ACTIVE' AND R.CLIENT_ID = '$clientid'";
   $retrieve = $conn->query($sql)->fetchAll();
?>
<br />
<table border="1" column="6" width="100%">
   <thead>
      <tr>
         <th colspan="6" style="text-align: center;">My reservation list</th>
      </tr>
      <tr>
         <th style="text-align: center;">Name</th>
         <th style="text-align: center;">Owner</th>
         <th style="text-align: center;">Qty</th>
         <th style="text-align: center;">Price</th>
         <th style="text-align: center;">Status</th>
         <th style="text-align: center;">Action</th>
      </tr>
   </thead>
   <tbody>
      <?php
         if($retrieve) {
            foreach($retrieve as $row) {
               $id = $row['PRODUCT_ID'];
               $prodname = $row['NAME'];
               $ownername = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
               $qty = $row['PROD_QTY'];
               $price = $row['PRICE'];
               $status = $row['STATUS'];
      ?>
            <tr>
               <td><?php echo $prodname; ?></td>
               <td><?php echo $ownername; ?></td>
               <td><?php echo $qty; ?></td>
               <td><?php echo $price; ?></td>
               <td><?php echo $status; ?></td>
               <td><a href="queries/cancelreservation.php?id=<?php echo $id ?>&ref=promotion" style="color: red;">Cancel</a></td>
            </tr>
      <?php
            }
         }
         else {
      ?>
            <tr>
               <td>No Entry</td>
               <td>No Entry</td>
               <td>No Entry</td>
               <td>No Entry</td>
               <td>No Entry</td>
               <td>No Entry</td>
            </tr>
      <?php
         }
      ?>
   </tbody>
</table>
<?php
   $sql = "SELECT * FROM notification WHERE NOTIFIER = '$clientid' AND SEEN = 'UNSEEN'";
   $retrieve = $conn->query($sql)->fetchAll();
   $resArray = [];
   if($retrieve) {
      foreach($retrieve as $row) {
         $notifid = $row['NOTIF_ID'];
         $type = $row['TYPE'];
         $status = $row['STATUS'];
         $seen = $row['SEEN'];
         $typeid = $row['TYPE_ID'];
         switch($type) {
            case 'appointment':
               $sql2 = "SELECT A.HEALER_ID, A.APPOINTEDTIME, A.APPOINTEDDATE, A.APPOINTMENT_ID, H.ACCT_ID, H.LASTNAME, H.FIRSTNAME FROM appointment AS A INNER JOIN healer AS H ON A.HEALER_ID = H.ACCT_ID WHERE A.APPOINTMENT_ID = '$typeid'";
               $retrieve2 = $conn->query($sql2)->fetchAll();
               if($retrieve2) {
                  foreach($retrieve2 as $row) {
                     $name = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
                     $date = $row['APPOINTEDDATE']. " (" .$row['APPOINTEDTIME']. ")";
                     $resArray[] = array("id"=>$notifid, "type"=>$type, "withto"=>$name, "date"=>$date, "status"=>$status);
                  }
               }
               break;
            case 'booking':
               $sql2 = "SELECT B.BOOKING_ID, B.SERVICE_ID, B.BOOKINGTIME, B.BOOKINGDATE, B.BOOKING_ID, S.SERVICE_ID, S.NAME FROM booking AS B INNER JOIN service AS S ON B.SERVICE_ID = S.SERVICE_ID WHERE B.BOOKING_ID = '$typeid'";
               $retrieve2 = $conn->query($sql2)->fetchAll();
               if($retrieve2) {
                  foreach($retrieve2 as $row) {
                     $name = $row['NAME'];
                     $date = $row['BOOKINGDATE']. " (" .$row['BOOKINGTIME']. ")";
                     $resArray[] = array("id"=>$notifid, "type"=>$type, "withto"=>$name, "date"=>$date, "status"=>$status);
                  }
               }
               break;
            case 'reservation':
               $sql2 = "SELECT R.RESERVE_ID, R.PRODUCT_ID, R.DATEADDED, P.PRODUCT_ID, P.NAME FROM reservation AS R INNER JOIN product AS P ON R.PRODUCT_ID = P.PRODUCT_ID WHERE R.RESERVE_ID = '$typeid'";
               $retrieve2 = $conn->query($sql2)->fetchAll();
               if($retrieve2) {
                  foreach($retrieve2 as $row) {
                     $name = $row['NAME'];
                     $date = $row['DATEADDED'];
                     $resArray[] = array("id"=>$notifid, "type"=>$type, "withto"=>$name, "date"=>$date, "status"=>$status);
                  }
               }
               break;
         }
      }
   }
?>
<br />
<table border="1" column="5" width="100%">
   <thead>
      <tr>
         <th colspan="5" style="text-align: center;">My notification list</th>
      </tr>
      <tr>
         <th style="text-align: center;">Type</th>
         <th style="text-align: center;">With/To</th>
         <th style="text-align: center;">Date</th>
         <th style="text-align: center;">Status</th>
         <th style="text-align: center;">Action</th>
      </tr>
   </thead>
   <tbody>
      <?php
         if($resArray != null) {
            foreach($resArray as $row) {
               $id = $row['id'];
               $type = $row['type'];
               $withto = $row['withto'];
               $date = $row['date'];
               $status = $row['status'];
      ?>
         <tr>
            <td><?php echo $type; ?></td>
            <td><?php echo $withto; ?></td>
            <td><?php echo $date; ?></td>
            <td><?php echo $status; ?></td>
            <td><a href="queries/seen.php?id=<?php echo $id; ?>" style="color: green;">Mark Seen</a></td>
         </tr>
      <?php
            }
         }
         else {
      ?>
         <tr>
            <td>No Notification</td>
            <td>No Notification</td>
            <td>No Notification</td>
            <td>No Notification</td>
            <td>No Notification</td>
         </tr>
      <?php
         }
      ?>
   </tbody>
</table>
<br /><br /><br />
