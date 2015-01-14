<?php
include 'header.php';
echo '<body onload="loadStylesheetsBtns();komunikator();">';
include 'menu.php';
echo "<div id='kontenerR'>";
echo "<div id='header'><h1>Komunikator</h1></div>";
echo "<div id='tresc'>";

echo "<table>";
echo "<tr><td><label><input type='checkbox' name='aktywator' value='0' /> Aktywuj komunikator</label></td></tr>";
echo "<tr><td><textarea style='background-color: lightgrey;' id='komunikator' rows='20' cols='100' disabled readonly></textarea></td></tr>";
echo "</table>";
echo "<form id='wiadomosc' style='display: none;'><table>
      <tr><td colspan='2'>Napisz wiadomość</td></tr>
      <tr><td>Imie/Nick</td><td><input name='nick' value='NoName' /></td></tr>
      <tr><td style='vertical-align: top;'>Tresc wiadomości</td><td><textarea rows='10' cols='50' name='tresc'></textarea></td></tr>";
echo "<tr><td colspan='2'><button type='button' name='wyslij' value='wyslij'>Wyślij</button></td></tr>";
echo "</table></form>";

echo "</div>";
include 'stopka.php';
?>