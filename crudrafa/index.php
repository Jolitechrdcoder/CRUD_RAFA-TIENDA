<?php
 session_start();
 require 'funciones.php'

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RFtechnology</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">RFtechnology</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li>
              <a href="carrito.php" class="btn">CARRITO <span class="badge"><?php print cantidadProductos(); ?></span></a>
            </li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
    <div class="row">
      <?php
        require 'vendor/autoload.php';
        $producto = new mecatronicosrd\Productos;
        $info_productos = $producto->mostrar();
        $cantidad = count($info_productos);
        if($cantidad>0){
          for($x=0; $x<$cantidad; $x++){
            $item =$info_productos[$x];
      ?>
      <div class = "col-md-3">
      <div class="panel panel-default">
      <div class="panel-heading">
       <h4 class = "text-center titulo-pelicula"><?php print $item['titulo']?></h4>
      </div>
         <div class="panel-body">
         <?php
                     $foto = 'upload/'.$item['foto'];
                     if(file_exists($foto)){
                    ?>
                    <img src="<?php print $foto;?>" class="img-responsive">
                    <?php }else{?>
                      <img src="assets/not-found.jpg" class="img-responsive">
                    <?php } ?>
          </div>
           <div class="panel-footer">
            <a href="carrito.php?id=<?php print $item['id']?>" class="btn btn-success btn-block">
              <span class="glyphicon glyphicon-shopping-cart"></span>  Comprar
            </a>
           </div>


       </div>


      </div>

      <?php

          }
      }else{?>
        <h4>No hay Registros</h4>
    
    <?php } ?>
      
     
    </div>
        
  
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>