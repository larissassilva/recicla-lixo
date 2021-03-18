<?php
include_once ('Recicla.class.php');
include_once ('DAORecicla.class.php');
session_start();


if (isset($_GET['acao'])) {
    $_POST['acao'] = $_GET['acao'];
}

if (isset($_POST["acao"])) {

    $funcao = new ControleRecicla();

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

class ControleRecicla
{
	public function Editar()
	{
		$objeto = new Recicla();
		isset($_POST["idrecicla_elixo"])?$objeto->setIdrecicla_elixo($_POST["idrecicla_elixo"]):null;
		isset($_POST["funciona"])?$objeto->setFunciona($_POST["funciona"]):null;
		isset($_POST["valor_compra"])?$objeto->setValor_compra($_POST["valor_compra"]):null;
		isset($_POST["valor_venda"])?$objeto->setValor_venda($_POST["valor_venda"]):null;
		isset($_POST["data_cadastro"])?$objeto->setData_cadastro($_POST["data_cadastro"]):null;
		isset($_POST["idnome_elixo"])?$objeto->setidnome_elixo($_POST["idnome_elixo"]):null;
		isset($_POST["idfornecedor"])?$objeto->setidfornecedor($_POST["idfornecedor"]):null;
        isset($_POST["peso"])?$objeto->setPeso($_POST["peso"]):null;

		$dao = new DAORecicla();
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
        $objeto = new Recicla();
		isset($_POST["funciona"])?$objeto->setFunciona($_POST["funciona"]):null;
		isset($_POST["valor_compra"])?$objeto->setValor_compra($_POST["valor_compra"]):null;
		isset($_POST["valor_venda"])?$objeto->setValor_venda($_POST["valor_venda"]):null;
		isset($_POST["data_cadastro"])?$objeto->setData_cadastro($_POST["data_cadastro"]):null;
		isset($_POST["idnome_elixo"])?$objeto->setidnome_elixo($_POST["idnome_elixo"]):null;
		isset($_POST["idfornecedor"])?$objeto->setidfornecedor($_POST["idfornecedor"]):null;
        isset($_POST["peso"])?$objeto->setPeso($_POST["peso"]):null;

        $dao = new DAORecicla();
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
                $dao = new DAORecicla();
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
		$dao = new DAORecicla();
        $lista['data'] = $dao->listarEspecial('SELECT * FROM  recicla');
        echo json_encode($lista);
    }

    public function Listar2()
    {
        $dao = new DAORecicla();
        $lista['data'] = $dao->listarEspecial('SELECT r.idrecicla_elixo as id, r.funciona as funciona, r.valor_compra, r.data_cadastro, r.idfornecedor, r.idnome_elixo, m.nome as material, r.peso FROM recicla as r,material as m WHERE r.idnome_elixo=m.idnome_elixo
');

        echo json_encode($lista);
    }

    public function Mostrar()
{
    $dao = new DAORecicla();
    
    $id=$_POST["id"];
    $lista = $dao->listarEspecial("SELECT r.funciona as funciona, r.valor_compra as valorcompra, r.valor_venda as valorvenda, r.data_cadastro as data, r.idfornecedor as fornecedor, r.idnome_elixo as material,m.id_tipo, t.id as tipo, r.peso as peso from recicla as r, material as m, tipo as t WHERE m.id_tipo=t.id and r.idrecicla_elixo={$id}");
        //echo json_encode($lista);
    $l='';
    foreach ($lista as $key => $value) {
        $l[]=array(
            'funciona' =>$value->funciona,
            'valorcompra' =>$value->valorcompra,
            'valorvenda' =>$value->valorvenda,
            'data' =>$value->data,
            'tipo' =>$value->tipo,
            'material' =>$value->material,
            'fornecedor' =>$value->fornecedor,
            'peso' =>$value->peso,);
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