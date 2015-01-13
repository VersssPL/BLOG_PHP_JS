<?php
include 'header.php';
include 'menu.php';
echo "<div id='kontenerR'>";
echo "<div id='header'><h1>Załóż Blog</h1></div>";
echo "<div id='tresc'>";

if($_GET['zaloz'] == ""){
echo "</br><form action='nowy.php' method='get' id='zalozBlog'>
<table id='tabelaForm'>
                <tr>
                    <td>Nazwa blogu: </td>
                    <td><input type='text' name='BlogName' /></td>
                </tr>
                <tr>
                    <td>Nazwa użytkownika: </td>
                    <td><input type='text' name='UserName' /></td>
                </tr>
                <tr>
                    <td>Hasło: </td>
                    <td><input type='password' name='haslo' /></td>
                </tr>
                <tr>
                    <td>Opis blogu: </td>
                    <td><textarea name='opis' form='zalozBlog'></textarea></td>
                </tr>
                <tr>
                    <td><button style='float: left;' type='submit' name='zaloz' value='zaloz'>Załóż Blog</button></td>
                    <td><input type='reset' value='Wyczyść'></td>
                </tr>

</table></form>";
}else{
    $nazwa = $_GET['BlogName'];
    $login = $_GET['UserName'];
    $haslo = $_GET['haslo'];
    $opis  = $_GET['opis'];
        
        $SprawdzPlik = file("userList.txt");
        $loginZarejstrowany = false;
        
        foreach($SprawdzPlik as $key=>$value){
            if(trim($value) == $login)
                $loginZarejstrowany = true;
        }
    if($nazwa != "" && $login != "" && $haslo != "" && !$loginZarejstrowany){
            if(!is_dir($nazwa)){
                    mkdir($nazwa, 0755, true);
                            echo "Gratulacje! Blog o nazwie ".$nazwa." został utworzony zgodnie z planem!";
                    
                    $file = fopen("$nazwa/info.txt", "w");
                    if(flock($file, LOCK_EX))
                    {
                    fwrite($file,$login."\r\n");
                    fwrite($file,md5($haslo)."\r\n");
                    fwrite($file,$opis);
                    }
                    else
                    {
                        echo 'błąd';
                        exit();
                    }
                    fclose($file);

                    $file2 = fopen("userList.txt", "a");
                    if(flock($file2, LOCK_EX))
                    {
                    fwrite($file2,$login."\r\n");
                    fwrite($file2,$nazwa."\r\n");
                    }
                    else
                    {
                        echo 'błąd';
                        exit();
                    }
                    fclose($file2);

            }else
                echo "Blog o nazwie ".$nazwa." już istnieje";
        }elseif($loginZarejstrowany){
            echo "Podany login już istnieje!";
        }else{
            echo "Wypełnij wszystkie pola!";
        }
}

echo "</div>";

include 'stopka.php';
?>