<?php

include_once ('Material.class.php');

if(!class_exists("BancodeDados")) {
  include_once 'BancodeDados.class.php';
}

class DAOMaterial
{
    public function inserir($objeto)
    {
        $objeto = array(
		    "idnome_elixo" => $objeto->getIdnome_elixo(),
		    "nome" => $objeto->getNome(),
		    "id_tipo" => $objeto->getId_tipo()
        );
        $sql = "INSERT INTO  material(";
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
            
        $objeto["idnome_elixo"] !== null ? $stmt->bindValue(":idnome_elixo",$objeto["idnome_elixo"]):"";
        $objeto["nome"] !== null ? $stmt->bindValue(":nome",$objeto["nome"]):"";
        $objeto["id_tipo"] !== null ? $stmt->bindValue(":id_tipo",$objeto["id_tipo"]):"";
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
        $stmt = $pdo->query($query == null ? "SELECT * FROM  material" : $query );
        
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
		"idnome_elixo" => $objeto->getIdnome_elixo(),
		"nome" => $objeto->getNome(),
		"id_tipo" => $objeto->getId_tipo()
                );
        $sql = "UPDATE  material SET ";    
        		foreach ($objeto as $key => $value){
		    if ($value !== null && $key !== "idnome_elixo"){
		        $sql = $sql." {$key} = :{$key}, ";
            }
        }
        $sql = $sql."WHERE";
        $p = strpos($sql,'WHERE');
        $p = $p - 2;
        $sql = substr_replace($sql,'',$p);
        $sql = $sql." WHERE idnome_elixo = :idnome_elixo";
        $pdo = new BancodeDados();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":idnome_elixo",$objeto['idnome_elixo']);
        $objeto["idnome_elixo"] !== null ? $stmt->bindValue(":idnome_elixo",$objeto["idnome_elixo"]):"";
        $objeto["nome"] !== null ? $stmt->bindValue(":nome",$objeto["nome"]):"";
        $objeto["id_tipo"] !== null ? $stmt->bindValue(":id_tipo",$objeto["id_tipo"]):"";

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
		$stmt = $pdo->query($query == null ? "DELETE FROM  material WHERE idnome_elixo = {$id}" : $query);
		if(!$stmt->execute()):
			echo "<pre>";
			print_r($stmt->errorInfo());
		else:
			return true;
		endif;
    }
}       