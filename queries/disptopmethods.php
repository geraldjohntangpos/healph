<?php
    include 'connection.php';

    $sql = "SELECT * FROM service WHERE STATUS = 'ACTIVE' ORDER BY RATE DESC LIMIT 5";

    $retrieve = $conn->query($sql)->fetchAll();
    $slots = 5;

    if($retrieve) {
        foreach($retrieve as $row) {
            $name = $row['NAME'];
            $methodid = $row['SERVICE_ID'];
            echo "<li><a href='method.php?methodid=" .$methodid. "&ref=promotion'>" .$name. "</a></li>";
            $slots--;
        }
        if($slots!=0) {
            while($slots!=0) {
                echo "<li style='color: red'></li>";
                $slots--;
            }
        }
    }
    else {
?>
        <li>No available healing methods yet.</li>
<?php
    }
?>
