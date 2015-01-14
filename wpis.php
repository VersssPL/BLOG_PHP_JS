<?php
include 'header.php';
echo '<body onload="formValidator();loadStylesheetsBtns()">';
include 'menu.php';
echo "<div id='kontenerR'>";
echo "<div id='header'><h1>Dodawanie wpisu</h1></div>";
echo "<div id='tresc'>";

$date = date("Y-m-d");
$hour = date("H:i");

if ($_POST == NULL && $_GET == NULL)
{
echo "<form action='' method='post' id='DodajWpis' enctype='multipart/form-data'>
	<table id='tabelaForm'>
                <tr>
                    <td>Nazwa użytkownika: </td>
                    <td><input type='text' name='UserName' /></td>
                </tr>
                <tr>
                    <td>Hasło: </td>
                    <td><input type='password' name='haslo' /></td>
                </tr>
                <tr>
                    <td>Wpis: </td>
                    <td><textarea name='wpis' form='DodajWpis'></textarea></td>
                </tr>
                <tr>
                    <td>Data: </td>
                    <td><input type='text' name='data' value='$date' /></td>
                </tr>
                <tr>
                    <td>Godzina: </td>
                    <td><input type='text' name='godzina' value='$hour' /></td>
                </tr>
                <tr>
                    <td>Pliki</td>
                </tr>
                <tr>
                    <td>1:</td>
                    <td><input type='file' name='zalacznik1'> </td>
                </tr>
                <tr>
                    <td>2:</td>
                    <td><input type='file' name='zalacznik2'> </td>
                </tr>
                <tr>
                    <td>3:</td>
                    <td><input type='file' name='zalacznik3'> </td>
                </tr>
                <tr>
                <td style='text-align: center;' colspan='2'><button type='button' name='dodaj_plik'>Dodaj plik</button></td>
                </tr>
                <tr>
                    <td><input type='submit' value='Wyślij' /></td>
                    <td><input type='reset' value='Wyczyść''></td>
                </tr>
</table>
</form>";
} else {
    $UserName = $_POST['UserName'];
    $haslo = $_POST['haslo'];
    $nowyWpis = strip_tags($_POST['wpis']);
    $data = $_POST['data'];
    $godzina = $_POST['godzina'];
    $name = str_replace('-', '', $data) . str_replace(':', '', $godzina) . date("s") . '00' ;
    if($UserName != null && $haslo != null && trim($nowyWpis) != null ){
    $userList = file("userList.txt");
            for($i = 0; $i < count($userList); $i = $i + 2) {
                if(trim($userList[$i]) == $UserName) {
                    $nazwa = trim($userList[$i + 1]);              
                    break;
                }
            }

    $check = file("$nazwa/info.txt");
    $UserNameRead = trim($check[0]);
    $hasloRead = trim($check[1]);

    if(($UserNameRead == $UserName) && (md5($haslo) == $hasloRead))
    {
        $wpis = fopen($nazwa . "/$name.txt", "w");
        if(flock($wpis, LOCK_EX))
        {
        fwrite($wpis, $data . "\r\n");
        fwrite($wpis, $godzina. "\r\n");
        fwrite($wpis, $nowyWpis. "\r\n");
        }
        else
        {
            echo "Błąd";
            exit();
        }
        fclose($wpis);
    
    for($i=1;$i<12;$i++){
        $f = $_FILES['zalacznik'.$i];
        $zmienna = explode(".", basename($f["name"]));
        $rozszerzenie = "." . $zmienna[count($zmienna)-1];
        IF(isset($f['name']))
        {
        copy($f['tmp_name'], "$nazwa". '/' . $name . $i . $rozszerzenie);
        }
    }

        echo 'Nowy wpis został dodany!';

    }else{
            echo 'Podałeś zły login lub hasło';
        }
        }else {
            echo 'Wszystkie pola formularza powinny być wypełnione.';
          }
}

echo "</div>";
include 'stopka.php';
?>