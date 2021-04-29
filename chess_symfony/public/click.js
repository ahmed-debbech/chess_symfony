function check(){
    var c = document.getElementById('form_move').value;
    alert(c);
    if(c.indexOf('♚') >= 1){
        return false;
    }
    if(c.indexOf('♛') >= 1){
        return false;
    }
    if(c.indexOf('♜') >= 1){
        return false;
    }
    if(c.indexOf('♝') >= 1){
        return false;
    }if(c.indexOf('♞') >= 1){
        return false;
    }
    if(c.indexOf('♟') >= 1){
        return false;
    }
    if(c.indexOf('♔') >= 1){
        return false;
    }
    if(c.indexOf('♕') >= 1){
        return false;
    }
    if(c.indexOf('♖') >= 1){
        return false;
    }
    if(c.indexOf('♗') >= 1){
        return false;
    }if(c.indexOf('♘') >= 1){
        return false;
    }
    if(c.indexOf('♙') >= 1){
        return false;
    }
    return true;
}
function cl(elem){
    var doc = document.getElementById(elem).innerText;
    if(check() == true){
        document.getElementById('form_move').value = document.getElementById('form_move').value + doc;
    }
    document.getElementById('form_move').value = document.getElementById('form_move').value + elem;
}
