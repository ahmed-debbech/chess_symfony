function check(){
    var c = document.getElementById('form_move').value;
    if(c.indexOf('K') >= 0){
        return false;
    }
    if(c.indexOf('Q') >= 0){
        return false;
    }
    if(c.indexOf('R') >= 0){
        return false;
    }
    if(c.indexOf('B') >= 0){
        return false;
    }if(c.indexOf('H') >= 0){
        return false;
    }
    if(c.indexOf('p') >= 0){
        return false;
    }
    return true;
}
function cl(elem){
    var doc = document.getElementById(elem).innerText;
    document.getElementById(elem).style.backgroundColor= '#F0BABA';
    if(check() == true){
        var ch = '';
        switch(doc){
            case '♚': ch = 'K'; break;
            case '♛': ch = 'Q'; break;
            case '♜': ch = 'R'; break;
            case '♝': ch = 'B'; break;
            case '♞': ch = 'H'; break;
            case '♟': ch = 'p'; break;
            case '♔': ch = 'K'; break;
            case '♕': ch = 'Q'; break;
            case '♖': ch = 'R'; break;
            case '♗': ch = 'B'; break;
            case '♘': ch = 'H'; break;
            case '♙': ch = 'p'; break;
        }
        document.getElementById('form_move').value = document.getElementById('form_move').value + ch;
    }
    document.getElementById('form_move').value = document.getElementById('form_move').value + elem;
}
