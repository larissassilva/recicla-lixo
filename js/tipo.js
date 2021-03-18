var d;
var R;
var id;
/*    
$(document).ready(function() {
       
        // $('#example').DataTable();
        $('#tabelaTipo').DataTable(
          
            );
    } );
    */
    

d=$("#tabelaTipo").DataTable({//variavel do data table ajax reload/ incio aqui
        ajax: "classes/controleTipo.php?acao=Listar",
        columns: [
        {"data": "id"},
        {"data": "tipo"  
        },
{
            "data": null,
            "createdCell": function (td, cellData, rowData, row, col) {
                 $(td).addClass('text-center');
                $(td).html('<button id="editar2" rel="'+rowData.id+'" type="button" class="button5" data-target="#modalEditar" data-toggle="modal">Editar / Visualizar</button>');
                       }
        }
        ],

        
        //order: [[ 0, 'asc' ], [ 2, 'desc' ]],
        
    
});

$("#tabelaTipo tbody").on( 'click', '#editar2', function (e) {
id= $(this).attr("rel");
console.log("cliquei no editar");
console.log(id);
$.ajax({                    
        url: 'classes/controleTipo.php?acao=Mostrar',//onde esta a classe controle
        type: 'POST',//método
        data:  {id: id},//dados
        dataType: 'JSON',
        success:function (q) {

            $.each(q[0],function(key, value) {
                console.log(q);
                switch (key){

                    default:
                    $("#"+key).val(value).trigger('change');
                    break;
                }
            });
            }
});

});

$("#editar").on("click", function (){
console.log("cliquei no editar da modal");
var form = $("#form-editar").serializeArray();
                var tipo = $("#tipo").val();
                console.log(form);
                 console.log(tipo);
                 console.log(id);
                              
                $.ajax({                    
                url: 'classes/controleTipo.php?acao=Editar',//onde esta a classe controle
                type: 'POST',//método
                data: {id: id, tipo:tipo},//dados
                success:function (e){
                console.log("entrei no editar");

                    $("#modalEditar").hide();


                 //console.log(e);//retorna mensagem
                 //CheckErro("classes/controleTipo.php");//retorna mensagem
                 setTimeout(function() { window.location=window.location;},700);
                 d.ajax.reload();
                }
                                
            });         

});



$("#salvar").on("click", function (){
console.log("cliquei no salvar");

 
                var form = $("#form-cadastrar").serializeArray();
                var tipo = $(".tipo").val();
                console.log(form);
                 console.log(tipo);
                              
                $.ajax({                    
                url: 'classes/controleTipo.php?acao=Inserir',//onde esta a classe controle
                type: 'POST',//método
                data: "&tipo="+tipo,//dados
                success:function (e){
console.log("entrei no salvar");

                    $("#modalCadastrar").hide();


                 //console.log(e);//retorna mensagem
                 CheckErro("classes/controleTipo.php");//retorna mensagem
                 setTimeout(function() { window.location=window.location;},700);
                 d.ajax.reload();
                }
                                
            });            
            


});

$("#excluir").on("click", function (){
console.log("cliquei no excluir");

$.ajax({                    
                url: 'classes/controleTipo.php?acao=Excluir',//onde esta a classe controle
                type: 'POST',//método
                data: {id: id},//dados
                success:function (e){
console.log("entrei no excluir");

                    $("#modalEditar").hide();


                 //console.log(e);//retorna mensagem
                 //CheckErro("classes/controleTipo.php");//retorna mensagem
                 setTimeout(function() { window.location=window.location;},700);
                 d.ajax.reload();
                }
                                
            });            

});




     