<?php
class Tipo
{
    private $id;
    private $tipo;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $idtipo_elixo = preg_replace($regra,"",$id);
        $this->id = $id;
    }

    public function getTipo()
    {
        return $this->tipo;
    }
    
    public function setTipo($tipo)
    {
        $this->tipo = mb_strtoupper($tipo, 'UTF-8');
    }
}