<?php
class Recicla
{
    private $idrecicla_elixo;
    private $funciona;
    private $valor_compra;
    private $valor_venda;
    private $data_cadastro;
    private $idnome_elixo;
    private $idfornecedor;
    private $peso;

    public function getIdrecicla_elixo()
    {
        return $this->idrecicla_elixo;
    }
    
    public function setIdrecicla_elixo($idrecicla_elixo)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $idrecicla_elixo = preg_replace($regra,"",$idrecicla_elixo);
        $this->idrecicla_elixo = $idrecicla_elixo;
    }

    public function getFunciona()
    {
        return $this->funciona;
    }
    
    public function setFunciona($funciona)
    {
        $this->funciona = mb_strtoupper($funciona, 'UTF-8');
    }

    public function getValor_compra()
    {
        return $this->valor_compra;
    }
    
    public function setValor_compra($valor_compra)
    {
        $this->valor_compra = $valor_compra;
    }

    public function getValor_venda()
    {
        return $this->valor_venda;
    }
    
    public function setValor_venda($valor_venda)
    {
        $this->valor_venda = $valor_venda;
    }

    public function getData_cadastro()
    {
        return $this->data_cadastro;
    }
    
    public function setData_cadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;
    }

    public function getidnome_elixo()
    {
        return $this->idnome_elixo;
    }
    
    public function setidnome_elixo($idnome_elixo)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $idnome_elixo = preg_replace($regra,"",$idnome_elixo);
        $this->idnome_elixo = $idnome_elixo;
    }

    public function getidfornecedor()
    {
        return $this->idfornecedor;
    }
    
    public function setidfornecedor($idfornecedor)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $idfornecedor = preg_replace($regra,"",$idfornecedor);
        $this->idfornecedor = $idfornecedor;
    }
    public function getPeso()
    {
        return $this->peso;
    }
    
    public function setPeso($peso)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $peso = preg_replace($regra,"",$peso);
        $this->peso = $peso;
    }
}