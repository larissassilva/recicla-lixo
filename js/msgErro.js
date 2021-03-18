/**
 * Created by MURILO.BARROSO on 07/12/2017.
 */
function ResetModal(modal,from = null) { // fecha a modal e limpa o formulario
    var F_ResetModal = new Promise((resolve, reject) => {
    if (modal == undefined || modal == '') {
        reject("Não foi informado o nome da modal")
    }else{
        CheckErro("classes/controleLocal.php");
        $("#"+modal).modal('toggle');
        if (from == null || from == '') {
            if (from == '') {
                reject("Não foi informado o id do formulario");
            }
        }else{
            $.each($("#"+from)[0], function (key, value) {
                if ($(this)[0].checked) {
                    $(this).prop( "checked", false);
                }else{
                    $(this).val(null).trigger("change");
                }
            });
        }
        resolve("concluido")
    }
})
return F_ResetModal
} 

/** função para disabilitar todos os campos */
// function disable(forms ,lista = null) {
//     var pro = new Promise((resolve, reject)=>{
//         if (lista == null) {
//             $.each(lista, function (key, value) { 
//                 $.each($("#"+forms)[0], function (keyf, valuef) {
//                     console.log(valuef)
//                 });
//             });
//         }else{
//             $.each(forms, function (key, value) { 
//                 $.each($("#"+value)[0], function (keyf, valuef) {
//                     $(this).prop( "disabled", true);
//                 });
//             });
//         }
//     })
//     return pro
// }

function CheckErro(url)
{
    $.ajax({
        url: url,
        type: 'POST',
        data: {acao: 'CheckErro'},
        dataType: 'json',
        success: function (result) {
            /*if (result.tipo == 0) {
                alertify.success(result.msg);
            } else {
                alertify.alert(result.msg);
            }*/
            switch(result.tipo){
                case 0:
                    alertify.success(result.msg);
                    break;
                case 1:
                    alertify.alert(result.msg);
                    break;
                case 2:
                    alertify.alert(result.msg);
                    break;
            }
        }
    });
}

function CheckErroNo(result) {
    if (result.tipo == 0) {
        alertify.success(result.msg);
    } else {
        alertify.alert(result.msg);
    }
}
