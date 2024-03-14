<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Client</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Inscription Client</h2>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="nom">Nom et Prénom:</label>
                <input type="text" id="nom" name="nom" placeholder="Enter votre Nom et votre Prénom" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" placeholder="Enter votre age" required>
            </div>
            <div class="form-group">
                <label for="salaire">Salaire:</label>
                <input type="number" id="salaire" name="salaire" placeholder="Enter votre salaire " required>
            </div>
            <div class="form-group">
 <!--           <label for="agence">Agence(s) souhaitée(s):</label>
                <input type="text" id="agence" name="agence" required>
-->
                <label for="agence">Agence(s) souhaitée(s):</label>
                <select id="agence" name="agence" required>
                            <option value="" disabled selected>Choisissez une Agence</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Mohamedia">Mohamedia</option>
                            <option value="Tanger">Tanger</option>
                        </select>

            </div>
            <button type="submit">Soumettre</button>
        </form>
    </div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "Brisefer";
        $password = "mot_de_passe_Brisefe";
        $dbname = "IMMOBILIER";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $nom = $_POST['nom'];
        $age = $_POST['age'];
        $salaire = $_POST['salaire'];
        $agence = $_POST['agence'];

        $sql = "INSERT INTO Client (NomPrenom, Age, Salaire) VALUES ('$nom', '$age', '$salaire')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $sql2 = "INSERT INTO Inscrit (IDC, IDA) VALUES ('$last_id', '$agence')";
            if ($conn->query($sql2) === TRUE) {
                echo "<p>Client inscrit avec succès à l'agence.</p>";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
