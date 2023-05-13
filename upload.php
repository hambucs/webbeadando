<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizzük, hogy a kép meg lett-e adva
    if(isset($_FILES["image"]) && !empty($_FILES["image"]["name"])){
       $target_dir = "images/"; // A feltöltött fájl elérési útvonala
        $image_name = $_POST['image-name']; // A kép neve, ami alapján mentjük el
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION)); // A feltöltött fájl típusa
         $target_file = $target_dir . $image_name . '.' . $imageFileType; // A feltöltött fájl teljes elérési útvonala

        // Ellenőrizzük, hogy a fájl valóban kép-e
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            // Ellenőrizzük, hogy a fájl mérete nem nagyobb-e, mint 5 MB
            if ($_FILES["image"]["size"] > 5000000) {
                echo "A képfájl mérete túl nagy!";
            } else {
                // Ellenőrizzük, hogy a fájl típusa megfelelő-e
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                    // A fájl feltöltése
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        echo "A fájl sikeresen feltöltve: ". basename( $_FILES["image"]["name"]);
                    } else {
                        echo "Hiba történt a fájl feltöltése közben!";
                    }
                } else {
                    echo "Csak JPG, JPEG, PNG fájlok tölthetők fel!";
                }
            }
        } else {
            echo "A fájl nem képfájl!";
        }
    } else {
        echo "Nem adtál meg fájlt a feltöltéshez!";
    }
}
header("Location: Galeria.php");
exit();
?>