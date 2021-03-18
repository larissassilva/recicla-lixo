var tipo;
var d;
var id;

d=$("#tabelaMaterial").DataTable({//variavel do data table ajax reload/ incio aqui
        ajax: "classes/controleMaterial.php?acao=Listar2",
        columns: [
        {"data": "id"},
        {"data": "nome"},
        {"data": "tipo"},
        {"data": null,
            "createdCell": function (td, cellData, rowData, row, col) {
                 $(td).addClass('text-center');
                $(td).html('<button id="editar2" rel="'+rowData.id+'" type="button" class="button5" data-target="#modalEditar" data-toggle="modal">Editar / Visualizar</button>');
                       }
        }
        ],

        
        //order: [[ 0, 'asc' ], [ 2, 'desc' ]],
        
    
});

    // $(document).ready(function() {
       
    //     // $('#example').DataTable();
    //     $('#tabelaMaterial').DataTable(
          
    //         );
    // } );

//     $("#tipo").on('select2:select',function (e) {
//      tipo = e.params.data;

// });

$("#tabelaMaterial tbody").on( 'click', '#editar2', function (e) {
id= $(this).attr("rel");
console.log("cliquei no editar");
console.log(id);
$.ajax({                    
        url: 'classes/controleMaterial.php?acao=Mostrar',//onde esta a classe controle
        type: 'POST',//método
        data:  {id: id},//dados
        dataType: 'JSON',
        success:function (q) {

            $.each(q[0],function(key, value) {
                console.log(q);
                switch (key){
                    case 'tipo':
                    $("#tipo2").val(value).trigger('change');
                    break;

                    case 'nome':
                    $("#nome2").val(value).trigger('change');
                    break;

                    default:
                    //$("#"+key).val(value).trigger('change');
                    break;
                }
            });
            }
});

});

$("#editar").on("click", function (){
console.log("cliquei no editar da modal");
var form = $("#form-editar").serializeArray();
                var id_tipo = $('#tipo2').val();
                var nome = $("#nome2").val();
                var idnome_elixo= id;
                console.log(form);
                 console.log(tipo);
                 console.log(nome);
                 console.log(id);
                              
                $.ajax({                    
                url: 'classes/controleMaterial.php?acao=Editar',//onde esta a classe controle
                type: 'POST',//método
                data: {idnome_elixo: idnome_elixo, nome:nome, id_tipo:tipo},//dados
                success:function (e){
                console.log("entrei no editar modal");

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

 
                //var form = $("#form-cadastrar").serializeArray();
                var tipo = $('#tipo').val();
                var nome = $(".nome").val();
                //console.log(form);
                 console.log(tipo);
                 console.log(nome);
                              
                $.ajax({                    
                url: 'classes/controleMaterial.php?acao=Inserir',//onde esta a classe controle
                type: 'POST',//método
                data: "&id_tipo="+tipo+"&nome="+nome,//dados
                success:function (e){
console.log("entrei no salvar");

                    $("#modalCadastrar").hide();


                 //console.log(e);//retorna mensagem
                 //CheckErro("classes/controleTipo.php");//retorna mensagem
                 setTimeout(function() { window.location=window.location;},700);
                 d.ajax.reload();
                }
                                
            });            
            


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

$("#excluir").on("click", function (){
console.log("cliquei no excluir");

$.ajax({                    
                url: 'classes/controleMaterial.php?acao=Excluir',//onde esta a classe controle
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