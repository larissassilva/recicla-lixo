/**
 * Created by MURILO.BARROSO on 06/12/2017.
 */
const server = 'http://teste.jatai.go.gov.br' //url do servidor socket
const port = ':3000' // porta do socket
var favicon

function autoUpdate( timestamp,url )

{
    var queryString = { 'timestamp' : timestamp };

    $.get ( url+'?acao=autoUpdate' , queryString , function ( data )
    {
        var obj = jQuery.parseJSON( data );
        if (timestamp != obj.timestamp & timestamp != null){table.ajax.reload();}
        // reconecta ao receber uma resposta do servidor
        autoUpdate( obj.timestamp,url );
    });
}

function LoginSocket() {
    $(document).ready(function () {
        var socket = io(server+port);
        socket.on('connect', () => {
            $.ajax({
                type: "POST",
                url: "http://localhost/intranet/classes/controleWebsocket.php?acao=Login",
                data: {idwebsocket:socket.id},
                dataType: "JSON",
                success: function (response) {
                    socket.emit('login', response)
                }
            });
          });
          
        socket.on('AtualizarTab', (msg)=>{
            var tables =  $("table")
            $.each(tables, function (key, value) {
                if ($(this).hasClass( "auto-update" )) {
                    timeout =  Math.floor(Math.random(300)*999);
                    console.log(timeout)
                    setTimeout(() => {
                        $('.auto-update').DataTable().ajax.reload( null, false )
                        favicon.badge(' ');
                    }, timeout);
                    console.log('atualizado')

                }
            });
        })
        
        socket.on("Pagina_duplicada", (msg)=>{
            alertify.alert('Esta página já se encontra aberta no navegador', function () {
                windows.history.back();
            })
        })
    })
}

LoginSocket()

/** função para remover notificação icon */
$(document).ready(function(){
    favicon = new Favico({
        animation:'popFade'
    });
    favicon.badge(0);
    $(document).on("click", function() {
        favicon.reset();
    });
  });
var hidden, visibilityChange;
if (typeof document.hidden !== "undefined") {
    hidden = "hidden";
    visibilityChange = "visibilitychange";
} else if (typeof document.mozHidden !== "undefined") {
    hidden = "mozHidden";
    visibilityChange = "mozvisibilitychange";
} else if (typeof document.msHidden !== "undefined") {
    hidden = "msHidden";
    visibilityChange = "msvisibilitychange";
} else if (typeof document.webkitHidden !== "undefined") {
    hidden = "webkitHidden";
    visibilityChange = "webkitvisibilitychange";
}

document.addEventListener(visibilityChange, acao, false);

function acao() {
    if (!document.hidden) {
        favicon.reset();
    }
}