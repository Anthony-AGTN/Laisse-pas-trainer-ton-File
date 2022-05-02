<?php
// Je vérifie si le formulaire est soumis comme d'habitude
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Securité en php
    // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
    $uploadDir = 'public/uploads/';
    // le nom de fichier sur le serveur est ici généré à partir du nom de fichier sur le poste du client (mais d'autre stratégies de nommage sont possibles)
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    // Je récupère l'extension du fichier
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    // Les extensions autorisées (jpg, png, gif, webp)
    $authorizedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    // Le poids max géré par PHP par défaut est de 2M, dans notre cas, nous sommes à 1M
    $maxFileSize = 1000000;

    // Je sécurise et effectue mes tests

    /****** Si l'extension est autorisée *************/
    if ((!in_array($extension, $authorizedExtensions))) {
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
    }

    /****** On vérifie si l'image existe et si le poids est autorisé en octets *************/
    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    /****** Si je n'ai pas d"erreur alors j'upload *************/

    // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur. Ça y est, le fichier est uploadé
    move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Driver document</title>
</head>

<body>

    <!-- Le formulaire -->
    <div class="form">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-input">
                <label for="firstName">First Name : </label>
                <input type="text" name="firstName" id="firstName" required>
            </div>
            <div class="form-input">
                <label for="lastName">Last Name : </label>
                <input type="text" name="lastName" id="lastName" required>
            </div>
            <div class="form-input">
                <label for="age">Enter your age: </label>
                <input type="number" name="age" id="age" required>
            </div>
            <div class="form-input">
                <label for="imageUpload">Upload an profile image</label>
                <input type="file" name="avatar" id="imageUpload" />
                <button name="send">Send</button>
            </div>
        </form>
    </div>

    <?php echo var_dump($_POST); ?>

    <!-- Drivers License -->

    <div class="driver-card">
        <div>
            <h1>SPRINGFIELD, IL</h1>
        </div>
        <div class="first-information">
            <ul>
                <li>
                    <p>LICENSE#</p>
                    <p>64209</p>
                </li>
                <li>
                    <p>BIRTH DATE</p>
                    <p>4-24-56</p>
                </li>
                <li>
                    <p>EXPIRES</p>
                    <p>4-24-2015</p>
                </li>
                <li>
                    <p>CLASS</p>
                    <p>NONE</p>
                </li>
            </ul>
        </div>
        <div class="general-information">
            <img src="public/uploads/photo13.jpg" alt="photo de profil">
            <div class="infomation-right">
                <div class="address">
                    <h2>DRIVERS LICENSE</h2>
                    <p><?= $_POST['firstName'] ?> <?= $_POST['lastName'] ?></p>
                    <p><?= $_POST['age'] ?> OLD PLUMTREE BLVD</p>
                    <p>SPRINGFIELD, IL 62701</p>
                </div>
                <div class="second-information">
                    <ul>
                        <li>
                            <p>SEX</p>
                            <p>OK</p>
                        </li>
                        <li>
                            <p>HEIGHT</p>
                            <p>MEDIUM</p>
                        </li>
                        <li>
                            <p>WEIGHT</p>
                            <p>239</p>
                        </li>
                        <li>
                            <p>HAIR</p>
                            <p>NONE</p>
                        </li>
                        <li>
                            <p>EYES</p>
                            <p>OVAL</p>
                        </li>
                    </ul>
                </div>
                <p class="sign">HOMER SIMPSON</p>
            </div>
        </div>
    </div>

</body>

</html>