<?php
class excersises extends Database {

    // deze functie laad de view van de pagina die in de url staat.
    // $viewName is dus de variabel die uit de url wordt gehaald.
    public static function CreateView($viewName)
    {
        require_once("./view/$viewName.php");
    }    
}

?>