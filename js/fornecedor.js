var d;
var id;

d=$("#tabelaFornecedor").DataTable({//variavel do data table ajax reload/ incio aqui
        ajax: "classes/controleFornecedor.php?acao=Listar2",
        columns: [
        {"data": "idfornecedor"},
        {"data": "nome"},
        {"data": "email"},
        {"data": null,
            "createdCell": function (td, cellData, rowData, row, col) {
                 $(td).addClass('text-center');
                $(td).html('<button id="editar2" rel="'+rowData.idfornecedor+'" type="button" class="button5" data-target="#modalEditar" data-toggle="modal">Editar / Visualizar</button>');
                       }
        }
        ],
                
        
        //order: [[ 0, 'asc' ], [ 2, 'desc' ]],
        
    
});

    // $(document).ready(function() {
       
    //     // $('#example').DataTable();
    //     $('#tabelaFornecedor').DataTable(
          
    //         );
    // } );

//     $("#tipo").on('select2:select',function (e) {
//      tipo = e.params.data;

// });

$("#tabelaFornecedor tbody").on( 'click', '#editar2', function (e) {
id= $(this).attr("rel");
console.log("cliquei no editar");
console.log(id);
var id2=id;
console.log(id2);
$.ajax({                    
        url:'classes/controleFornecedor.php?acao=Mostrar',//onde esta a classe controle
        type: 'POST',//método
        data: {id2:id2},//dados
        dataType: 'JSON',
        success:function (q) {

            $.each(q[0],function(key, value) {
                console.log(q);
                switch (key){

                    case 'nome':
                    $("#nome2").val(value).trigger('change');
                    break;

                    case 'Telefone':
                    $("#telefone2").val(value).trigger('change');
                    break;

                    case 'whatsapp':
                    $("#whatsapp2").val(value).trigger('change');
                    break;

                    case 'email':
                    $("#email2").val(value).trigger('change');
                    break;

                    case 'endereco':
                    $("#endereco2").val(value).trigger('change');
                    break;

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
                //var form = $("#form-cadastrar").serializeArray();
                var idfornecedor=id;
                var nome = $("#nome2").val();
                var Telefone = $("#telefone2").val();
                var whatsapp = $("#whatsapp2").val();
                var email = $("#email2").val();
                var endereco = $("#endereco2").val();
                //console.log(form);
                 console.log(nome);
                 console.log(Telefone);
                 console.log(whatsapp);
                 console.log(email);
                 console.log(endereco);
                              
                $.ajax({                    
                url: 'classes/controleFornecedor.php?acao=Editar',//onde esta a classe controle
                type: 'POST',//método
                data: {idfornecedor:idfornecedor, nome:nome,Telefone:Telefone,whatsapp:whatsapp,email:email,endereco:endereco},//dados
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
                var nome = $("#nome").val();
                var Telefone = $("#telefone").val();
                var whatsapp = $("#whatsapp").val();
                var email = $("#email").val();
                var endereco = $("#endereco").val();
                //console.log(form);
                 console.log(nome);
                 console.log(Telefone);
                 console.log(whatsapp);
                 console.log(email);
                 console.log(endereco);
                $.ajax({                    
                url: 'classes/controleFornecedor.php?acao=Inserir',//onde esta a classe controle
                type: 'POST',//método
                data: "&nome="+nome+"&Telefone="+Telefone+"&whatsapp="+whatsapp+"&email="+email+"&endereco="+endereco,//dados
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


$("#excluir").on("click", function (){
console.log("cliquei no excluir");

$.ajax({                    
                url: 'classes/controleFornecedor.php?acao=Excluir',//onde esta a classe controle
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