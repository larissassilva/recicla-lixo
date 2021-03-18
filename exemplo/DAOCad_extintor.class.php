<?php

include_once ('Cad_extintor.class.php');

if(!class_exists("BancodeDados")) {
  include_once (dirname( __FILE__ )).'/classes/BancodeDados.class.php';
}

class DAOCad_extintor
{
    public function inserir($objeto)
    {
        $objeto = array(
		    "id" => $objeto->getId(),
		    "data" => $objeto->getData(),
		    "id_modelo" => $objeto->getId_modelo(),
		    "codigo" => $objeto->getCodigo(),
		    "id_orgao" => $objeto->getId_orgao(),
		    "id_local" => $objeto->getId_local(),
		    "id_sublocal" => $objeto->getId_sublocal(),
		    "val_recarga" => $objeto->getVal_recarga(),
		    "val_casco" => $objeto->getVal_casco(),
		    "obs" => $objeto->getObs(),
		    "status" => $objeto->getStatus()
        );
        $sql = "INSERT INTO ss_cad_extintor(";
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
            
        $objeto["data"] !== null ? $stmt->bindValue(":data",$objeto["data"]):"";
        $objeto["id_modelo"] !== null ? $stmt->bindValue(":id_modelo",$objeto["id_modelo"]):"";
        $objeto["codigo"] !== null ? $stmt->bindValue(":codigo",$objeto["codigo"]):"";
        $objeto["id_orgao"] !== null ? $stmt->bindValue(":id_orgao",$objeto["id_orgao"]):"";
        $objeto["id_local"] !== null ? $stmt->bindValue(":id_local",$objeto["id_local"]):"";
        $objeto["id_sublocal"] !== null ? $stmt->bindValue(":id_sublocal",$objeto["id_sublocal"]):"";
        $objeto["val_recarga"] !== null ? $stmt->bindValue(":val_recarga",$objeto["val_recarga"]):"";
        $objeto["val_casco"] !== null ? $stmt->bindValue(":val_casco",$objeto["val_casco"]):"";
        $objeto["obs"] !== null ? $stmt->bindValue(":obs",$objeto["obs"]):"";
        $objeto["status"] !== null ? $stmt->bindValue(":status",$objeto["status"]):"";
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
        $stmt = $pdo->query($query == null ? "SELECT * FROM ss_cad_extintor" : $query );
        
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

        public function listarEspecial2($query = null)
    {
        $pdo = new BancodeDados();
        $stmt = $pdo->query($query == null ? "SELECT * FROM di_orgao" : $query );
        
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

        public function listarEspecial3($query = null)
    {
        $pdo = new BancodeDados();
        $stmt = $pdo->query($query == null ? "SELECT * FROM ss_local" : $query );
        
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

        public function listarEspecial4($query = null)
    {
        $pdo = new BancodeDados();
        $stmt = $pdo->query($query == null ? "SELECT * FROM ss_sublocal" : $query );
        
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

        public function listarEspecial5($query = null)
    {
        $pdo = new BancodeDados();
        $stmt = $pdo->query($query == null ? "SELECT * FROM ss_modelo" : $query );
        
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
		"data" => $objeto->getData(),
		"id_modelo" => $objeto->getId_modelo(),
		"codigo" => $objeto->getCodigo(),
		"id_orgao" => $objeto->getId_orgao(),
		"id_local" => $objeto->getId_local(),
		"id_sublocal" => $objeto->getId_sublocal(),
		"val_recarga" => $objeto->getVal_recarga(),
		"val_casco" => $objeto->getVal_casco(),
		"obs" => $objeto->getObs(),
		"status" => $objeto->getStatus()
                );
        $sql = "UPDATE ss_cad_extintor SET ";    
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
        $objeto["data"] !== null ? $stmt->bindValue(":data",$objeto["data"]):"";
        $objeto["id_modelo"] !== null ? $stmt->bindValue(":id_modelo",$objeto["id_modelo"]):"";
        $objeto["codigo"] !== null ? $stmt->bindValue(":codigo",$objeto["codigo"]):"";
        $objeto["id_orgao"] !== null ? $stmt->bindValue(":id_orgao",$objeto["id_orgao"]):"";
        $objeto["id_local"] !== null ? $stmt->bindValue(":id_local",$objeto["id_local"]):"";
        $objeto["id_sublocal"] !== null ? $stmt->bindValue(":id_sublocal",$objeto["id_sublocal"]):"";
        $objeto["val_recarga"] !== null ? $stmt->bindValue(":val_recarga",$objeto["val_recarga"]):"";
        $objeto["val_casco"] !== null ? $stmt->bindValue(":val_casco",$objeto["val_casco"]):"";
        $objeto["obs"] !== null ? $stmt->bindValue(":obs",$objeto["obs"]):"";
        $objeto["status"] !== null ? $stmt->bindValue(":status",$objeto["status"]):"";

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
		$stmt = $pdo->query($query == null ? "DELETE FROM ss_cad_extintor WHERE id = {$id}" : $query);
		if(!$stmt->execute()):
			echo "<pre>";
			print_r($stmt->errorInfo());
		else:
			return true;
		endif;
    }
}       