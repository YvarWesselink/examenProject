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
}