<?php
include 'header.php';
include 'menu.php';
echo "<div id='kontenerR'>";
echo "<div id='header'><h1>Dodaj Komentarz</h1></div>";
echo "<div id='tresc'>";

$date = date("Y-m-d");
$hour = date("H:i");

echo "<form action='' method='post' id='DodajKomentarz'>

<table id='tabelaForm'>
                <tr>
                    <td>nick: </td>
                    <td><input type='text' name='nick' /></td>
                </tr>
                <tr>
                    <td>Komentarz: </td>
                    <td><textarea name='koment' form='DodajKomentarz'></textarea></td>
                </tr>
                <tr>
                    <td>Rodzaj komentarza: </td>
                    <td><select name='rodzajKom'>
                        <option selected label='neutralny' value='neutralny'>Neutralny</option>
                        <optgroup label='Rodzaj komentarza'>
                        <option label='pozytywny' value='pozytywny'>Pozytywny</option>
                        <option label='neutralny' value='neutralny'>Neutralny</option>
                        <option label='negatywny' value='negatywny'>Negatywny</option>
                        </optgroup></select></td>
                </tr>
                <tr>
                        <td>Data</td><td><input name='data' value='$date'/></textarea></td>
                </tr>
                <tr>
                        <td>Godzina</td><td><input name='godzina' value='$hour'/></textarea></td>
                </tr>
                <tr>
                    <tr>
                            <td><button style='float: left;' type='submit' name='wyslij' value='wyslij'>Wyślij</button></td>
                            <td><button style='float: left;' type='reset' name='wyczysc' value='wyczysc'>Wyczyść</button></td>
                    </tr>
                </tr>
</table>
</form>";

if (isset($_POST['wyslij'])){

$nick = $_POST['nick'];
$rodzajKom = $_POST['rodzajKom'];
$koment = $_POST['koment'];
$data = $_POST['data'];
$godzina = $_POST['godzina'];

$blog = (htmlspecialchars($_GET["blog"]));
$wpis = (htmlspecialchars($_GET["wpis"]));

chdir($blog);
$name_koment = str_replace('.txt', '', $wpis) . ".k";
if(!is_dir($name_koment)){
    mkdir($name_koment);
}
$numer = count(scandir($name_koment)) - 2;
              
$file = fopen("$name_koment/$numer" . '.txt' , 'w');
fwrite($file, "$rodzajKom\r\n$data\r\n$godzina\r\n$nick\r\n$koment");
            
header("Location: blog.php?nazwa=". $blog);

}


echo "</div>";
include 'stopka.php';
?>