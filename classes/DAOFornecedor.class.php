<?php
include_once ('Fornecedor.class.php');

if(!class_exists("BancodeDados")) {
  include_once 'BancodeDados.class.php';
}

class DAOFornecedor
{
    public function inserir($objeto)
    {
        $objeto = array(
		    "idfornecedor" => $objeto->getIdfornecedor(),
		    "nome" => $objeto->getNome(),
		    "Telefone" => $objeto->getTelefone(),
		    "whatsapp" => $objeto->getWhatsapp(),
		    "email" => $objeto->getEmail(),
		    "endereco" => $objeto->getEndereco()
        );
        $sql = "INSERT INTO  fornecedor(";
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
            
        $objeto["idfornecedor"] !== null ? $stmt->bindValue(":idfornecedor",$objeto["idfornecedor"]):"";
        $objeto["nome"] !== null ? $stmt->bindValue(":nome",$objeto["nome"]):"";
        $objeto["Telefone"] !== null ? $stmt->bindValue(":Telefone",$objeto["Telefone"]):"";
        $objeto["whatsapp"] !== null ? $stmt->bindValue(":whatsapp",$objeto["whatsapp"]):"";
        $objeto["email"] !== null ? $stmt->bindValue(":email",$objeto["email"]):"";
        $objeto["endereco"] !== null ? $stmt->bindValue(":endereco",$objeto["endereco"]):"";
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
        $stmt = $pdo->query($query == null ? "SELECT * FROM  fornecedor" : $query );
        
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
		"idfornecedor" => $objeto->getIdfornecedor(),
		"nome" => $objeto->getNome(),
		"Telefone" => $objeto->getTelefone(),
		"whatsapp" => $objeto->getWhatsapp(),
		"email" => $objeto->getEmail(),
		"endereco" => $objeto->getEndereco()
                );
        $sql = "UPDATE  fornecedor SET ";    
        		foreach ($objeto as $key => $value){
		    if ($value !== null && $key !== "idfornecedor"){
		        $sql = $sql." {$key} = :{$key}, ";
            }
        }
        $sql = $sql."WHERE";
        $p = strpos($sql,'WHERE');
        $p = $p - 2;
        $sql = substr_replace($sql,'',$p);
        $sql = $sql." WHERE idfornecedor = :idfornecedor";
        $pdo = new BancodeDados();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":idfornecedor",$objeto['idfornecedor']);
        $objeto["idfornecedor"] !== null ? $stmt->bindValue(":idfornecedor",$objeto["idfornecedor"]):"";
        $objeto["nome"] !== null ? $stmt->bindValue(":nome",$objeto["nome"]):"";
        $objeto["Telefone"] !== null ? $stmt->bindValue(":Telefone",$objeto["Telefone"]):"";
        $objeto["whatsapp"] !== null ? $stmt->bindValue(":whatsapp",$objeto["whatsapp"]):"";
        $objeto["email"] !== null ? $stmt->bindValue(":email",$objeto["email"]):"";
        $objeto["endereco"] !== null ? $stmt->bindValue(":endereco",$objeto["endereco"]):"";

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
		$stmt = $pdo->query($query == null ? "DELETE FROM  fornecedor WHERE idfornecedor = {$id}" : $query);
		if(!$stmt->execute()):
			echo "<pre>";
			print_r($stmt->errorInfo());
		else:
			return true;
		endif;
    }
}       