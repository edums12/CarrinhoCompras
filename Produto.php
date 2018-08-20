<?php

class Produto
{   
    // Atributos
    private $_idProduto = 0;

    private $_name = NULL;

    private $_description = NULL;

    private $_kit = NULL;

    private $_value = 0.00;

    private $_prev = NULL;

    private $_next = NULL;


    // Propriedades
    public function GetValue()
    {
        return $this->_value;
    }

    public function GetId()
    {
        return $this->_idProduto;
    }

    public function GetProd()
    {
        $prod = new StdClass();

        $prod->id = $this->_idProduto;

        $prod->name = $this->_name;

        $prod->descrption = $this->_description;

        $prod->value = $this->_value;

        return $prod;
    }

    public function isKit()
    {
        if( !is_null($this->_kit) )
            return TRUE;

        return FALSE;
    }

    public function GetKit()
    {
        return (object) $this->_kit;
    }

    public function SetPrev($pProd)
    {
        $this->_prev = $pProd;
    }

    public function SetNext($pProd)
    {
        $this->_next = $pProd;
    }

    public function GetPrev()
    {
        return $this->_prev;
    }

    public function GetNext()
    {
        return $this->_next;
    }

    // Métodos
    public function __construct($pIdProduto, $pNome, $pDescription, $pValue, $pKit = NULL, $pPrev = NULL, $pNext = NULL)
    {
        $this->_idProduto = $pIdProduto;

        $this->_name = $pNome;
        
        $this->_description = $pDescription;

        $this->_value = $pValue;

        if ( !is_null($pKit) )
            $this->_kit = $pKit;

        if( !is_null($pPrev) )
            $this->SetPrev( $pPrev );
        
        if( !is_null($pNext) )
            $this->SetNext( $pNext );
    }
}