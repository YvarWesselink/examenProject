<?php

class aboutus extends controller {
    // Schrijf hier je functies

    $sql = "SELECT userID, Name, Email, Comments FROM feedback";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo '<div class="nieuws"><td><br>' . $row["userID"]. "</td><td><br>" . $row["Name"] . "</td><td><br>"
    . $row["Email"]. "</td><td><br>" . $row["Comments"]. "</td><br><br></div>";
    }
    echo "</table>";
    } else { echo "0 results"; }
    $conn->close();

}
