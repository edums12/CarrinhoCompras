<?php 

class Funcoes
{

    public static function findProd($pArray, $pId)
    {
        foreach ($pArray as $key => $prod) {
            if( $prod->GetId() == $pId )
            {
                return $prod;
            }
        }
        
        
        return NULL;
    }

}