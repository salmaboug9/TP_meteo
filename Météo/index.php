<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Météo Maroc</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>☀️ Météo au Maroc</h1>
    <form method="post">
        <label for="city"> Choisir une ville :</label>
        <select name="city" id="city">
            <option value="Casablanca" <?php if(isset($_POST['city']) && $_POST['city'] == 'Casablanca') echo 'selected'; ?>>Casablanca</option>
            <option value="Rabat" <?php if(isset($_POST['city']) && $_POST['city'] == 'Rabat') echo 'selected'; ?>>Rabat</option>
            <option value="Oujda" <?php if(isset($_POST['city']) && $_POST['city'] == 'Oujda') echo 'selected'; ?>>Oujda</option>
            <option value="Marrakesh" <?php if(isset($_POST['city']) && $_POST['city'] == 'Marrakesh') echo 'selected'; ?>>Marrakesh</option>
            <option value="Tangier" <?php if(isset($_POST['city']) && $_POST['city'] == 'Tangier') echo 'selected'; ?>>Tangier</option>
            <option value="Fez" <?php if(isset($_POST['city']) && $_POST['city'] == 'Fez') echo 'selected'; ?>>Fès</option>
            <option value="Agadir" <?php if(isset($_POST['city']) && $_POST['city'] == 'Agadir') echo 'selected'; ?>>Agadir</option>
            <option value="Meknes" <?php if(isset($_POST['city']) && $_POST['city'] == 'Meknes') echo 'selected'; ?>>Meknes</option>
        </select>
        <button type="submit" name="meteo">Voir Température</button>
    </form>

    <div id="result">
        <?php 
        if (isset($_POST['meteo'])) {

            $city = $_POST['city'];
            $API = 'c3076c16f8a2c96369e9be00b937fec7';
            $url = "https://api.openweathermap.org/data/2.5/weather?q=$city,MA&appid=$API&units=metric";

            $resultat = @file_get_contents($url);
            if ($resultat === false) {
                echo "<p style='color:red;'> Erreur : impossible de récupérer les données météo. Vérifiez votre clé API ou votre connexion.</p>";
            } else {
                $data = json_decode($resultat, true);
                if (isset($data['main'])) {
                    $temp = $data['main']['temp'];
                    //$description = $data['weather'][0]['description'];
                    $temp_max = $data['main']['temp_max'];
                    $feels_like = $data['main']['feels_like'];
                    $temp_min = $data['main']['temp_min'];
                    $humidite = $data['main']['humidity'];
                    $vent_sp = $data['wind']['speed'];
                    $vent_deg = $data['wind']['deg'];

                    echo "<h2 style='color:#012657;'> $city <h2>";
                    echo "<h3>⬆️ $temp_max °C | ⬇️ $temp_min °C</h3>";
                    echo "<h4>🌡️ Température : {$temp}°C (ressenti : {$feels_like}°C)
                    <br>💧 Humidité : {$humidite}%
                    <br>💨 Vent : {$vent_sp} m/s, direction {$vent_deg}°C</h4>";

                    echo "<div class='sun-icon'>" . ($temp > 20 ? "☀️" : "☁️") . "</div>";
                } else {
                    echo "<p style='color:red;'> Données météo indisponibles pour cette ville. </p>";
                }
            }
        }
        ?>
    </div>
</body>
</html>
