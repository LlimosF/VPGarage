<?php

require_once("Composants/Header.php");

require_once("Composants/BackgroundFixed.php");

if (!empty($_POST)) {
    if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

        // We check that the email field is indeed an email

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("Ce n'est pas une adresse e-mail valide");
        }

        require_once("Composants/Database.php");

        $sql = "SELECT * FROM users WHERE email = :email";
        $query = $db->prepare($sql);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        if (!$user) {
            echo "Erreur lors de la connexion";
        } else {
            if(!password_verify($_POST["password"], $user["password"])) {
                echo "Le mot de passe et / ou l'adresse e-mail est incorrect";
            } else {
        
                session_start();

                $_SESSION["user"] = [
                    "id" => $user["id"],
                    "nom" => $user["nom"],
                    "email" => $user["email"],
                    "role" => $user["role"]
                ];

                header("Location: Modification.php");
                exit();
            }
        }
    }
}    



?>

<form method="POST" class="form connexion-form">
    <h3 class="title-form">Connexion</h3>
    <div class="bloc-form">
        <label for="email">E-mail <span>*</span></label>
    </div>
    <div class="bloc-form">
        <input type="email" name="email" id="email" required>
    </div>
    <div class="bloc-form">
        <label for="password">Mot de passe <span>*</span></label>
    </div>
    <div class="bloc-form">
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit" class="btn">Me connecter</button>
</form>

<?php

require_once("Composants/Footer.php");
