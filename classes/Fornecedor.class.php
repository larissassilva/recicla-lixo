<?php
class Fornecedor
{
    private $idfornecedor;
    private $nome;
    private $Telefone;
    private $whatsapp;
    private $email;
    private $endereco;

    public function getIdfornecedor()
    {
        return $this->idfornecedor;
    }
    
    public function setIdfornecedor($idfornecedor)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $idfornecedor = preg_replace($regra,"",$idfornecedor);
        $this->idfornecedor = $idfornecedor;
    }

    public function getNome()
    {
        return $this->nome;
    }
    
    public function setNome($nome)
    {
        $this->nome = mb_strtoupper($nome, 'UTF-8');
    }

    public function getTelefone()
    {
        return $this->Telefone;
    }
    
    public function setTelefone($Telefone)
    {
        $this->Telefone = mb_strtoupper($Telefone, 'UTF-8');
    }

    public function getWhatsapp()
    {
        return $this->whatsapp;
    }
    
    public function setWhatsapp($whatsapp)
    {
        $this->whatsapp = mb_strtoupper($whatsapp, 'UTF-8');
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = mb_strtoupper($email, 'UTF-8');
    }

    public function getEndereco()
    {
        return $this->endereco;
    }
    
    public function setEndereco($endereco)
    {
        $this->endereco = mb_strtoupper($endereco, 'UTF-8');
    }
}