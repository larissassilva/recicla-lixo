<?php
class Cad_extintor
{
    private $id;
    private $data;
    private $id_modelo;
    private $codigo;
    private $id_orgao;
    private $id_local;
    private $id_sublocal;
    private $val_recarga;
    private $val_casco;
    private $obs;
    private $status;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $id = preg_replace($regra,"",$id);
        $this->id = $id;
    }

    public function getData()
    {
        return $this->data;
    }
    
    public function setData($data)
    {
        $this->data = $data;
    }

    public function getId_modelo()
    {
        return $this->id_modelo;
    }
    
    public function setId_modelo($id_modelo)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $id_modelo = preg_replace($regra,"",$id_modelo);
        $this->id_modelo = $id_modelo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }
    
    public function setCodigo($codigo)
    {
        $this->codigo = mb_strtoupper($codigo, 'UTF-8');
    }

    public function getId_orgao()
    {
        return $this->id_orgao;
    }
    
    public function setId_orgao($id_orgao)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $id_orgao = preg_replace($regra,"",$id_orgao);
        $this->id_orgao = $id_orgao;
    }

    public function getId_local()
    {
        return $this->id_local;
    }
    
    public function setId_local($id_local)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $id_local = preg_replace($regra,"",$id_local);
        $this->id_local = $id_local;
    }

    public function getId_sublocal()
    {
        return $this->id_sublocal;
    }
    
    public function setId_sublocal($id_sublocal)
    {
        $regra = '/[^a-zA-Z0-9_]/';
        $id_sublocal = preg_replace($regra,"",$id_sublocal);
        $this->id_sublocal = $id_sublocal;
    }

    public function getVal_recarga()
    {
        return $this->val_recarga;
    }
    
    public function setVal_recarga($val_recarga)
    {
        $this->val_recarga = $val_recarga;
    }

    public function getVal_casco()
    {
        return $this->val_casco;
    }
    
    public function setVal_casco($val_casco)
    {
        $this->val_casco = $val_casco;
    }

    public function getObs()
    {
        return $this->obs;
    }
    
    public function setObs($obs)
    {
        $this->obs = mb_strtoupper($obs, 'UTF-8');
    }

    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status)
    {
        $this->status = mb_strtoupper($status, 'UTF-8');
    }
}