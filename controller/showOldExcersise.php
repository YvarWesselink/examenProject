<?php
class showOldExcersise extends Database {

    // deze functie laad de view van de pagina die in de url staat.
    // $viewName is dus de variabel die uit de url wordt gehaald.
    public static function CreateView($viewName)
    {
        require_once("./view/$viewName.php");
    }

    public static function showFields($errormsg) {
        $pdo = self::connect();
        $st = $pdo->prepare("SHOW COLUMNS FROM oudeopdrachten");
        $st->execute();
        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);
        $i = 1;

        $id = $_SESSION['id'];
        $stmt = $pdo->prepare("SELECT * FROM oudeopdrachten WHERE project_id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $variableCount = count($values);
        $index = 0;
        while ($count > $i) {
            switch ($tables[$i]['Type']) {
                case "varchar(255)":
                    $type = "text";
                    break;
                case "date":
                    $type = "date";
                    break;
                case "time":
                    $type = "time";
                    break;
                case "int(255)":
                    $type = "number";
                    break;
            }

            if (empty($errormsg)) {
                $error = "";
            } else {
                $error = $errormsg[$tables[$i]['Field']];
            }
            if (isset($_POST['uploadExcersise'])) {
                $value = $_POST;
                $key = $tables[$i]['Field'];
                $backLog = $value[$key];
            } else {
                while($variableCount > $index){
                    $value = $values;
                    $variables = array_values($value[$index]);
                    $index ++;
                }
            }
            $ind = 0;
            echo "<label ><b style='color: #ED135D;'>".$tables[$i]['Field']."</b></label>"."<br>"."<div>$variables[$i]</div><br>";
            $i ++;
            $index ++;
            $ind++;
        }
    }
}