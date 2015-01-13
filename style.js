function JsLoadFunc(){
    loadStylesheetsBtns();
}

function loadStylesheetsBtns(){
    var usedStyleSheet,
        stylesArr = document.styleSheets,
        el = document.createElement('div');
        el.id = "ListaStyli";
        el.innerHTML = "Other versions of page:",
        definedCookie = getCookie("stylesheetName");

    if(definedCookie!=""){
        changePageStyle(definedCookie,1);
        usedStyleSheet = definedCookie;
    }else
        usedStyleSheet = (typeof document.preferredStyleSheetSet != 'undefined')?document.preferredStyleSheetSet:document.preferredStylesheetSet;

    for(var i=0;i<stylesArr.length;i++){
        if(usedStyleSheet==stylesArr[i].title)
            el.innerHTML+=' '+usedStyleSheet;
        else
            el.innerHTML+=' <a href="#" onclick="changePageStyle(\''+stylesArr[i].title+'\');return false;">'+stylesArr[i].title+'</a>'
    }
    document.getElementById("kontenerR").appendChild(el);
}

function getCookie(cname) {
    var name = cname+"=";
    var ca = document.cookie.split(';');
    for(var i=0;i<ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c=c.substring(1);
        if (c.indexOf(name)==0) return c.substring(name.length,c.length);
    }
    return "";
} 

function changePageStyle(name, firstTime){
    var links=document.getElementsByTagName("link"),
        innerHTML = 'Other versions of page:',
        firstTime = typeof firstTime!=='undefined'?firstTime:0;

    for (var i=0;i<links.length;i++){
        if(links[i].rel.indexOf( "stylesheet" )!=-1 && links[i].title){
            links[i].disabled = true;
            if(links[i].title == name){
                links[i].disabled = false;
                setCookie("stylesheetName", name);
                if(!firstTime)
                    innerHTML+=' '+name;
            }else if(!firstTime)
                    innerHTML+=' <a href="#" onclick="changePageStyle(\''+links[i].title+'\');return false;">'+links[i].title+'</a>';
        }
    }
    if(!firstTime){
        var menuEl = document.getElementById("ListaStyli");
        menuEl.innerHTML = innerHTML;
    }
}

function setCookie(cname, cvalue, exdays) {
    exdays = typeof exdays!=='undefined'?exdays:9999;
    var d = new Date();
    d.setTime(d.getTime()+(exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}