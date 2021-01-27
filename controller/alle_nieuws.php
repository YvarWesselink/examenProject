<?php

class aboutus extends controller {
    // Schrijf hier je functies

    $sql = "SELECT * FROM feedback";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo '<div class="nieuws"><td><br>' . $row["userID"]. "</td><td><br>" . $row["Name"] . "</td><td><br>"
    . $row["Email"]. "</td><td><br>" . $row["Comments"]. "</td><td><br>" . $row["foto"]. "</td><td><br>" . $row["school"]. "</td><br><br></div>";
    }
    echo "</table>";
    } else { echo "0 results"; }
    $conn->close();

}
