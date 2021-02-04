<?php

class aboutus extends controller {
    // Schrijf hier je functies

    public static function test() {
        $test = self::query("SELECT * FROM users");
        $_SESSION['user'] = $test;
        // voorbeeld
        // bij elke refresh komt er een nieuwe user in de database met de username tester.

//        self::query("INSERT INTO users(id, username, email, password) VALUES ('','tester','test@gmail.com','12345') ");
    }
    public static function downloadnieuws() {
        $conn = self::connect();
        $sql = "SELECT * FROM feedback";
        $prepare=$conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        

        if (count($result) > 0) {
        $i=0;
            while(count($result) > $i) {
            echo '<div class="nieuws"><td><br>' . $result[$i]["userID"]. "</td><td><br>" . $result[$i]["Name"] . "</td><td><br>"
            . $result[$i]["Email"]. "</td><td><br>" . $result[$i]["Comments"]. "</td><br><td><br>" . $result[$i]["foto"]. "</td><br><td><br>" . $result[$i]["school"]. "</td><br><br></div>";
            $i++;
            }

                 }
                    }
                }