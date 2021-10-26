document.getElementById("user_name").addEventListener("input", function () {
    var legajo = document.getElementById("user_name").value;
    i = 0;
    bol=true;
    while(i<legajo.length) {
      ascii = legajo.charCodeAt(i);
        if (!((ascii>96 && ascii<122) || (ascii>64 && ascii<91))) {
            bol=false;
        };
        i++;
    };
    if ( document.getElementById("user_name").classList.contains("verde") && bol==false ){
        document.getElementById("user_name").className = "rojo";

    }
    else if(document.getElementById("user_name").classList.contains("rojo") && bol==true) {
        document.getElementById("user_name").className = "verde";

    };
    if(document.getElementById("user_name").classList.contains("verde") && document.getElementById("user_pass").classList.contains("verde")){
        document.getElementById('boton').disabled=false;

    }
    else if(document.getElementById("user_name").classList.contains("rojo") || document.getElementById("user_pass").classList.contains("rojo")){
        document.getElementById('boton').disabled=true;

    };

});


document.getElementById("user_pass").addEventListener("input", function () {
    var pass = document.getElementById("user_pass").value;
    i = 0;
    bol=true;
    while(i<pass.length) {
      ascii = pass.charCodeAt(i);
        if (!((ascii>47 && ascii<58) || (ascii>96 && ascii<122) || (ascii>64 && ascii<91))) {
            bol=false;
        };
        i++;
    };
    if ( document.getElementById("user_pass").classList.contains("verde") && bol==false ){
        document.getElementById("user_pass").className = "rojo";


    }
    else if(document.getElementById("user_pass").classList.contains("rojo") && bol==true) {
        document.getElementById("user_pass").className = "verde";

    };
    if(document.getElementById("user_name").classList.contains("verde") && document.getElementById("user_pass").classList.contains("verde")){
        document.getElementById('boton').disabled=false;

    }
    else if(document.getElementById("user_name").classList.contains("rojo") || document.getElementById("user_pass").classList.contains("rojo")){
        document.getElementById('boton').disabled=true;
    };
});