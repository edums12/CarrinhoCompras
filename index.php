<?php

require './ListaCompras.php';

require './Produto.php';

require './Funcoes.php';

require './DB.php';

$list = new ListaCompras();

$db = new DB();

$produtos = array();
$produtos[] = new Produto(1, "Computador", "Super Computador da XUXA", 1800);
$produtos[] = new Produto(2, "Mochila", "Qualquer mochila por ai", 500);
$produtos[] = new Produto(3, "Fone de ouvido da RAIZIIIR", "Aquela marca cara", 5000);
$produtos[] = new Produto(4, "Kit Gamer", "KIT TOPP", 4000);
$produtos[] = new Produto(5, "Jogo TOPSTER", "JOGO TOPP", 100);

if ( !empty( $_GET['op'] ) )
{
    $get = $_GET['op'];

    if ( $get == "add" && $_GET['id'] )
    {
        $id = $_GET['id'];

        $db->Add($id);
    }
    else if( $get == "delete" && $_GET['id'] )
    {
        $id = $_GET['id'];

        $db->Remove($id);
    }
}

$DBprodutos = $db->GetAll();

foreach (array_keys($DBprodutos) as $key => $item) {
    
    $list->Add(Funcoes::findProd($produtos, $item), $DBprodutos[(int) $item]);      

}

$carrinho = $list->GetAll();

if( !empty($get) )
{
    if( $get == "finalizar" )
    {
        $vendaFinal = $carrinho;

        $tmp = new ListaCompras();
        
        $carrinho = $tmp->GetAll();

        $db->Clear();

        $vendaFinalizada = TRUE;
    }
}

require 'carrinho.php';
