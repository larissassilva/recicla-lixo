<?php
include_once ('Fornecedor.class.php');
include_once ('DAOFornecedor.class.php');
session_start();


if (isset($_GET['acao'])) {
    $_POST['acao'] = $_GET['acao'];
}

if (isset($_POST["acao"])) {

    $funcao = new ControleFornecedor();

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
        
        case "Mostrar":
        $funcao->Mostrar();
        break;

        case "Listar2":
        $funcao->Listar2();
        break;

        case "Listar":
        $funcao->Listar();
        break;
    }
}

class ControleFornecedor
{
	public function Editar()
	{
		$objeto = new Fornecedor();
		isset($_POST["idfornecedor"])?$objeto->setIdfornecedor($_POST["idfornecedor"]):null;
		isset($_POST["nome"])?$objeto->setNome($_POST["nome"]):null;
		isset($_POST["Telefone"])?$objeto->setTelefone($_POST["Telefone"]):null;
		isset($_POST["whatsapp"])?$objeto->setWhatsapp($_POST["whatsapp"]):null;
		isset($_POST["email"])?$objeto->setEmail($_POST["email"]):null;
		isset($_POST["endereco"])?$objeto->setEndereco($_POST["endereco"]):null;

		$dao = new DAOFornecedor();
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
        $objeto = new Fornecedor();
		isset($_POST["nome"])?$objeto->setNome($_POST["nome"]):null;
		isset($_POST["Telefone"])?$objeto->setTelefone($_POST["Telefone"]):null;
		isset($_POST["whatsapp"])?$objeto->setWhatsapp($_POST["whatsapp"]):null;
		isset($_POST["email"])?$objeto->setEmail($_POST["email"]):null;
		isset($_POST["endereco"])?$objeto->setEndereco($_POST["endereco"]):null;

        $dao = new DAOFornecedor();
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
                $dao = new DAOFornecedor();
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
		$dao = new DAOFornecedor();
        $lista['data'] = $dao->listarEspecial('SELECT * FROM  fornecedor');
        echo json_encode($lista);
    }

        public function Listar2()
    {
        $dao = new DAOFornecedor();
        $lista['data'] = $dao->listarEspecial('SELECT idfornecedor as idfornecedor,nome as nome, email as email FROM  fornecedor');
        echo json_encode($lista);
    }

public function Mostrar()
{
    $dao = new DAOFornecedor();
    
    $id2=$_POST["id2"];
    $lista = $dao->listarEspecial("SELECT nome as nome,  Telefone as Telefone, whatsapp as whatsapp, email as email, endereco as endereco FROM fornecedor WHERE idfornecedor={$id2}");
        //echo json_encode($lista);
    $l='';
    foreach ($lista as $key => $value) {
        $l[]=array(
            'nome' =>$value->nome,
            'Telefone' =>$value->Telefone,
            'whatsapp' =>$value->whatsapp,
            'email' =>$value->email,
            'endereco' =>$value->endereco,);
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