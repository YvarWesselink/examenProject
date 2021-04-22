<?php

class nieuws extends controller {
    public static function UploadNews($name, $email, $company, $comments, $foto, $school) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conn = database::connect();

            $stmt = $conn->prepare("INSERT INTO feedback (Name,Email,Company,Comments,foto,school) VALUES (:name, :email, :company, :comments, :foto, :school)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':comments', $comments);
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':school', $school);

            $stmt->execute();

            // echo"<div style='color:navy;'><h2>We hebben het volgende bericht van u ontvangen::</h2>";
            // echo"Uw naam: ".$name;
            // echo"<br>";
            // echo"Uw email adres: ".$email;
            // echo"<br>";
            // echo"Uw bedrijf: ".$company;
            // echo"<br>";
            // echo"Uw bericht: ".$comments;
            // echo"<br>";
            // echo"Uw school: ".$school;
            // echo"<br>";
            // echo"<h2>We zullen er zo snel mogelijk naar kijken!</h2></div>";

        }
    }
}