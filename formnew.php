<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Add user</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Страны</h1>

<form method="POST">
    <div class="form">
        <label for="country">Введите страну:</label><br>
        <input type="text" name="country"><br>
        <button type="submit" class="btn">Добавить</button>
    </div>
</form>


<?php
function CheckCountry($country)
{
    $dictionaryFile = array();
    $filePointer = fopen("dictionary.txt", "r");
    while (!feof($filePointer)) {
        $content = fgets($filePointer);
        if (strlen($content) > 2) {

            $countrystring = trim($content);
            $dictionaryFile[] = $countrystring;
        }
    }
    fclose($filePointer);
    for ($i = 0; $i < count($dictionaryFile); $i++) {
        if ($dictionaryFile[$i] == $country) {
            return true;
        }
    }
    return false;
}

function CheckList($country)
{
    $filePointer = fopen("country.txt", "r");
    $countryFile = array();
    while (!feof($filePointer)) {
        $content = fgets($filePointer);
        if (strlen($content) > 2) {

            $countrystring = trim($content);
            $countryFile[] = $countrystring;
        }
    }
    fclose($filePointer);
    for ($i = 0; $i < count($countryFile); $i++) {
        if ($countryFile[$i] == $country) {
            return false;
        }
    }
    return true;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['country'])) {
$country = trim($_REQUEST['country']);
    if ($country !== "") {
  if (CheckList($country)) {
   if (CheckCountry($country)) {
                $filePointer = fopen("country.txt", "a");
                fwrite($filePointer, $_REQUEST['country'] . "\n");
                fclose($filePointer);
                echo "<p style='color: green;'>Страна добавлена</p>";
               } else {
               echo "<p style='color: red;'>Такой страны не существует</p>";
               }
               } else {
                echo "<p style='color: red;'>Такая страна уже есть в списке</p>";
                 }
             } else {
             echo "<p style='color: red;'>Введите название страны</p>";
           }
         }

echo "<br><hr>";
echo '<select id="combo" size=\"8\">';

echo '<option value="">Все страны</option>';
$filePointer = fopen("country.txt", "r");

while (!feof($filePointer)) {
    $content = fgets($filePointer);
    $country = trim($content);
    if (strlen($content) > 2) {
        echo "<option>" . $content . "</option>";
    }
}
fclose($filePointer);
echo "</select>";
?>


</body>
</html>