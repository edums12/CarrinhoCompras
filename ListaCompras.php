<?php

class ListaCompras 
{
    // Atributos
    private $_firstItemAdd = NULL;

    private $_lastItemAdd = NULL;

    private $_valorTotal = 0;

    private $_size = 0;


    public $isEmpty = TRUE;

    // Propriedades
    public function GetAll()
    {
        $list = new StdClass();

        $list->produtos = array();

        $list->quantidadeItems = $this->_size;

        $list->valorTotal = number_format( $this->_valorTotal, 2, ',', '.' );
        
        if( ! $this->isEmpty )
        {
            $item = $this->_firstItemAdd->prod;

            while ( !empty( $item ) )
            {
                $listItem = $item->GetProd();

                $listItem->quantidade = $item->quantidade;

                $listItem->valorTotalItem = $item->valorTotalItem;

                $list->produtos[] = $listItem;

                $item = $item->GetNext();
            }
        }

        return $list;
    }

    public function GetSize()
    {
        return $this->_size;
    }

    public function GetValorTotal()
    {
        return $this->_valorTotal;
    }

    // Métodos
    public function Add($pProd, $pQuantidade = 1)
    {
        $item = new StdClass();

        if( $pProd->isKit() )
        {
            foreach ($pProd->GetKit() as $key => $prod) {
                $this->Add($prod);
            }
        }
        else
        {
            $item->prod = $pProd;
            
            $item->prod->quantidade = $pQuantidade;
            
            $item->prod->valorTotalItem = $pQuantidade * $item->prod->GetValue();
            
            if ( $this->isEmpty )
            {
                $this->_firstItemAdd = $item;
                
                $this->isEmpty = FALSE;            
            }
            else
            {
                $item->prod->SetPrev($this->_lastItemAdd);
                
                $this->_lastItemAdd->prod->SetNext($item->prod);
            }
            
            $this->_size += 1;
            
            $this->UpdateValorTotal();
            
            $this->_lastItemAdd = $item;
        }
    }

    private function UpdateValorTotal()
    {
        $itemsList = $this->GetAll();

        $this->_valorTotal = 0;

        foreach ($itemsList->produtos as $key => $item) {
            $this->_valorTotal += $item->valorTotalItem;
        }
    }

}