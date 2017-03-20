<?php
    include 'connection.php';

   $sql = "SELECT * FROM healer WHERE STATUS = 'ACTIVE' ORDER BY RATE DESC LIMIT 5";

    $retrieve = $conn->query($sql)->fetchAll();
    $json = array();
    $slots = 5;

    if($retrieve) {
        foreach($retrieve as $row) {
            $lastname = $row['LASTNAME'];
            $firstname = $row['FIRSTNAME'];
            $json['healer'][] = array("LASTNAME"=>$lastname, "FIRSTNAME"=>$firstname);

            $slots--;
        }
        if($slots!=0) {
            while($slots!=0) {
                $slots--;
            }
        }
    }


    echo json_encode($json);
    exit(0);
?>
