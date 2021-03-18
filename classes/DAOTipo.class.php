<?php

include_once ('Tipo.class.php');

if(!class_exists("BancodeDados")) {
  include_once "BancodeDados.class.php";
}

class DAOTipo
{
    public function inserir($objeto)
    {
        $objeto = array(
		    "id" => $objeto->getId(),
		    "tipo" => $objeto->getTipo()
        );
        $sql = "INSERT INTO  tipo(";
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
            
        $objeto["id"] !== null ? $stmt->bindValue(":id",$objeto["id"]):"";
        $objeto["tipo"] !== null ? $stmt->bindValue(":tipo",$objeto["tipo"]):"";
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
        $stmt = $pdo->query($query == null ? "SELECT * FROM  tipo" : $query );
        
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
		"id" => $objeto->getId(),
		"tipo" => $objeto->getTipo()
                );
        $sql = "UPDATE  tipo SET ";    
        		foreach ($objeto as $key => $value){
		    if ($value !== null && $key !== "id"){
		        $sql = $sql." {$key} = :{$key}, ";
            }
        }
        $sql = $sql."WHERE";
        $p = strpos($sql,'WHERE');
        $p = $p - 2;
        $sql = substr_replace($sql,'',$p);
        $sql = $sql." WHERE id = :id";
        $pdo = new BancodeDados();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id",$objeto['id']);
        $objeto["id"] !== null ? $stmt->bindValue(":id",$objeto["id"]):"";
        $objeto["tipo"] !== null ? $stmt->bindValue(":tipo",$objeto["tipo"]):"";

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
		$stmt = $pdo->query($query == null ? "DELETE FROM  tipo WHERE id = {$id}" : $query);
		if(!$stmt->execute()):
			echo "<pre>";
			print_r($stmt->errorInfo());
		else:
			return true;
		endif;
    }
}       