<?php
include_once ('Tipo.class.php');
include_once ('DAOTipo.class.php');
session_start();

if (isset($_GET['acao'])) {
    $_POST['acao'] = $_GET['acao'];
}

if (isset($_POST["acao"])) {

    $funcao = new ControleTipo();

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
        
        case "Listar":
        $funcao->Listar();
        break;

        case "ListarMaterial":
        $funcao->ListarMaterial();
        break;

        case "Mostrar":
        $funcao->Mostrar();
        break;
    }
}

class ControleTipo
{
	public function Editar()
	{
		$objeto = new Tipo();
		isset($_POST["id"])?$objeto->setId($_POST["id"]):null;
		isset($_POST["tipo"])?$objeto->setTipo($_POST["tipo"]):null;

		$dao = new DAOTipo();
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
        $objeto = new Tipo();
		isset($_POST["tipo"])?$objeto->setTipo($_POST["tipo"]):null;

        $dao = new DAOTipo();
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
                $dao = new DAOTipo();
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

	public function Listar()
    {
		$dao = new DAOTipo();
        $lista['data'] = $dao->listarEspecial('SELECT * FROM  tipo');
        echo json_encode($lista);
    }

public function ListarMaterial()
    {
        $dao = new DAOTipo();
    $lista['data'] = $dao->listarEspecial('SELECT id, tipo AS text FROM tipo ORDER BY text');
    echo json_encode($lista);
}

public function Mostrar()
{
    $dao = new DAOTipo();
    
    $id=$_POST["id"];
    $lista = $dao->listarEspecial("SELECT tipo FROM tipo WHERE id={$id}");
        //echo json_encode($lista);
    $l='';
    foreach ($lista as $key => $value) {
        $l[]=array(
            'tipo' =>$value->tipo,);
    }
    echo json_encode($l);
}

/*$id=$_POST["id"];
$id=$_POST["tipo"];
  $lista = $dao->query(Update tipo  set tipo = {'$tipo'} WHERE id={$id}*/
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