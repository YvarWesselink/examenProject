<?php
class excersises extends Database {

    // deze functie laad de view van de pagina die in de url staat.
    // $viewName is dus de variabel die uit de url wordt gehaald.
    public static function CreateView($viewName)
    {
        require_once("./view/$viewName.php");
        $sql = `INSERT INTO projecten/opdrachten (Opdracht, Aantal studenten, Opmerkingen, Uitvoerings dag en datum, Locatie adres en plaats van uitvoering, Deadline, Budget, Taken voor studenten, Tijd)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`;
        $stmt = mysqli_prepare($sql);
        $stmt->bind_param("sssssssss", $_POST['Opdracht'], $_POST['Aantal studenten'], $_POST['Opmerkingen'], $_POST['Uitvoerings dag en datum'], $_POST['Locaite adres en plaats van uitvoering'], $_POST['Deadline'], $_POST['Budget'], $_POST['Taken voor studenten'], $_POST['Tijd']);
        $stmt->execute();
    }
}