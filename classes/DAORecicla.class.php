<?php

include_once ('Recicla.class.php');

if(!class_exists("BancodeDados")) {
  include_once 'BancodeDados.class.php';
}

class DAORecicla
{
    public function inserir($objeto)
    {
        $objeto = array(
		    "idrecicla_elixo" => $objeto->getIdrecicla_elixo(),
		    "funciona" => $objeto->getFunciona(),
		    "valor_compra" => $objeto->getValor_compra(),
		    "valor_venda" => $objeto->getValor_venda(),
		    "data_cadastro" => $objeto->getData_cadastro(),
		    "idnome_elixo" => $objeto->getidnome_elixo(),
		    "idfornecedor" => $objeto->getidfornecedor(),
            "peso" => $objeto->getPeso()
        );
        $sql = "INSERT INTO  recicla(";
        $total = count($objeto);
        $i=0;
        $sql2 = null;   
            foreach ($objeto as $key => $value){
                $i++;
                if ($value !== null){
                    $sql = $i == $total ? $sql."{$key} ) VALUES (" : $sql." {$key}, " ;
                    $sql2 = $i == $total ? $sql2.":{$key} )" : $sql2.":{$key}, " ;
                }elseif ($total == $i) {
                    $sql = $sql." ) VALUES (" ;
                    $sql2 = $sql2." )";
                }
            }
        $sql = $sql.$sql2;
        $sql = preg_replace('/,  \)/',')',$sql);
        $pdo = new BancodeDados();
        $stmt = $pdo->prepare($sql);
            
        $objeto["idrecicla_elixo"] !== null ? $stmt->bindValue(":idrecicla_elixo",$objeto["idrecicla_elixo"]):"";
        $objeto["funciona"] !== null ? $stmt->bindValue(":funciona",$objeto["funciona"]):"";
        $objeto["valor_compra"] !== null ? $stmt->bindValue(":valor_compra",$objeto["valor_compra"]):"";
        $objeto["valor_venda"] !== null ? $stmt->bindValue(":valor_venda",$objeto["valor_venda"]):"";
        $objeto["data_cadastro"] !== null ? $stmt->bindValue(":data_cadastro",$objeto["data_cadastro"]):"";
        $objeto["idnome_elixo"] !== null ? $stmt->bindValue(":idnome_elixo",$objeto["idnome_elixo"]):"";
        $objeto["idfornecedor"] !== null ? $stmt->bindValue(":idfornecedor",$objeto["idfornecedor"]):"";
        $objeto["peso"] !== null ? $stmt->bindValue(":peso",$objeto["peso"]):"";
		if(!$stmt->execute()):
                echo "<pre>";
                print_r($stmt->errorInfo());
            else:
                return true;
            endif;
    }

	public function listarEspecial($query = null)
    {
        $pdo = new BancodeDados();
        $stmt = $pdo->query($query == null ? "SELECT * FROM  recicla" : $query );
        
        if($stmt->rowCount() > 0):
			while($dados = $stmt->fetch(PDO::FETCH_OBJ)){
				$objeto = new stdClass();
				foreach ($dados as $key => $dado){
                    $objeto->$key=$dado;
                }
				$objetos[] = $objeto;
			}
			return $objetos;
        endif;
    }

	public function Editar($objeto)
	{
	$objeto = array(
		"idrecicla_elixo" => $objeto->getIdrecicla_elixo(),
		"funciona" => $objeto->getFunciona(),
		"valor_compra" => $objeto->getValor_compra(),
		"valor_venda" => $objeto->getValor_venda(),
		"data_cadastro" => $objeto->getData_cadastro(),
		"idnome_elixo" => $objeto->getidnome_elixo(),
		"idfornecedor" => $objeto->getidfornecedor(),
        "peso" => $objeto->getPeso()
                );
        $sql = "UPDATE  recicla SET ";    
        		foreach ($objeto as $key => $value){
		    if ($value !== null && $key !== "id"){
		        $sql = $sql." {$key} = :{$key}, ";
            }
        }
        $sql = $sql."WHERE";
        $p = strpos($sql,'WHERE');
        $p = $p - 2;
        $sql = substr_replace($sql,'',$p);
        $sql = $sql." WHERE idrecicla_elixo = :idrecicla_elixo";
        $pdo = new BancodeDados();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":idrecicla_elixo",$objeto['idrecicla_elixo']);
        $objeto["idrecicla_elixo"] !== null ? $stmt->bindValue(":idrecicla_elixo",$objeto["idrecicla_elixo"]):"";
        $objeto["funciona"] !== null ? $stmt->bindValue(":funciona",$objeto["funciona"]):"";
        $objeto["valor_compra"] !== null ? $stmt->bindValue(":valor_compra",$objeto["valor_compra"]):"";
        $objeto["valor_venda"] !== null ? $stmt->bindValue(":valor_venda",$objeto["valor_venda"]):"";
        $objeto["data_cadastro"] !== null ? $stmt->bindValue(":data_cadastro",$objeto["data_cadastro"]):"";
        $objeto["idnome_elixo"] !== null ? $stmt->bindValue(":idnome_elixo",$objeto["idnome_elixo"]):"";
        $objeto["idfornecedor"] !== null ? $stmt->bindValue(":idfornecedor",$objeto["idfornecedor"]):"";
        $objeto["peso"] !== null ? $stmt->bindValue(":peso",$objeto["peso"]):"";

		if(!$stmt->execute()):
			echo "<pre>";
			print_r($stmt->errorInfo());
		else:
			return true;
		endif;
	}
        
	public function Excluir($id,$query=null)
    {
		$pdo = new BancodeDados();
		$stmt = $pdo->query($query == null ? "DELETE FROM  recicla WHERE idrecicla_elixo = {$id}" : $query);
		if(!$stmt->execute()):
			echo "<pre>";
			print_r($stmt->errorInfo());
		else:
			return true;
		endif;
    }
}       