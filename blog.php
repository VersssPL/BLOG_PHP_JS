<?php
include 'header.php';
echo '<body onload="loadStylesheetsBtns()">';
include 'menu.php';
echo "<div id='kontenerR'>";
$nazwaBlogu = $_GET["nazwa"];

function IsDir($nazwa) {
    $dirs = scandir(".");   
        for($i = 2; $i < count($dirs); $i++) {
            if(is_dir($dirs[$i]) && $dirs[$i] == $nazwa && $dirs[$i] != "img") {
                return true;    
            }
        }
    return false;
}
echo "<div id='header'>";
            if($nazwaBlogu == null) {
                echo "<h1>BLOGI</h1>";
            } else if(IsDir($nazwaBlogu)) {
                echo "<h1>$nazwaBlogu</h1>";
            }
          echo  "</div>";
echo "<div id='tresc'>";

if($nazwaBlogu == null) {
            echo '<h3>Lista blogów:</h3>
                   <ul>';
                   
            $dirs = scandir(".");   
            for($i = 2; $i < count($dirs); $i++)
                if(is_dir($dirs[$i]) && $dirs[$i] != "img") {
                    $link[$i] = str_replace(" ","+", $dirs[$i]);
                    echo '<li><a href="blog.php?nazwa='.$link[$i].'">'.$dirs[$i].'</a></li>';   
                }                
            echo '</ul>';
        
        }
        else  if(IsDir($nazwaBlogu)) {
        $check = file("$nazwaBlogu/info.txt");
        $UserNameRead = trim($check[0]);
        $OpisRead = trim($check[2]);

        echo '<div id="opis">';
        echo "$UserNameRead" . ' - opis blogu:';
        echo '</br>';
        echo "$OpisRead";
        echo '</div>';

        $lista = scandir($nazwaBlogu);
            rsort($lista);
            $i = 0;
            foreach($lista as $key=>$value){
            $wpis = "";
            if(strpos($value,"00.txt")) {
                $file = file($nazwaBlogu . "/$value");
                
                for($j = 2; $j <= count($file); $j++){
                    $wpis .= $file[$j] . "<br/>";
                }
                $i++;
                

                echo '<div id="wpis">';
                echo '<div id="data">';
                echo "$file[0]" . ' ' . "$file[1]" . " // " . "$UserNameRead";
                echo '</div>';
                echo '<div id="linia">';
                echo '</div>';
                echo '<h3>Treść wpisu: </h3>';
                echo $wpis;  
                echo 'Załączniki: </br>';
                $k=1;
                foreach($lista as $key=>$elem){
                    if(strlen(trim($elem, ".txt")) > strlen("RRRRMMDDGGmmSSUU") && strpos($elem,".k" ) === false && strpos($elem, trim($value, ".txt"))!== false ) {
                        echo '<a href="'.$nazwaBlogu.'/'.$elem.'">Zalacznik '.$k.'</a> </br>';
                        $k++;
                    }
                }
                echo '</br>';
                echo '</br>';
                echo '<div id="komentarz">';
                echo '<h2>Komentarze: </h2>';

                $LinkWpis = str_replace('.txt', '', $value);
               $komentFolder = $LinkWpis . ".k";    
               $nazwaBlogu = $_GET["nazwa"];
                        if(is_dir($nazwaBlogu . '/' . $komentFolder)){ 
                        $komentarze = array_diff(scandir($nazwaBlogu . '/' . $komentFolder), (array)".", (array)"..");                    
                        foreach($komentarze as $komentarz){                            
                        $komentTablica = file($nazwaBlogu . '/' . $komentFolder . '/' . $komentarz);                                   
                        echo $komentTablica[0]. ' | '. $komentTablica[1]. ', '. $komentTablica[2]. ' | ' . $komentTablica[3] . '<br>'. $komentTablica[4]. '<br>';
                        }      
                        }
                        else echo 'Brak komentarzy <br>';
                
                    echo '<br><a href="koment.php?blog='. (htmlspecialchars($_GET["nazwa"])). '&wpis='. $LinkWpis. '">Dodaj komentarz</a><br>'; 
                echo '</div>';
                echo '</div>';
                
                     
            }
        }
        }else {
            echo 'podany blog nie istnieje';
        }
echo "</div>";
include 'stopka.php';
?>