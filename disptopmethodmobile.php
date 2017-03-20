<?php
    include 'connection.php';

    $sql = "SELECT * FROM service WHERE STATUS = 'ACTIVE' ORDER BY RATE DESC LIMIT 5";

    $retrieve = $conn->query($sql)->fetchAll();
    $slots = 5;

    if($retrieve) {
        foreach($retrieve as $row) {
            $name = $row['NAME'];
            $json['service'][] = $row;

            $slots--;
        }
        if($slots!=0) {
            while($slots!=0) {
                $slots--;
            }
        }
    }
    else {

    echo json_encode($json);
    exit(0);

?>
