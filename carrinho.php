<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrinho de compras</title>

    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jQuery.js"></script>
</head>
<body>
    <nav>
        <div class="nav-wrapper blue">
            <a href="#" class="brand-logo center">Carrinho de compras</a>
        </div>
    </nav>

    <main>
        <div class="row">
            <div class="col s6 s12">
                <div class="container">
                    <div class="content z-depth-1 white">
                        
                        <div class="produtos-relacionados">
                            <div class="row">
                                <?php foreach ($produtos as $key => $produto) { ?>
                                    
                                    <div class="col">
                                        <a href="?op=add&id=<?= $produto->GetId()?>">
                                            <div class="card">
                                                <div class="card-content">
                                                    <p><?= $produto->GetProd()->name ?></p>
                                                    <p>R$ <?= number_format($produto->GetProd()->value, 2, ',', '.')?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    
                                <?php }?>
                                
                            </div>
                        </div>


                        <br>

                        <table class="table striped centered bordered">
                            <thead>
                                <th>Item</th>
                                <th>Produto</th>
                                <th>Descrição</th>
                                <th>Valor (un)</th>
                                <th>Unidade</th>
                                <th>Valor Total</th>
                                <th></th>
                            </thead>

                            <tbody>
                                <?php foreach( $carrinho->produtos as $key => $item ){?>
                                    <tr>
                                        <td><?= $item->id ?></td>
                                        <td><?= $item->name ?></td>
                                        <td><?= $item->descrption ?></td>
                                        <td>R$ <?= number_format($item->value, 2, ',', '.') ?></td>
                                        <td><?= $item->quantidade ?></td>
                                        <td>R$ <?= number_format($item->valorTotalItem, 2, ',', '.') ?></td>
                                        <td><a href="?op=delete&id=<?= $item->id ?>" class="red-text">X</a></td>
                                    </tr>
                                <?php }?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="green-text">R$ <?= $carrinho->valorTotal?></td>
                                        <td></td>
                                    </tr>
                            </tbody>
                        </table>

                        <br>

                        <div class="right-align">
                            <a href="?op=finalizar" class="btn green">Finalizar venda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="vendaFinalizada" class="modal">
        <div class="modal-content">
            <h4 class="green-text">Venda finalizada com sucesso</h4>
            <p>Valor total: <span class="green-text">R$ <?= $vendaFinal->valorTotal?></span></p>

            <br>

            <table class="bordered">
                <tbody>
                    <?php foreach( $vendaFinal->produtos as $key => $item ){?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><?= $item->name ?></td>
                            <td><?= $item->descrption ?></td>
                            <td>R$ <?= number_format($item->value, 2, ',', '.') ?></td>
                            <td><?= $item->quantidade ?></td>
                            <td>R$ <?= number_format($item->valorTotalItem, 2, ',', '.') ?></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
        </div>
    </div>

    <script src="js/materialize.min.js"></script>
    <script src="js/script.js"></script>

    <?php if(!empty($vendaFinalizada)){?>
    <script>
        $(document).ready(function(){
            $('#vendaFinalizada').modal("open");
        });
    </script>
    <?php }?>
</body>
</html>