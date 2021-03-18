<?php
class Material
{
    private $idnome_elixo;
    private $nome;
    private $id_tipo;

    public function getIdnome_elixo()
    {
        return $this->idnome_elixo;
    }
    
    public function setIdnome_elixo($idnome_elixo)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $idnome_elixo = preg_replace($regra,"",$idnome_elixo);
        $this->idnome_elixo = $idnome_elixo;
    }

    public function getNome()
    {
        return $this->nome;
    }
    
    public function setNome($nome)
    {
        $this->nome = mb_strtoupper($nome, 'UTF-8');
    }

    public function getId_tipo()
    {
        return $this->id_tipo;
    }
    
    public function setId_tipo($id_tipo)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $id_tipo = preg_replace($regra,"",$id_tipo);
        $this->id_tipo = $id_tipo;
    }
}