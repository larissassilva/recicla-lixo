<?php
include_once ('Material.class.php');
include_once ('DAOMaterial.class.php');
session_start();


if (isset($_GET['acao'])) {
    $_POST['acao'] = $_GET['acao'];
}

if (isset($_POST["acao"])) {

    $funcao = new ControleMaterial();

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

        case "Listar2":
        $funcao->Listar2();
        break;
        
        case "Listar":
        $funcao->Listar();
        break;

        case "Mostrar":
        $funcao->Mostrar();
        break;
    }
}

class ControleMaterial
{
	public function Editar()
	{
		$objeto = new Material();
		isset($_POST["idnome_elixo"])?$objeto->setIdnome_elixo($_POST["idnome_elixo"]):null;
		isset($_POST["nome"])?$objeto->setNome($_POST["nome"]):null;
		isset($_POST["id_tipo"])?$objeto->setId_tipo($_POST["id_tipo"]):null;

		$dao = new DAOMaterial();
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
        $objeto = new Material();
		isset($_POST["nome"])?$objeto->setNome($_POST["nome"]):null;
		isset($_POST["id_tipo"])?$objeto->setId_tipo($_POST["id_tipo"]):null;

        $dao = new DAOMaterial();
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
                $dao = new DAOMaterial();
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
		$dao = new DAOMaterial();
        $lista['data'] = $dao->listarEspecial('SELECT * FROM  material');
        echo json_encode($lista);
    }
        public function Listar2()
    {
        $dao = new DAOMaterial();
        $lista['data'] = $dao->listarEspecial('SELECT m.idnome_elixo as id, m.nome as nome, o.tipo as tipo FROM tipo as o, material as m WHERE id_tipo=o.id');

        echo json_encode($lista);
    }

    public function Mostrar()
{
    $dao = new DAOMaterial();
    
    $id=$_POST["id"];
    $lista = $dao->listarEspecial("SELECT nome as nome, o.id as tipo FROM tipo as o, material WHERE id_tipo=o.id and idnome_elixo={$id}");
        //echo json_encode($lista);
    $l='';
    foreach ($lista as $key => $value) {
        $l[]=array(
            'tipo' =>$value->tipo,
            'nome' =>$value->nome,);
    }
    echo json_encode($l);
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