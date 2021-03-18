<?php
include_once ('Cad_extintor.class.php');
include_once ('DAOCad_extintor.class.php');
session_start();


if (isset($_GET['acao'])) {
    $_POST['acao'] = $_GET['acao'];
}

if (isset($_POST["acao"])) {

    $funcao = new ControleCad_extintor();

    switch ($_POST["acao"]) {
        case "Editar":
        $funcao->Editar();
        break;
        
        case "Inserir":
        $funcao->Inserir();
        break;
        
        case "Excluir":
        $funcao->Excluir();
        break;
        
        case "CheckErro":
        $funcao->CheckErro();
        break;

        case "MostrarExtintor":
        $funcao->MostrarExtintor();
        break;

        case "ListarTabelaExtintor":
        $funcao->ListarTabelaExtintor();
        break;

        case "ListarModelo":
        $funcao->ListarModelo();
        break;

        case "ListarIdOrgao":
        $funcao->ListarIdOrgao();
        break;

        case "ListarLocal":
        $funcao->ListarLocal();
        break;

        case "ListarSublocal":
        $funcao->ListarSublocal();
        break;

        case "ListarLocal2":
        $funcao->ListarLocal();
        break;

        case "ListarSublocal2":
        $funcao->ListarSublocal();
        break;

        case "ListarDuplicado":
        $funcao->ListarDuplicado();
        break;
        
        case "Listar":
        $funcao->Listar();
        break;

        case "Select":
        $funcao->Select();
        break;

        case 'SelectId_local':
        $funcao->SelectId_local();
        break;
    }
}

class ControleCad_extintor
{
	public function Editar()
	{
		$objeto = new Cad_extintor();
		isset($_POST["id"])?$objeto->setId($_POST["id"]):null;
		isset($_POST["data"])?$objeto->setData($_POST["data"]):null;
		isset($_POST["id_modelo2"])?$objeto->setId_modelo($_POST["id_modelo2"]):null;
		isset($_POST["codigo"])?$objeto->setCodigo($_POST["codigo"]):null;
		isset($_POST["id_orgao"])?$objeto->setId_orgao($_POST["id_orgao"]):null;
		isset($_POST["id_local"])?$objeto->setId_local($_POST["id_local"]):null;
		isset($_POST["id_sublocal"])?$objeto->setId_sublocal($_POST["id_sublocal"]):null;
		isset($_POST["val_recarga2"])?$objeto->setVal_recarga($_POST["val_recarga2"]):null;
		isset($_POST["val_casco2"])?$objeto->setVal_casco($_POST["val_casco2"]):null;
		isset($_POST["obs"])?$objeto->setObs($_POST["obs"]):null;
		isset($_POST["status"])?$objeto->setStatus($_POST["status"]):null;

		$dao = new DAOCad_extintor();
        $editar = $dao->Editar($objeto);
        if ($editar) {
         $_SESSION['msg_erro'] = array(
									       'tipo' => 0, //quando a mensagem for positiva
									       'msg' => "Editado com sucesso"
                                       );
     } else {
         $_SESSION['msg_erro'] = array(
										   'tipo' => 1, //quando a mensagem e negativa
										   'msg' => "Erro ao Editar"
                                        );
     }
 }

 public function Inserir()
 {
    $objeto = new Cad_extintor();
    isset($_POST["data"])?$objeto->setData($_POST["data"]):null;
    isset($_POST["id_modelo"])?$objeto->setId_modelo($_POST["id_modelo"]):null;
    isset($_POST["codigo"])?$objeto->setCodigo($_POST["codigo"]):null;
    isset($_POST["id_orgao"])?$objeto->setId_orgao($_POST["id_orgao"]):null;
    isset($_POST["id_local"])?$objeto->setId_local($_POST["id_local"]):null;
    if(isset($_POST["id_sublocal"]) && $_POST["id_sublocal"] !== ''){
        $objeto->setId_sublocal($_POST["id_sublocal"]);
    }
    isset($_POST["val_recarga2"])?$objeto->setVal_recarga($_POST["val_recarga2"]):null;
    isset($_POST["val_casco2"])?$objeto->setVal_casco($_POST["val_casco2"]):null;
    isset($_POST["obs"])?$objeto->setObs($_POST["obs"]):null;
    isset($_POST["status"])?$objeto->setStatus($_POST["status"]):null;

    $dao = new DAOCad_extintor();
    $inserir = $dao->Inserir($objeto);

    if ($inserir){
        $_SESSION['msg_erro'] = array(
                                           'tipo' => 0, //quando a mensagem for positiva
                                           'msg' => "Cadastrado Com sucesso"
                                       );
    } else {
     $_SESSION['msg_erro'] = array(
                                          'tipo' => 1, //quando a mensagem e negativa
                                          'msg' => "Erro no Cadastro"
                                      );
 }
}

public function Excluir()
{
    $dao = new DAOCad_extintor();
    $delete = $dao->Excluir($_POST['id']);
    if ($delete == true){
        $_SESSION['msg_erro'] = array(
                                                  'tipo' => 0, //quando a mensagem e positiva
                                                  'msg' => "Excluido Com sucesso"
                                              );
    } else {
        $_SESSION['msg_erro'] = array(
                                                  'tipo' => 1, //quando a mensagem e negativa
                                                  'msg' => "Erro ao Excluir"
                                              );
    }
}

public function ListarTabelaExtintor()
{
    $dao = new DAOCad_extintor();
    $lista['data'] = $dao->listarEspecial("SELECT e.id, m.nome as modelo,e.codigo,l.nome as local, s.nome as sublocal, date_format(e.val_recarga, '%d/%m/%Y') as val_recarga, date_format(e.val_casco, '%Y') as val_casco, e.status as status 
                                            FROM ss_cad_extintor e
                                            INNER JOIN ss_modelo m on m.id = e.id_modelo
                                            INNER JOIN ss_local l on l.id = e.id_local 
                                            LEFT JOIN ss_sublocal s on s.id = e.id_sublocal");
    $lista['data'] = $lista['data'] == null ? '' : $lista['data'];
    echo json_encode($lista);
}

public function MostrarExtintor()
{
    $dao = new DAOCad_extintor();
    
    $id=$_POST["id"];
    $lista = $dao->listarEspecial("SELECT date_format(e.data, '%d/%m/%Y') as data, m.id as id_modelo,e.codigo as codigo,o.id as id_orgao, l.id as id_local, s.id as id_sublocal, date_format(e.val_recarga, '%d/%m/%Y') as val_recarga, date_format(e.val_casco, '%Y') as val_casco,e.obs as obs, e.status as status 
                                    FROM ss_cad_extintor e
                                    INNER JOIN ss_modelo m on m.id = e.id_modelo 
                                    INNER JOIN ss_local l on l.id = e.id_local 
                                    LEFT JOIN ss_sublocal s on s.id_local = e.id_local
                                    INNER JOIN di_orgao o on o.id = e.id_orgao
                                    WHERE e.id={$id}");
        //echo json_encode($lista);
    $l='';
    foreach ($lista as $key => $value) {
        $l[]=array(
            'data' =>$value->data,
            'id_modelo' =>$value->id_modelo,
            'codigo' =>$value->codigo,
            'id_orgao' =>$value->id_orgao,
            'id_local' =>$value->id_local,
            'id_sublocal' =>$value->id_sublocal,
            'val_recarga' =>$value->val_recarga,
            'val_casco' =>$value->val_casco,
            'obs' =>$value->obs,
            'status' =>$value->status,);
    }
    echo json_encode($l);
}

public function ListarDuplicado()
{
    $dao = new DAOCad_extintor();
    $codigo=$_POST["codigo"];
    $lista= $dao->listarEspecial("SELECT id FROM ss_cad_extintor WHERE codigo='$codigo'");
    //echo json_encode ($lista[0]);
    if($lista[0]==null){
      echo json_encode (0);
    }else{
      echo json_encode ($lista[0]);
    }
    

}

public function ListarModelo()
{
    $dao = new DAOCad_extintor();
    $lista['data'] = $dao->listarEspecial5("SELECT id, nome AS text FROM ss_modelo WHERE tipo=3 ORDER BY text");
    echo json_encode($lista);
}

public function ListarIdOrgao()
{
    $dao = new DAOCad_extintor();
    $lista['data'] = $dao->listarEspecial2('SELECT id, nome AS text FROM di_orgao ORDER BY text');
    echo json_encode($lista);
}

public function ListarLocal()
{
    $dao = new DAOCad_extintor();
    $id=$_POST["id"];
    $lista['data'] = $dao->listarEspecial3("SELECT id, nome AS text FROM ss_local WHERE id_orgao={$id} ORDER BY text");// aspas simples o inteiro vira string e aspas duplas op sql interpreta a variavél
    //var_dump($lista);
    echo json_encode($lista);
}

public function ListarSublocal()
{
    $dao = new DAOCad_extintor();
    $id=$_POST["id"];
    $lista['data'] = $dao->listarEspecial4("SELECT id, nome AS text FROM ss_sublocal WHERE id_local={$id} ORDER BY text");
    echo json_encode($lista);
}

public function ListarLocal2()
{
    $dao = new DAOCad_extintor();
    $id=$_POST["id"];
    $lista['data'] = $dao->listarEspecial3("SELECT id, nome AS text FROM ss_local WHERE id_orgao={$id}");// aspas simples o inteiro vira string e aspas duplas op sql interpreta a variavél
    //var_dump($lista);
    echo json_encode($lista);
}

public function ListarSublocal2()
{
    $dao = new DAOCad_extintor();
    $id=$_POST["id"];
    $lista['data'] = $dao->listarEspecial4("SELECT id, nome AS text FROM ss_sublocal id_local={$id}");
    echo json_encode($lista);
}

public function Listar()
{
  $dao = new DAOCad_extintor();
  $lista['data'] = $dao->listarEspecial('SELECT * FROM ss_cad_extintor');
  echo json_encode($lista);
}

public function Select()
{
    $dao = new DAOCad_extintor();
    $lista = $dao->listarEspecial("SELECT ce.id, CONCAT(M.nome,' | ',ce.codigo) as text FROM ss_cad_extintor ce
                                    INNER JOIN ss_modelo m on ce.id_modelo = m.id
                                    WHERE ce.id_sublocal = {$_POST['id']}"); 
    echo json_encode($lista);
}

public function SelectId_local()
{
    $dao = new DAOCad_extintor();
    $lista = $dao->listarEspecial("SELECT ce.id, CONCAT(M.nome,' | ',ce.codigo) as text FROM ss_cad_extintor ce
                                    INNER JOIN ss_modelo m on ce.id_modelo = m.id
                                    WHERE ce.id_local = {$_POST['id']}"); 
    echo json_encode($lista);
}

public function CheckErro()
{
    if (isset($_SESSION['msg_erro']))
    {
        echo json_encode($_SESSION['msg_erro']);
        unset($_SESSION['msg_erro']); 
    }
}
}
?>