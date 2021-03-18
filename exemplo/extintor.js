var G_tab='';
var idorgao ='';
var idlocal='';
var idsublocal='';
var t;
var ids='';
var idl='';
var idm='';
var dia=new Date();
dia=dia.getDate();
var mes=new Date();
mes=mes.getMonth()+1;
var ano=new Date();
ano=ano.getFullYear();
var linered= new Date(ano, mes, dia);
//console.log(linered);


/* Datepiker Mostrar Apenas ANO*/
$(document).ready(function () {
    $("#datepickerAno").datepicker( {
        format: " yyyy",
        viewMode: "years", 
        minViewMode: "years",
        autoclose: true,
        language: 'pt-BR',
        startDate: "date"
    });
       // $('#datepickerAno').datepicker("setDate", new Date());
   });
t=$("#tabelaExtintor").DataTable({
    "ajax": "classes/controleCad_extintor.php?acao=ListarTabelaExtintor",
    "type": "JSON",
    "columns": [ 
    {"data": "modelo"}, 
    {"data": "codigo"},
    {"data": "local"},
    {"data": "sublocal"},
    {"data": "val_recarga"}, 
    {"data": "val_casco"},   
    {"data": "status",
    "createdCell" : function (td, cellData, rowData, col) {
        $(td).addClass('text-center');
        $(td).html('<span class="label ativo-inativo">' + cellData + '</span>');
    }
}],    
    //Label no Status 
    "drawCallback": function (settings) {
     $("table tr").each(function(){
        var $ROW = $(this);

        if ($ROW.find('.ativo-inativo:contains("INATIVO")').css('background-color', '#C2C2C2').length) {
            //console.log('find')
            $ROW.find('.ativo-inativo').css({"background-color" : "#C2C2C2", "color" : "#fff", "font-weight": "normal", "padding" : "5px 9.8px 5px"});
        } else {
            //console.log('not find')
            $ROW.find('.ativo-inativo').css({"background-color" : "#46be8a", "padding" : "5px 15px 5px"});
        }
    });
 },
 "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
          // deixando a linha colorida de vermelho quando vencido
          //console.log(aData.val_recarga);
          //console.log(aData.val_casco);
          var x=aData.val_recarga;
          var d23 = x.split("/", 3);
          var vrecarga= new Date(d23[2], d23[1], d23[0]);
          //console.log(vrecarga);
          
          var y=aData.val_casco;
          var d22 = y.split("/", 3);
          var vcasco= new Date(d23[2], d23[1], d23[0]);           
          //console.log(vcasco);
          if(vrecarga<linered || vcasco<linered){
              $(nRow).addClass("danger"); 
          }      
      }
  });

/* Label no Status */
/*$("table tr").each(function() {
    var $ROW = $(this);

    if ($ROW.find('.ativo-inativo:contains("INATIVO")').css('background-color', '#C2C2C2').length) {
        console.log('find')
        $ROW.find('.ativo-inativo').css({"background-color" : "#C2C2C2", "color" : "#fff", "font-weight": "normal", "padding" : "5px 9.8px 5px"});
    } else {
        console.log('not find')
        $ROW.find('.ativo-inativo').css({"background-color" : "#46be8a", "padding" : "5px 15px 5px"});
    }
});*/

    // Retira o caractere acentuado da entrada de pesquisa
    $('#tabelaExtintor_filter input[type=search]').keyup( function () {
        var table = $('#tabelaExtintor').DataTable(); 
        table.search(
            jQuery.fn.DataTable.ext.type.search.html(this.value)
            ).draw();
    });
    /* Validate */
$("#novo_cadastro").on("click", function(){
    ResetModal("modalCadastrar","form-cadastrar");
});

    $("#form-cadastrar").validate( {
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) { 
                error.insertAfter(element.parent());      // radio/checkbox?
            } else if (element.hasClass('select2-hidden-accessible')) {     
                error.insertAfter(element.next('span'));  // select2
                element.next('span').addClass('error').removeClass('valid');
            } else {                                      
                error.insertAfter(element);               // default
            }
        },

        submitHandler: function(form){

         var form = $("#form-cadastrar").serialize();               
         //console.log(form);
         var dtr=$('.val_recarga').val();
           //console.log(dtr);
           var d2 = dtr.split("/", 3);
           dtr = d2[2] + '-' + d2[1] + '-' + d2[0];
          // console.log(dtr);
           var dtc=$('.val_casco').val();
           //console.log(dtc);
           var d2 = dtc;
           dtc= d2 + '-' + 01 + '-' + 01;
           //console.log(dtc);
           var status="ATIVO";

           var codigo=$("#cod").val();
           //console.log(codigo);

           $.ajax({                    
                url: 'classes/controleCad_extintor.php?acao=ListarDuplicado',//onde esta a classe controle
                type: 'POST',//método
                data: {codigo:codigo},//dados
                dataType: "JSON",
                success:function (e){
                    //console.log(e);
                    if(e==0){
                        console.log("não tem!");
                        alertify.confirm("Confirma o cadastro?", function (e1) {
                            if (e1) {
                                $.ajax({                    
                                url: 'classes/controleCad_extintor.php?acao=Inserir',//onde esta a classe controle
                                type: 'POST',//método
                                data: form+"&val_recarga2="+dtr+"&val_casco2="+dtc+"&status="+status,//dados
                                success:function (e){
                                    //console.log('sucesso');
                                    $("#modalCadastrar").modal('toggle');
                                    $('#form-cadastrar').each(function(){
                                        
                                    }); 

                                     CheckErro("classes/controleCad_extintor.php");//retorna mensagem
                                     t.ajax.reload();
                                 }

                             });
                            }}).set('labels', {ok:'Sim', cancel:'Não'});

                    }else{
                        //console.log("Há um duplicado!");
                        alertify.alert("Já existe um Extintor com esse Código!", function() {
                            $('#cod').focus();
                        });              
                    }

                               CheckErro("classes/controleCad_extintor.php");//retorna mensagem
                           }

                       });          

       }

   });


    $("#form-editar").validate( {
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) { 
                error.insertAfter(element.parent());      // radio/checkbox?
            } else if (element.hasClass('select2-hidden-accessible')) {     
                error.insertAfter(element.next('span'));  // select2
                element.next('span').addClass('error').removeClass('valid');
            } else {                                      
                error.insertAfter(element);               // default
            }
        },

        submitHandler: function(form){

         var form = $("#form-editar").serialize(); 
         //console.log(form);
         var id_modelo2=idm;
         //console.log(id_modelo2);
         var data=$("#data").val();
         var d23 = data.split("/", 3);
         data = d23[2] + '-' + d23[1] + '-' + d23[0];
         //console.log(data);
         var dtr=$("#val_recarga").val();
           //console.log(dtr);
           var d2 = dtr.split("/", 3);
           dtr = d2[2] + '-' + d2[1] + '-' + d2[0];
           //console.log(dtr);
           var dtc=$("#val_casco").val();
           //console.log(dtc);
           //var d22 = dtc.split("/", 3);
           dtc= dtc + '-' + 01 + '-' + 01;
           //console.log(dtc);
           var id=G_tab.id;
           //console.log(id);
           var status='';
           var st = document.getElementById("status");
           if (st.checked == true){
            status="INATIVO";
        }else {
            status="ATIVO";
        }
        //console.log(status);
        var codigo=$("#codigo").val();
        //console.log(codigo);
        $.ajax({                    
                url: 'classes/controleCad_extintor.php?acao=ListarDuplicado',//onde esta a classe controle
                type: 'POST',//método
                data: {codigo:codigo},//dados
                dataType: "JSON",
                success:function (e){
                    //console.log(e);
                    if(e==0){
                       // console.log("não tem!");
                        alertify.confirm("Confirma a edição?", function (e1) {
                            if (e1) {
                                $.ajax({                    
                                url: 'classes/controleCad_extintor.php?acao=Editar',//onde esta a classe controle
                                type: 'POST',//método
                                data: form+"&data="+data+"&id="+id+"&val_recarga2="+dtr+"&val_casco2="+dtc+"&status="+status+"&id_modelo2="+id_modelo2,//dados
                                success:function (e){
                                        //console.log('sucesso');
                                        $("#modalEditar").modal('toggle');
                                        $('#form-editar').each(function(){
                                            
                                        }); 

                                    CheckErro("classes/controleCad_extintor.php");//retorna mensagem
                                    t.ajax.reload();
                                }
                                });
                            }});
                    }else if (e.id==id) {
                        alertify.confirm("Confirma a edição?", function (e1) {
                            if (e1) {
                              $.ajax({                    
                                url: 'classes/controleCad_extintor.php?acao=Editar',//onde esta a classe controle
                                type: 'POST',//método
                                data: form+"&data="+data+"&id="+id+"&val_recarga2="+dtr+"&val_casco2="+dtc+"&status="+status+"&id_modelo2="+id_modelo2,//dados
                                success:function (e){
                                        //console.log('sucesso');
                                        $("#modalEditar").modal('toggle');
                                        $('#form-editar').each(function(){
                                                
                                            }); 

                                    CheckErro("classes/controleCad_extintor.php");//retorna mensagem
                                    t.ajax.reload();
                                }
                            }); 
                          }}).set('labels', {ok:'Sim', cancel:'Não'});

                    }
                    else{
                       // console.log("Há um duplicado!");
                        alertify.alert("Já existe um Extintor com esse Código!", function() {
                            $('#codigo').focus();
                        });              
                    }
                }
            });
    }
});

$("#tabelaExtintor").on('click', 'tr', function(e){    
    var dado= t.row($(this)).data();//vir tudo da linha que cliquei
    //console.log(dado);
    G_tab = dado;
    var id = dado.id;
    idl=null;
    ids=null;
    //console.log(id);

    $.ajax({                    
        url: 'classes/controleCad_extintor.php?acao=MostrarExtintor',//onde esta a classe controle
        type: 'POST',//método
        data:  {id: id},//dados
        dataType: 'JSON',
        success:function (q) {

            $.each(q[0],function(key, value) {
               // console.log(q);
                switch (key){
                    case 'status':
                    if (value == "INATIVO") {
                        $("#status").prop( "checked", true );
                    }else{
                        $("#status").prop( "checked", false );
                    }
                    break; 

                    case 'id_orgao':
                    idorgao=value;
                    $(".id_orgao").val(value).trigger('change');
                    break;

                    case 'id_local':
                   // console.log(value);
                    idl=value;
                    SelectLocal(idorgao).then(function () {
                        $("."+key).val(value).trigger('change');
                    });
                    break;  

                    case 'id_sublocal':
                    //console.log(value);
                    ids=value;
                    SelecSublocal(idl).then(function () {
                        $("."+key).val(value).trigger('change');
                    });;                
                    break; 

                    case 'id_modelo':
                        //console.log(value);
                        idm=value;                    
                        $("."+key).val(value).trigger('change');                                   
                    break; 

                    default:
                    $("#"+key).val(value).trigger('change');
                    break;
                }
            });

            $(".id_orgao").val(idorgao).trigger('change');              
            CheckErro("classes/controleCad_extintor.php");//retorna mensagem 
            $('#modalEditar').modal('toggle');
            t.ajax.reload();                       
        }                                          
    });   

});

$(document).ready(function () {
    $('.select2-hidden-accessible').on('change', function() {
        if($(this).valid()) {
            $(this).next('span').removeClass('error').addClass('valid');
        }
    });
});


//Contador de caracteres
    $('.contador-caracteres').on("input", function(e) {
        var limite = 1000;
        var informativo = "caracteres restantes.";
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;
        console.log($(this).val());
        if (caracteresRestantes <= 0) {
            var observacao = $(this).val();
            $(this).val(observacao.substr(0, limite));
            $(".caracteres").text("0 " + informativo);
        } else {
            $(".caracteres").text(caracteresRestantes + " " + informativo);
        }
    });



$.ajax({
    url:"classes/controleCad_extintor.php?acao=ListarModelo",
    type: "post",
    dataType: 'json', 
    data: "data",           
    success: function (obj) { 
        $(".id_modelo").select2({
            data: obj.data,
        });
        CheckErro("classes/controleCad_extintor.php");//retorna mensagem
    }
});

$.ajax({
    url:"classes/controleCad_extintor.php?acao=ListarIdOrgao",
    type: "post",
    dataType: 'json', 
    data: "data",           
    success: function (obj) { 
        $(".id_orgao").select2({
            data: obj.data,
        });
        CheckErro("classes/controleCad_extintor.php");//retorna mensagem
    }

});



$(".id_orgao").on('select2:select',function (e) {
    idorgao = e.params.data.id;
    //console.log(idorgao); 
    $(".id_local").empty();
    $(".id_sublocal").empty();
    $(".id_local").html("<option></option>");

    $.ajax({
        url:"classes/controleCad_extintor.php?acao=ListarLocal",
        type:"POST",
        data:{id:idorgao},
        dataType:'JSON',
        success: function (obj){
            $(".id_local").select2({
                data: obj.data,
            });
            CheckErro("classes/controleCad_extintor.php");
        }
    });
});


$(".id_local").on('select2:select',function (e) {
    idlocal = e.params.data.id;
    //console.log(idlocal);
    $(".id_sublocal").empty();
    $(".id_sublocal").html("<option></option>");
    $.ajax({
        url:"classes/controleCad_extintor?acao=ListarSublocal",
        type: "POST",
        dataType: 'json', 
        data: {id:idlocal},           
        success: function (obj) {   
            $(".id_sublocal").select2({
                data: obj.data,
            });
                    CheckErro("classes/controleCad_extintor.php");//retorna mensagem
                }            
            }).done(function () {  
                sleep(1000);
            });         

        });


$(".id_sublocal").on('select2:select',function (e) {
    idsublocal = e.params.data.id;
    //console.log(idsublocal);
});

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function Local(){
    console.log("Função Local!")
    $.ajax({
        url:"classes/controleCad_extintor.php?acao=ListarLocal2",
        type: "POST",
        dataType: 'JSON', 
        data: {id:idorgao},
        success: function (obj){
            //console.log(obj);
            $("#id_local").select2({
              data: obj.data,
          });
            CheckErro("classes/controleCad_extintor.php");
        }
    }).done(function () {
       sleep(1000);
       $("#id_local").val(idl).trigger('change');
   });

    
}


async function Sublocal(){
    //console.log("Função Sublocal!")
    $.ajax({
        url:"classes/controleCad_extintor?acao=ListarSublocal2",
        type: "post",
        dataType: 'JSON', 
        data: {id:idl},         
        success: function (obj) {  
            //console.log(obj); 
            $("#id_sublocal").select2({
                data: obj.data,
            });
            CheckErro("classes/controleCad_extintor.php");//retorna mensagem
        }
    }).done(function () {
       sleep(1000);
       $("#id_sublocal").val(ids).trigger('change');
   });    
}



$("#novo_cadastro").click(function(){ 
    $(".id_modelo").val(null).trigger("change");
    $(".id_orgao").val(null).trigger("change");
    $(".id_local").val(null).trigger("change");
    $(".id_sublocal").val(null).trigger("change");
    $(".codigo").val(null).trigger("change");
    $(".val_casco").val(null).trigger("change");
    $(".val_recarga").val(null).trigger("change");
    $(".obs").val(null).trigger("change");
});


function SelectLocal(id) {
    var pro = new Promise((resolve, reject)=>{
        $.ajax({
            url:"classes/controleCad_extintor.php?acao=ListarLocal2",
            type: "POST",
            dataType: 'JSON', 
            data: {id:id},
            success: function (obj){
                //console.log(obj);
                $("#id_local").html("<option></option>").select2({
                    data: obj.data,
                });
                resolve("concluido");
            }
        })
    })
    return pro
    
}

function SelecSublocal(id) {
    var pro = new Promise((resolve, reject)=>{
        $.ajax({
            url:"classes/controleCad_extintor.php?acao=ListarSublocal2",
            type: "POST",
            dataType: 'JSON', 
            data: {id:id},
            success: function (obj){
                //console.log(obj);
                $("#id_sublocal").html("<option></option>").select2({
                    data: obj.data,
                });
                resolve("concluido");
            }
        })
    })
    return pro
    
}

