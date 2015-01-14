function setDate(){
    var myDate = new Date();
    var rok = myDate.getFullYear().toString();
    var miesiac = (myDate.getMonth()+1).toString();
    var dzien = myDate.getDate().toString();
    
    if(miesiac.length == 1)
        miesiac = "0"+miesiac;
    if(dzien.length == 1)
        dzien = "0"+dzien;
    
    var aktualnaData = rok+"-"+miesiac+"-"+dzien;
    
    document.getElementsByName("data")[0].value = aktualnaData;
}

function setHour(){
    var myDate = new Date();
    var godzina = myDate.getHours().toString();
    var minuta = myDate.getMinutes().toString();
    
    if(godzina.length == 1)
        godzina = "0"+godzina;
    if(minuta.length == 1)
        minuta = "0"+minuta;
    
    var aktualnaGodzina = godzina+":"+minuta;
    
    document.getElementsByName("godzina")[0].value = aktualnaGodzina;
}

function checkDate(data) {
  var dane = data.split('-');
  var rok = dane[0], miesiac  = dane[1], dzien = dane[2];
  
  var dniMiesiaca = [31,28,31,30,31,30,31,31,30,31,30,31];
  
  if ( (!(rok % 4) && rok % 100) || !(rok % 400)) {
    dniMiesiaca[1] = 29;
  }
  var czyDobraData = (dzien <= dniMiesiaca[--miesiac]) && (dzien > 0) && (rok >0);
  return czyDobraData;
}

function checkHour(godzina){
    var testGodziny1 =  /^[0-1][0-9]:[0-5][0-9]$/;
    var testGodziny2 = /^2[0-3]:[0-5][0-9]$/;
    return (testGodziny1.test(godzina) || testGodziny2.test(godzina));
}

function formValidator(){
        var godzina_input = document.getElementsByName("godzina")[0];
        var data_input = document.getElementsByName("data")[0];
        var przycisk2 = document.getElementsByName("dodaj_plik")[0];
        
        setDate();
        setHour();
        
        data_input.onchange = function(){
            var data = document.getElementsByName("data")[0].value;
            if(!checkDate(data)){
                alert('Podano nieprawidłową datę!');
                setDate();
                return false;
            }
        };
        godzina_input.onchange = function(){
            var godzina = document.getElementsByName("godzina")[0].value;
            if(!checkHour(godzina)){
                alert('Podano nieprawidłową godzinę!');
                setHour();
                return false;
            }
            
        };
        przycisk2.onclick = function(){
            var tab = document.getElementById("tabelaForm");
            var iloscWierszy = tab.rows.length;
            var wstawianyWiersz = tab.insertRow(iloscWierszy-2);
            var komorka1 = wstawianyWiersz.insertCell(0);
            var komorka2 = wstawianyWiersz.insertCell(1);
            komorka1.innerHTML = iloscWierszy-7+':';
            komorka2.innerHTML = "<input type='file' name='zalacznik"+(iloscWierszy-7)+"'/>";
        };
};