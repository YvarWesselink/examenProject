<?php


class Admin extends controller
{

    public static function uploadHomeTXT($titel, $tussenkop, $txthome)
    {
        $pdo = self::connect();

        $st = $pdo->prepare("UPDATE texthome SET titel=:titel, tussenkopje=:tussenkopje, home=:txthome WHERE id = 1");

        $st->bindParam(":titel", $titel,PDO::PARAM_STR);
        $st->bindParam(":tussenkopje", $tussenkop,PDO::PARAM_STR);
        $st->bindParam(":txthome", $txthome,PDO::PARAM_STR);
        $st->execute();

        echo "<script> location.href='txthome'; </script>";
    }

    public static function uploadImage($album) {
        try {
            $pdo = self::connect();

            // get school info
            $st = $pdo->prepare("SELECT school FROM albums WHERE naam = :naam");
            $st->bindParam(":naam", $album);
            $st->execute();
            $school = $st->fetch(PDO::FETCH_ASSOC);

            $name = $_FILES['file']['name'];
            $target_dir = "public/uploads/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");

            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){

                // Convert to base64
                $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
                $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                // Insert record
                $data = [
                    'image' => $image,
                    'album' => $album,
                    'school' => $school['school'],
                ];

                $stmt = $pdo->prepare("insert into images(image, album, school) values(:image, :album, :school)");
                $stmt->execute($data);

                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
            }

            echo "<script> location.href='/foto-uploaden'; </script>";

        } catch (PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public static function downloadAlbums() {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM albums");
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        if (empty($albums)) {
            echo "<option> - Maak eerst een album aan - </option>";
        } else {
            foreach ($albums as $album) {
                print_r("<option value='".$album['naam']."'>".$album['naam']."</option>");
            }
        }
    }

    public static function downloadFotos() {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM albums");
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        if (empty($albums)) {
            echo "<p>Er zijn nog geen albums</p>";
        } else {
            foreach ($albums as $album) {
                try {
                    $naam = $album['naam'];
                    $id = $album['id'];
                    $homepage = $album['homepage'];

                    $st = $pdo->prepare("SELECT * FROM images WHERE album = :album");
                    $st->bindParam(':album', $naam);
                    $st->execute();

                    $foto = $st->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($foto)) {
                        echo "<div class='album'>";
                        echo "<p>$naam</p>";
                        echo "Nog geen foto's in dit album geplaatst";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='album' value='$naam'>";
                        echo "<input class='uploadfotobut' type='submit' name='delete-album' value='Album Verwijderen'>";
                        echo "</form>";
                        echo "</div>";
                    } else {
                        echo "<div class='album'>";
                        echo "<p>$naam</p>";
                        echo "<img style='height: 100px; width: auto' src='".$foto[0]['image']."'>";
                        echo "<form method='post' action='/album-weergeven'>";
                        echo "<input type='hidden' name='album' value='$naam'>";
                        echo "<input class='uploadfotobut' type='submit' name='album-weergeven' value='Album Weergeven'>";
                        echo "</form>";

                        echo "<form method='post'>";
                        echo "<input type='hidden' name='album' value='$naam'>";
                        echo "<input type='submit' class='uploadfotobut' name='delete-album' value='Album Verwijderen'>";
                        echo "</form>";

                        if ($homepage == 1) {
                            // salland
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='naam' value='$naam'>";
                            echo "<input type='hidden' name='album' value='$id'>";
                            echo "<input type='submit' class='uploadfotobut' name='homepage' value='als homepage slide selecteren (Salland)'>";
                            echo "</form>";
                        } elseif ($homepage == 0) {
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='naam' value='$naam'>";
                            echo "<input type='hidden' name='album' value='$id'>";
                            echo "<input type='submit' class='uploadfotobut' name='homepage' value='als homepage slide selecteren (Zwolle)'>";
                            echo "</form>";
                        }

                        echo "</div>";
                    }
                } catch (PDOException $e) {
                    echo '{"error":{"text":'. $e->getMessage() .'}}';
                }
            }
        }
    }

    public static function downloadFotosSchool($school) {
        $pdo = self::connect();

        $school = $school[0];

        $st = $pdo->prepare("SELECT * FROM albums WHERE school = :school");
        $st->bindParam(":school", $school);
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        if (empty($albums)) {
            echo "<p>Er zijn nog geen albums</p>";
        } else {
            foreach ($albums as $album) {
                try {
                    $naam = $album['naam'];
                    $st = $pdo->prepare("SELECT * FROM images WHERE album = :album");
                    $st->bindParam(':album', $naam);
                    $st->execute();

                    $foto = $st->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($foto)) {
                        echo "<div class='album'>";
                        echo "<p>$naam</p>";
                        echo "Nog geen foto's in dit album geplaatst";
                        echo "</div>";
                    } else {
                        echo "<div class='album'>";
                        echo "<img src='".$foto[0]['image']."'>";
                        echo "<form method='post' action='/album-weergeven-school'>";
                        echo "<input type='hidden' name='album' value='$naam'>";
                        echo "<input type='submit' class='uploadfotobut' class='album-but' name='album-weergeven' value='".$naam." Weergeven'>";
                        echo "</form>";
                        echo "</div>";
                    }
                } catch (PDOException $e) {
                    echo '{"error":{"text":'. $e->getMessage() .'}}';
                }
            }
        }
    }

    public static function downloadFotosHome($school) {
        $pdo = self::connect();

        $school = $school[0];

        $st = $pdo->prepare("SELECT * FROM images WHERE school = :school ORDER BY id DESC");
        $st->bindParam(":school", $school);
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        return $albums;
    }

    public static function downloadFotosSlide($school) {
        $pdo = self::connect();

        echo $school;

        if ($school === "salland") {
            $st = $pdo->prepare("SELECT * FROM images WHERE homepage = 0 ");
            $st->execute();
            $slides = $st->fetchAll(PDO::FETCH_ASSOC);

            if ($slides != "") {
                foreach ($slides as $slide) {
                    echo "<div>";
                    echo "<img src='".$slide['image']."'>";
                    echo "</div>";
                }
            }
        } elseif ($school === "zwolle") {
            $st = $pdo->prepare("SELECT * FROM images WHERE homepage = 1 ");
            $st->execute();
            $slides = $st->fetchAll(PDO::FETCH_ASSOC);

            if ($slides != "") {
                foreach ($slides as $slide) {
                    echo "<div>";
                    echo "<img src='".$slide['image']."'>";
                    echo "</div>";
                }
            }
        } elseif ($school === "") {
            $st = $pdo->prepare("SELECT * FROM images WHERE homepage BETWEEN 0 AND 1");
            $st->execute();
            $slides = $st->fetchAll(PDO::FETCH_ASSOC);

            if ($slides != "") {
                foreach ($slides as $slide) {
                    echo "<div>";
                    echo "<img src='".$slide['image']."'>";
                    echo "</div>";
                }
            }
        }
    }

    public static function downloadAlbumImages($album) {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM images where album = :album");
        $st->bindParam(":album", $album);
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        foreach ($albums as $album) {
            $id = $album['id'];
            echo "<div class='image-album'>";
            echo "<img src='".$album['image']."'>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='album' value='$id'>";
            echo "<input type='submit' class='uploadfotobut' value='Verwijder Plaatje' name='delete-image'";
            echo "</form";
            echo "</div>";
        }
    }

    public static function downloadNieuwsHome($school) {
        $pdo = self::connect();

        $school = $school[0];

        $st = $pdo->prepare("SELECT * FROM feedback WHERE school = :school ORDER BY userID DESC");
        $st->bindParam(":school", $school);
        $st->execute();

        $nieuws = $st->fetchAll(PDO::FETCH_ASSOC);

        return $nieuws;
    }

    public static function downloadAlbumImagesSchool($album) {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM images where album = :album");
        $st->bindParam(":album", $album);
        $st->execute();

        $albums = $st->fetchAll(PDO::FETCH_ASSOC);

        foreach ($albums as $album) {
            $id = $album['id'];
            echo "<div class='image-album'>";
            echo "<img src='".$album['image']."'>";
            echo "</div>";
        }
    }

    public static function downloadNieuwsSchool($nieuws) {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM feedback where school = :nieuws");
        $st->bindParam(":school", $nieuws);
        $st->execute();

        $nieuws = $st->fetchAll(PDO::FETCH_ASSOC);

        foreach ($nieuws as $artikel) {
            $id = $artikel['id'];
            echo "<div class='image-album'>";
            echo "<img src='".$artikel['foto']."'>";
            echo "</div>";
        }
    }

    public static function deleteAlbum($naam) {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM images where album = :album");
        $st->bindParam(":album", $naam);
        $st->execute();
        $selected = $st->fetchAll(PDO::FETCH_ASSOC);

        if (empty($selected)) {
            // verwijder album uit database
            $query = $pdo->prepare("SELECT id FROM albums WHERE naam = :naam");
            $query->bindParam(":naam", $naam);
            $query->execute();

            $id = $query->fetchAll(PDO::FETCH_ASSOC);

            $st = $pdo->prepare("DELETE FROM albums WHERE naam = :naam");
            $st->bindParam(":naam", $naam);
            $st->execute();
        } else {
            foreach ($selected as $select) {
                // verwijder image uit database
                $id = $select['id'];
                $st = $pdo->prepare("DELETE FROM images WHERE id = :id");
                $st->bindParam(":id",$id);
                $st->execute();

                // verwijder album uit database
                $query = $pdo->prepare("SELECT id FROM albums WHERE naam = :naam");
                $query->bindParam(":naam", $naam);
                $query->execute();

                $id = $query->fetchAll(PDO::FETCH_ASSOC);

                $st = $pdo->prepare("DELETE FROM albums WHERE naam = :naam");
                $st->bindParam(":naam", $naam);
                $st->execute();
            }
        }

        echo "<script> location.href='/foto-uploaden'; </script>";
    }

    public static function deleteImage($id) {
        $pdo = self::connect();

        $st = $pdo->prepare("DELETE FROM images WHERE id = :id");
        $st->bindParam(":id", $id);
        $st->execute();

        echo "<script> location.href='/foto-uploaden'; </script>";
    }

    public static function uploadAlbum($naam, $school) {
        $pdo = self::connect();

        $naamAlbum = $naam."-".$school;

        $st = $pdo->prepare("INSERT INTO albums(naam, school) values(:naam, :school)");
        $st->bindParam(":naam", $naamAlbum);
        $st->bindParam(":school", $school);
        $st->execute();

        echo "<script> location.href='/foto-uploaden'; </script>";
    }

    public static function homepageImage($id, $naam) {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT id, naam FROM albums WHERE homepage = true ");
        $st->execute();
        $hID = $st->fetch(PDO::FETCH_ASSOC);

        if (!empty($hID['id'])) {
            $st = $pdo->prepare("UPDATE albums SET homepage = false WHERE id = :id");
            $st->bindParam(":id", $hID['id']);
            $st->execute();

            $st = $pdo->prepare("UPDATE albums SET homepage = true WHERE id = :id");
            $st->bindParam(":id", $id);
            $st->execute();

            $sts = $pdo->prepare("UPDATE images SET homepage = false WHERE album = :naam");
            $sts->bindParam(":naam", $hID['naam']);
            $sts->execute();

            $sts = $pdo->prepare("UPDATE images SET homepage = true WHERE album = :naam");
            $sts->bindParam(":naam", $naam);
            $sts->execute();

        } else {
            $st = $pdo->prepare("UPDATE albums SET homepage = true WHERE id = :id");
            $st->bindParam(":id", $id);
            $st->execute();

            $sts = $pdo->prepare("UPDATE images SET homepage = true WHERE album = :naam");
            $sts->bindParam(":naam", $naam);
            $sts->execute();
        }
        /*
        DEZE SHIT TOE VOEGEN AAN DE UPLOAD


        */
        echo "<script> location.href='/foto-uploaden'; </script>";
    }

    public static function downloadTXT() {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM texthome WHERE id = 1");
        $st->execute();

        $home = $st->fetch(PDO::FETCH_ASSOC);

        return $home;
    }

    public static function editUser($username, $voornaam, $achternaam, $email, $straat, $plaats, $postcode, $mobiel, $website, $id)
    {
        $pdo = self::connect();

        $_SESSION['username']=$username;
        $st = $pdo->prepare("update users set username=:username, voornaam=:voornaam, achternaam=:achternaam, email=:email, straat=:straat, plaats=:plaats, postcode=:postcode, mobiel=:mobiel, website=:website where uid=:id");

        $st->bindParam(":username", $username, PDO::PARAM_STR);
        $st->bindParam(":voornaam", $voornaam, PDO::PARAM_STR);
        $st->bindParam(":achternaam", $achternaam, PDO::PARAM_STR);
        $st->bindParam(":email", $email, PDO::PARAM_STR);
        $st->bindParam(":straat", $straat, PDO::PARAM_STR);
        $st->bindParam(":plaats", $plaats, PDO::PARAM_STR);
        $st->bindParam(":postcode", $postcode, PDO::PARAM_STR);
        $st->bindParam(":mobiel", $mobiel, PDO::PARAM_STR);
        $st->bindParam(":website", $website, PDO::PARAM_STR);

        $st->bindParam(":id", $id, PDO::PARAM_STR);
        $st->execute();

        header("Location: /acgegevens");
    }

    public static function downloadUser($id) {
        $pdo=self::connect();

        $st = $pdo->prepare("SELECT username, voornaam, achternaam, email, straat, plaats, postcode, mobiel, website FROM users WHERE uid=:id");
        $st->bindParam(":id", $id, PDO::PARAM_STR);
        $st->execute();

        $user = $st->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public static function logout() {
        session_start();
        unset($_SESSION['uid']);
        unset($_SESSION['username']);
        header('Location: /index.php');
    }

    public static function moveUp($field) {
        $pdo = self::connect();

        // selecteer het id en nummer van het geklikte element
        $st = $pdo->prepare("SELECT id, nummer FROM volgordeopdracht WHERE colomn = :field");
        $st->bindParam(":field", $field);
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);
        $id = $result['id'];

        $nummer = $result['nummer'];

        if ($nummer == 1) {
            echo "<script> location.href='/formulier'; </script>";
        } else {
            $nummer -= 1;

            // selecteer het id van het bovenstaande element
            $st = $pdo->prepare("SELECT id FROM volgordeopdracht WHERE nummer = :nummer");
            $st->bindParam(":nummer", $nummer);
            $st->execute();
            $bov = $st->fetch(PDO::FETCH_ASSOC);

            // 1++ voor het geselecteerde element
            $st = $pdo->prepare("UPDATE volgordeopdracht SET nummer=:nummer where id=:id");
            $st->bindParam(":nummer", $nummer);
            $st->bindParam(":id", $id);
            $st->execute();

            $nummer += 1;
            $id = $bov['id'];

            // 1-- voor het element er boven
            $st = $pdo->prepare("UPDATE volgordeopdracht SET nummer=:nummer WHERE id=:id");
            $st->bindParam(":nummer", $nummer);
            $st->bindParam(":id", $id);
            $st->execute();
        }
    }

    public static function moveUpContact($field) {
        $pdo = self::connect();

        // selecteer het id en nummer van het geklikte element
        $st = $pdo->prepare("SELECT id, nummer FROM volgordecontact WHERE colomn = :field");
        $st->bindParam(":field", $field);
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);
        $id = $result['id'];

        $nummer = $result['nummer'];

        if ($nummer == 1) {
            echo "<script> location.href='/formulier'; </script>";
        } else {
            $nummer -= 1;

            // selecteer het id van het bovenstaande element
            $st = $pdo->prepare("SELECT id FROM volgordecontact WHERE nummer = :nummer");
            $st->bindParam(":nummer", $nummer);
            $st->execute();
            $bov = $st->fetch(PDO::FETCH_ASSOC);

            // 1++ voor het geselecteerde element
            $st = $pdo->prepare("UPDATE volgordecontact SET nummer=:nummer where id=:id");
            $st->bindParam(":nummer", $nummer);
            $st->bindParam(":id", $id);
            $st->execute();

            $nummer += 1;
            $id = $bov['id'];

            // 1-- voor het element er boven
            $st = $pdo->prepare("UPDATE volgordecontact SET nummer=:nummer WHERE id=:id");
            $st->bindParam(":nummer", $nummer);
            $st->bindParam(":id", $id);
            $st->execute();
        }
    }

    public static function moveDownContact($field) {
        $pdo = self::connect();

        $pdo = self::connect();

        // selecteer alle velden om te zien hoe veel er zijn
        $st = $pdo->prepare("SELECT * FROM volgordecontact");
        $st->execute();
        $count = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($count);

        // selecteer het id en nummer van het geklikte element
        $st = $pdo->prepare("SELECT id, nummer FROM volgordecontact WHERE colomn = :field");
        $st->bindParam(":field", $field);
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);
        $id = $result['id'];

        $nummer = $result['nummer'];

        if ($count == $nummer) {
            echo "maximum bereikt";
        } else {
            $nummer += 1;

            // selecteer het id van het onderstaande element
            $st = $pdo->prepare("SELECT id FROM volgordecontact WHERE nummer = :nummer");
            $st->bindParam(":nummer", $nummer);
            $st->execute();
            $bov = $st->fetch(PDO::FETCH_ASSOC);

            // 1++ voor het geselecteerde element
            $st = $pdo->prepare("UPDATE volgordecontact SET nummer=:nummer where id=:id");
            $st->bindParam(":nummer", $nummer);
            $st->bindParam(":id", $id);
            $st->execute();

            $nummer -= 1;
            $id = $bov['id'];

            // 1-- voor het element er boven
            $st = $pdo->prepare("UPDATE volgordecontact SET nummer=:nummer WHERE id=:id");
            $st->bindParam(":nummer", $nummer);
            $st->bindParam(":id", $id);
            $st->execute();
        }
    }

    public static function moveDown($field) {
        $pdo = self::connect();

        // selecteer alle velden om te zien hoe veel er zijn
        $st = $pdo->prepare("SELECT * FROM volgordeopdracht");
        $st->execute();
        $count = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($count);

        // selecteer het id en nummer van het geklikte element
        $st = $pdo->prepare("SELECT id, nummer FROM volgordeopdracht WHERE colomn = :field");
        $st->bindParam(":field", $field);
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);
        $id = $result['id'];

        $nummer = $result['nummer'];

        if ($count == $nummer) {
            echo "maximum bereikt";
        } else {
            $nummer += 1;

            // selecteer het id van het onderstaande element
            $st = $pdo->prepare("SELECT id FROM volgordeopdracht WHERE nummer = :nummer");
            $st->bindParam(":nummer", $nummer);
            $st->execute();
            $bov = $st->fetch(PDO::FETCH_ASSOC);

            // 1-- voor het geselecteerde element
            $st = $pdo->prepare("UPDATE volgordeopdracht SET nummer=:nummer where id=:id");
            $st->bindParam(":nummer", $nummer);
            $st->bindParam(":id", $id);
            $st->execute();

            $nummer -= 1;
            $id = $bov['id'];

            // 1++ voor het element er boven
            $st = $pdo->prepare("UPDATE volgordeopdracht SET nummer=:nummer WHERE id=:id");
            $st->bindParam(":nummer", $nummer);
            $st->bindParam(":id", $id);
            $st->execute();
        }
    }

    public static function uploadElementOp($titel, $inputType, $type) {
        $pdo = self::connect();

        if ($type == "contactbedrijfgegevens") {
            // upload element to volgodeContact table in db
            $st = $pdo->prepare("SELECT * FROM volgordecontact");
            $st->execute();
            $nummer = $st->fetchAll(PDO::FETCH_ASSOC);
            $nummer = count($nummer);
            $nummer+= 1;

            $st = $pdo->prepare("INSERT INTO volgordecontact (colomn, nummer, input) value (:titel, :nummer, :input)");
            $st->bindParam(":titel", $titel);
            $st->bindParam(":nummer", $nummer);
            $st->bindParam(":input", $inputType);
            $st->execute();
        } elseif ($type == "projectenopdrachten") {
            // upload element to volgodeContact table in db
            $st = $pdo->prepare("SELECT * FROM volgordeopdracht");
            $st->execute();
            $nummer = $st->fetchAll(PDO::FETCH_ASSOC);
            $nummer = count($nummer);
            $nummer+= 1;

            $st = $pdo->prepare("INSERT INTO volgordeopdracht (colomn, nummer, input) value (:titel, :nummer, :input)");
            $st->bindParam(":titel", $titel);
            $st->bindParam(":nummer", $nummer);
            $st->bindParam(":input", $inputType);
            $st->execute();
        }

        // check if there are any spaces
        $titel = str_replace(' ', '_', $titel);

        // upload elements voor salland
        $table = $type."s";

        switch ($inputType) {
            case "date":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel date");
                break;
            case "time":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel time");
                break;
            case "txt":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel varchar(255)");
                break;
            case "valuta":
            case "int":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel int(255)");
                break;
        }

        $st->execute();

        // upload elements voor zwolle
        $table = $type."z";

        switch ($inputType) {
            case "date":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel date");
                break;
            case "time":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel time");
                break;
            case "txt":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel varchar(255)");
                break;
            case "valuta":
            case "int":
                $st = $pdo->prepare("ALTER TABLE $table ADD $titel int(255)");
                break;
        }

        $st->execute();

        echo "<script> location.href='formulier'; </script>";
    }

    // get elements from opdrachten
    public static function getElementsForm() {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM volgordeopdracht ORDER BY nummer");
        $st->execute();
        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $i = 0;
        while ($count > $i) {
            $table = str_replace('_', ' ',$tables[$i]['colomn']);
            echo "<div class='add-form-3'>".$table." <button class='up' id='$table'>🠕</button><button class='down' id='$table'>🠗</button><button type='button' id='$table' class='deleteRow'>-</button></div>"."<br>";
            $i ++;
        }
    }

    // get elements from contact bedrijfgegevens
    public static function getElementsFormCont() {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM volgordecontact ORDER BY nummer");
        $st->execute();
        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $i = 0;
        while ($count > $i) {
            $table = str_replace('_', ' ',$tables[$i]['colomn']);
            echo "<div class='add-form-3'>".$table."<button class='upCon' id='$table'>🠕</button><button class='downCon' id='$table'>🠗</button><button type='button' id='$table' class='deleteRowC'>-</button></div>"."<br>";
            $i ++;
        }
    }

    // get elements from verborgenwaarden
    public static function getElementsFormVerb() {
        $pdo = self::connect();
        $st = $pdo->prepare("SHOW COLUMNS FROM verborgenwaardens");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $i = 1;
        while ($count > $i) {
            $table = str_replace('_', ' ',$tables[$i]['Field']);
            echo "<div class='add-form-3'>".$table."<button class='deleteRowV'>-</button></div>"."<br>";
            $i ++;
        }
    }

    // delete elements start
    public static function deleteElementOp($column) {
        $pdo = self::connect();
        $column = str_replace(' ', '_',$column);
        $st = $pdo->prepare("ALTER TABLE projectenopdrachtens DROP COLUMN $column");
        $st->execute();

        $st = $pdo->prepare("ALTER TABLE projectenopdrachtenz DROP COLUMN $column");
        $st->execute();

        // verwijder element in volgordeopdracht
        $st = $pdo->prepare("SELECT * FROM volgordeopdracht WHERE colomn = :column");
        $st->bindParam(":column", $column);
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);

        // verwijder het element waar op is geklikt
        $id = $result['id'];
        $st = $pdo->prepare("DELETE FROM volgordeopdracht WHERE id = $id");
        $st->execute();

        // pas de volgorde aan van de onderstaande elementen
        $st = $pdo->prepare("SELECT * FROM volgordeopdracht");
        $st->execute();
        // tel hoe veel elementen er in de db zitten
        $count = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($count);
        $count += 1;
        // het index nummer van het verwijderde element
        $nummer = $result['nummer'];
        $nummer += 1;

        // tel een waarde op bij het index nummer van het verwijderde element tot dat het aantal is bereikt
        while ($nummer <= $count) {
            $st = $pdo->prepare("SELECT id FROM volgordeopdracht WHERE nummer=:nummer");
            $st->bindParam(":nummer", $nummer);
            $st->execute();
            $id = $st->fetch(PDO::FETCH_ASSOC);
            $id = $id['id'];

            $nummerGoed = $nummer - 1;

            $st = $pdo->prepare("UPDATE volgordeopdracht SET nummer=$nummerGoed WHERE id=$id");
            $st->execute();
            $nummer ++;
        }
    }

    public static function deleteElementCo($column) {
        $pdo = self::connect();
        $column = str_replace(' ', '_',$column);
        $st = $pdo->prepare("ALTER TABLE contactbedrijfgegevenss DROP COLUMN $column");
        $st->execute();

        $st = $pdo->prepare("ALTER TABLE contactbedrijfgegevensz DROP COLUMN $column");
        $st->execute();

        // verwijder element in volgordecontact
        $st = $pdo->prepare("SELECT * FROM volgordecontact WHERE colomn = :column");
        $st->bindParam(":column", $column);
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);

        // verwijder het element waar op is geklikt
        $id = $result['id'];
        $st = $pdo->prepare("DELETE FROM volgordecontact WHERE id = $id");
        $st->execute();

        // pas de volgorde aan van de onderstaande elementen
        $st = $pdo->prepare("SELECT * FROM volgordecontact");
        $st->execute();
        // tel hoe veel elementen er in de db zitten
        $count = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($count);
        $count += 1;
        // het index nummer van het verwijderde element
        $nummer = $result['nummer'];
        $nummer += 1;

        // tel een waarde op bij het index nummer van het verwijderde element tot dat het aantal is bereikt
        while ($nummer <= $count) {
            $st = $pdo->prepare("SELECT id FROM volgordecontact WHERE nummer=:nummer");
            $st->bindParam(":nummer", $nummer);
            $st->execute();
            $id = $st->fetch(PDO::FETCH_ASSOC);
            $id = $id['id'];

            $nummerGoed = $nummer - 1;

            $st = $pdo->prepare("UPDATE volgordecontact SET nummer=$nummerGoed WHERE id=$id");
            $st->execute();
            $nummer ++;
        }
    }

    public static function deleteElementVe($column) {
        $pdo = self::connect();
        $column = str_replace(' ', '_',$column);
        $st = $pdo->prepare("ALTER TABLE verborgenwaardens DROP COLUMN $column");
        $st->execute();

        $st = $pdo->prepare("ALTER TABLE verborgenwaardenz DROP COLUMN $column");
        $st->execute();
    }

    // delete elements end
    // Delete function for the salland excersise
    public static function deleteElementExc($id) {
        $pdo = self::connect();
        //  Delete the excersise 
        $st = $pdo->prepare("DELETE FROM projectenopdrachtens WHERE id = $id");
        $st->execute();        
        //  Delete the contact from the excersise 
        $st = $pdo->prepare("DELETE FROM contactbedrijfgegevenss WHERE id = $id");
        $st->execute();        
        //  Delete the hidden fields from the excersise 
        $st = $pdo->prepare("DELETE FROM verborgenwaardens WHERE id = $id");
        $st->execute();
    }

    // Delete function for the zwolle excersise
    public static function deleteElementExcZ($id) {
        $pdo = self::connect();
        // Delete the excersise
        $st = $pdo->prepare("DELETE FROM projectenopdrachtenz WHERE id = $id");
        // $st->execute();    
        //  Delete the contact from the excersise 
        $st = $pdo->prepare("DELETE FROM contactbedrijfgegevensz WHERE id = $id");
        // $st->execute();        
        //  Delete the hidden fields from the excersise 
        $st = $pdo->prepare("DELETE FROM verborgenwaardenz WHERE id = $id");
        $st->execute();
    }

    public static function deleteElementUser($id) {
        $pdo = self::connect();
        $st = $pdo->prepare("DELETE FROM users WHERE uid = $id");
        $st->execute();
    }

    public static function deleteElementNews($id) {
        $pdo = self::connect();
        $st = $pdo->prepare("DELETE FROM feedback WHERE userID = $id");
        $st->execute();
    }    
    
    public static function deleteElementOldExc($id) {
        $pdo = self::connect();
        $st = $pdo->prepare("DELETE FROM oudeopdrachten WHERE project_id = $id");
        $st->execute();
    }


    public static function downloadEditUserLV(){    
        $pdo = self::connect();
        $st =  $pdo->prepare("SELECT * FROM users");
        $st->execute();

        $user=  $st->fetchAll(PDO::FETCH_ASSOC);


    return $user;
    }

    public static function editUserLV($uid, $user_lv){
        $pdo = self::connect();
        $st = $pdo->prepare("UPDATE users SET user_lv=:userlv WHERE uid=:id");
        $st->bindParam(":id", $uid, PDO::PARAM_STR);
        $st->bindParam(":userlv", $user_lv, PDO::PARAM_STR);
        $st->execute();
//        header("Location: /adminpanel");
        echo "<script> location.href='/userlevel'; </script>";
        }

        public static function contactTXT() {
            $pdo = self::connect();
    
            $st = $pdo->prepare("SELECT * FROM contact WHERE id = 1");
            $st->execute();
    
            $contact = $st->fetch(PDO::FETCH_ASSOC);
    
            return $contact;
        }
    
        public static function uploadcontactTXT($straat, $penp, $email, $telnmr)
        {
            $pdo = self::connect();
            
            $st = $pdo->prepare("UPDATE contact SET straat=:straat, penp=:penp, email=:email , telnmr=:telnmr WHERE id = 1");
    
            $st->bindParam(":straat", $straat,PDO::PARAM_STR);
            $st->bindParam(":penp", $penp,PDO::PARAM_STR);
            $st->bindParam(":email", $email,PDO::PARAM_STR);
            $st->bindParam(":telnmr", $telnmr,PDO::PARAM_STR);
            $st->execute();
    
            header("Location: /txtcontact");
        }
        
        public static function zwolleTXT() {
            $pdo = self::connect();
    
            $st = $pdo->prepare("SELECT * FROM zwolletxt WHERE id = 1");
            $st->execute();
    
            $zwolle = $st->fetch(PDO::FETCH_ASSOC);
    
            return $zwolle;
        }
    
        public static function uploadzwolleTXT($titelz, $tussenz, $zwolletxt)
        {
            $pdo = self::connect();
            
            $st = $pdo->prepare("UPDATE zwolletxt SET titelz=:titelz, tussenz=:tussenz, zwolletxt=:zwolletxt WHERE id = 1");
    
            $st->bindParam(":titelz", $titelz,PDO::PARAM_STR);
            $st->bindParam(":tussenz", $tussenz,PDO::PARAM_STR);
            $st->bindParam(":zwolletxt", $zwolletxt,PDO::PARAM_STR);
            $st->execute();
    
            echo "<script> location.href='txthome'; </script>";
        }

        public static function sallandTXT() {
            $pdo = self::connect();
    
            $st = $pdo->prepare("SELECT * FROM sallandtxt WHERE id = 1");
            $st->execute();
    
            $salland = $st->fetch(PDO::FETCH_ASSOC);
    
            return $salland;
        }
    
        public static function uploadsallandTXT($titels, $tussens, $sallandtxt)
        {
            $pdo = self::connect();
            
            $st = $pdo->prepare("UPDATE sallandtxt SET titels=:titels, tussens=:tussens, sallandtxt=:sallandtxt WHERE id = 1");
    
            $st->bindParam(":titels", $titels,PDO::PARAM_STR);
            $st->bindParam(":tussens", $tussens,PDO::PARAM_STR);
            $st->bindParam(":sallandtxt", $sallandtxt,PDO::PARAM_STR);
            $st->execute();
    
            echo "<script> location.href='txthome'; </script>";
        }



}