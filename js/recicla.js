var d;
var id;

d=$("#tabelaRecicla").DataTable({//variavel do data table ajax reload/ incio aqui
        ajax: "classes/controleRecicla.php?acao=Listar2",
        columns: [
        {"data": "id"},
        {"data": "material"},
        {"data": "funciona"},
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
       
//         // $('#example').DataTable();
//         $('#tabelaRecicla').DataTable(
          
//             );
//     } );

$("#tabelaRecicla tbody").on( 'click', '#editar2', function (e) {
id= $(this).attr("rel");
console.log("cliquei no editar");
console.log(id);
$.ajax({                    
        url: 'classes/controleRecicla.php?acao=Mostrar',//onde esta a classe controle
        type: 'POST',//método
        data:  {id: id},//dados
        dataType: 'JSON',
        success:function (q) {

            $.each(q[0],function(key, value) {
                console.log(q);
                switch (key){
                    case 'data':
                    $("#data").val(value).trigger('change');
                    break;

                    case 'fornecedor':
                    $("#fornecedor").val(value).trigger('change');
                    break;

                    case 'tipo':
                    $(".tipo").val(value).trigger('change');
                    break;

                    case 'material':
                    $(".material").val(value).trigger('change');
                    break;

                    case 'funciona':
                    $(".funciona").val(value).trigger('change');
                    break;

                    case 'valorcompra':
                    $(".valorcompra").val(value).trigger('change');
                    break;

                    case 'peso':
                    $(".peso").val(value).trigger('change');
                    break;

                    case 'valorvenda':
                    $(".valorvenda").val(value).trigger('change');
                    break;

                    default:
                    //$("#"+key).val(value).trigger('change');
                    break;
                }
            });
            }
});

});



$("#salvar").on("click", function (){
console.log("cliquei no salvar");

 
                var form = $("#form-cadastrar").serializeArray();
                var idfornecedor = $("#idfornecedor").val();
                var tipo = $("#tipo").val();
                var material = $("#material").val();
                var funciona = $("#funciona").val();
                var valorcompra = $("#valorcompra").val();
                var peso = $("#peso").val();
                var data = new Date();
                var dia  = data.getDate(); 
                var mes  = data.getMonth();
                var ano4 = data.getFullYear(); 
                var str_data = dia + '/' + (mes+1) + '/' + ano4;
                var dt= ano4 + '-' +(mes+1)+ '-' +dia;
                data =dt; 
                console.log(form);
                var valorvenda=0;
                 console.log(idfornecedor);
                 console.log(tipo);
                 console.log(material);
                 console.log(funciona);
                 console.log(valorcompra);
                 console.log(peso);
                 console.log(data);
                   // "&funciona:funciona,valor_compra:valorcompra,valor_venda:valorvenda,data_cadastro:data,id_material:material,fornecedor_idfornecedor:fornecedor,peso:peso,
                $.ajax({                    
                url: 'classes/controleRecicla.php?acao=Inserir',//onde esta a classe controle
                type: 'POST',//método
                data: "&idfornecedor="+idfornecedor+"&funciona="+funciona+"&valor_compra="+valorcompra+"&data_cadastro="+data+"&idnome_elixo="+material+"&peso="+peso,//dados
                success:function (e){
console.log("entrei no salvar");

                    $("#modalCadastrar").hide();


                 //console.log(e);//retorna mensagem
                 //CheckErro("classes/controleTipo.php");//retorna mensagem
                 setTimeout(function() {window.location=window.location;},700);
                 d.ajax.reload();
                }
                                
            });            
            


});
//"&funciona:funciona,valor_compra:valorcompra,valor_venda:valorvenda,data_cadastro:data,id_material:material,fornecedor_idfornecedor:fornecedor,peso:peso,

// $("#editar").on("click", function (){
// console.log("cliquei no editar da modal");

// SELECT r.funciona as funciona, r.valor_compra as valorcompra, r.valor_venda as valorvenda, 
// r.data_cadastro as data, r.idfornecedor as fornecedor, r.idnome_elixo as material,m.id_tipo, t.id as tipo, r.peso as peso
// var form = $("#form-editar").serializeArray();
// var idrecicla_elixo= id;
//                 var idrecicla_elixo = id;
//                 var valorcompra = $("#valorcompra").val();
//                  var valorvenda = $("#valorvenda").val();
//                   var data = $("#data").val();
//                    var fornecedor = $("#fornecedor").val();
//                     var material = $("#material").val();
//                      var tipo = $("#tipo").val();
//                      var peso= $("#peso").val();
                
//                 console.log(form);
               
                              
//                 $.ajax({                    
//                 url: 'classes/controleMaterial.php?acao=Editar',//onde esta a classe controle
//                 type: 'POST',//método
//                 data: {idrecicla_elixo:idrecicla_elixo,funciona:funciona,valor_compra:valorcompra,valor_venda:valorvenda,data_cadastro:data,id_material:material,fornecedor_idfornecedor:fornecedor,peso:peso},//dados
//                 success:function (e){
//                 console.log("entrei no editar modal");

//                     $("#modalEditar").hide();


//                  //console.log(e);//retorna mensagem
//                  //CheckErro("classes/controleTipo.php");//retorna mensagem
//                   setTimeout(function() { window.location=window.location;},700);
//                   d.ajax.reload();
//                 }
                                
//             });         

// });

// $("#excluir").on("click", function (){
// console.log("cliquei no excluir");

// $.ajax({                    
//                 url: 'classes/controleRecicla.php?acao=Excluir',//onde esta a classe controle
//                 type: 'POST',//método
//                 data: {id: id},//dados
//                 success:function (e){
// console.log("entrei no excluir");

//                     $("#modalEditar").hide();


//                  //console.log(e);//retorna mensagem
//                  //CheckErro("classes/controleTipo.php");//retorna mensagem
//                  setTimeout(function() { window.location=window.location;},700);
//                  d.ajax.reload();
//                 }
                                
//             });            

// });