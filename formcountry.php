<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Add user</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Страны</h1>

<?php
function getCountry($filename)
{
    return file_exists($filename) ? file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
}
function AddCountry($countryName)
{
    $file = 'country.txt';
    $lines = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
    foreach ($lines as $line) {
        if ($line == $countryName) {
            return "This country exixts";
        }
    }
    $countryAdd = $countryName . PHP_EOL;
    file_put_contents($file, $countryAdd, FILE_APPEND);
    return "Added succeesfully";
}

$flagError = false;
$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $country = trim($_POST["country"]);
    if ($country === '') {
        echo "Поле для страны пустое";
    }else{
        $result = AddCountry($country);
        echo $result;
    }
    $dictionaryFile = 'dictionary.txt';
    $countryFile = 'country.txt';
    $dictionaryCountries = getCountry($dictionaryFile);
    $addedCountries = getCountry($countryFile);
}

?>

<form method="POST">
    <div class="form">
        <label> Введите страну: <input type="text" name="country"></label><br>

        <button type="submit" class="btn">Добавить</button>
    </div>

<!--    --><?php
//    if ($flagError) {
//        echo "<p style='color:red;'>$errorMessage</p>";
//    }
//    if ($successMessage) {
//        echo "<p style='color:green;'>$successMessage</p>";
//    }
//    ?>

    <div class="combo">
        <select name="country">
            <option value="">Все страны</option>
            <?php
            $addedCountries = getCountry('country.txt');
            if (!empty($addedCountries)) {
                foreach ($addedCountries as $addedCountry) {
                    echo "<option value='" . htmlentities($addedCountry) . "'>$addedCountry</option>";
                }
            }
            ?>
        </select>
    </div>
</form>

</body>
</html>
