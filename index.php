<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="visjs/vis.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.8.0/sweetalert2.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="js/index.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.8.0/sweetalert2.js"></script>
        <script src="visjs/vis.min.js"></script>

    </head>
    <body>
        <?php
        include("./Grafo.php");
        session_start();
        if (!isset($_SESSION["grafo"])) {
            $_SESSION["grafo"] = new Grafo();
        }
        if (!isset($_SESSION['aux'])) {
            $_SESSION['aux'] = 1;
        } else {
            $_SESSION['aux'] = 1;
        }
        $_SESSION['vertice'] = null;
        $_SESSION['adyacente'] = null;
        ?>
        <div id="capaFormulario" class="container-fluid">
            <div class="row">
                <div class="col-md-3 borde">
                    <!--Agregar Vertice -->
                    <form method="post" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <h2 class="text-center text-danger">Agregar Vertice</h2>
                            <label class="col-md-3 control-label">Id del Vertice:</label><div class="col-md-9"><input type="text" name="AgregarIdVertice" class="form-control" placeholder="Id Vertice" required=""></div>
                        </div>
                        <div class="col-md-offset-3">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Agregar</button>
                        </div>
                    </form>
                    <hr>
                    <!--Agregar Arista -->
                    <form method="post" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <h2 class="text-center text-danger">Agregar Arista</h2>
                            <label class="col-md-3 control-label">Vertice de Origen:</label><div class="col-md-9"><input type="text" name="AddVerticeOrigen" class="form-control" placeholder="Vertice Origen" required=""></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Vertice de Destino:</label><div class="col-md-9"><input type="text" name="AddVerticeDestino" class="form-control" placeholder="Vertice Destino" required=""></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Peso:</label><div class="col-md-9"><input type="text" name="AddPeso" class="form-control" placeholder="Peso" required=""></div><br>
                        </div>
                        <div class="col-md-offset-3">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Agregar</button>
                        </div>
                    </form><hr>
                    <!--Ver Grafo -->
                    <form  method="post" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <h2 class="text-center text-danger">Ver Grafo</h2>
                            <div class="col-md-offset-3">
                                <input type="text" class="hidden" name="verGrafo" value="1">
                                <button id="btnVerGrafo" type="submit" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span> Ver</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 borde">
                    <!--Ver Vertice -->
                    <form method="post" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <h2 class="text-center text-danger">Ver Vertice</h2>
                            <label class="col-md-3 control-label">Id del Vertice:</label><div class="col-md-9"><input type="text" name="verVertice" class="form-control" placeholder="Id Vertice" required=""></div>
                        </div>
                        <div class="col-md-offset-3">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span> Ver</button>
                        </div>
                    </form>
                    <hr>

                    <!--Ver Adyascente -->
                    <form method="post" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <h2 class="text-center text-danger">Ver Adyacente</h2>
                            <label class="col-md-3 control-label">Id del Vertice:</label><div class="col-md-9"><input type="text" name="verAdyacente" class="form-control" placeholder="Id Vertice" required=""></div>
                        </div>
                        <div class="col-md-offset-3">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span> Ver</button>
                        </div>
                    </form><hr>
                    <!--Ver Grado-->
                    <form method="post" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <h2 class="text-center text-danger">Ver Grado</h2>
                            <label class="col-md-3 control-label">Id del Vertice:</label><div class="col-md-9"><input type="text" name="verGrado" class="form-control" placeholder="Id Vertice" required=""></div>
                        </div>
                        <div class="col-md-offset-3">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span> Ver</button>
                        </div>
                    </form><hr>
                </div>
                <div id="grafo1" class="col-md-6"></div>
                <div class="col-md-3 borde">
                    <!--Eliminar Vertice-->
                    <form method="post" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <h2 class="text-center text-danger">Eliminar Vertice</h2>
                            <label class="col-md-3 control-label">Id del Vertice:</label><div class="col-md-9"><input type="text" name="eliminarVertice" class="form-control" placeholder="Id Vertice" required=""></div>
                        </div>
                        <div class="col-md-offset-3">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-remove "></span> Eliminar</button>
                        </div>
                    </form>
                    <hr>
                </div>
                <div class="col-md-3 borde">
                    <!--Eliminar Arista-->
                    <form method="post" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <h2 class="text-center text-danger">Eliminar Arista</h2>
                            <label class="col-md-3 control-label">Vertice de Origen:</label><div class="col-md-9"><input type="text" name="eliminarOrigen" class="form-control" placeholder="Vertice Origen" required=""></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Vertice de Destino:</label><div class="col-md-9"><input type="text" name="eliminarDestino" class="form-control" placeholder="Vertice Destino" required=""></div>
                        </div>
                        <div class="col-md-offset-3">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-remove "></span> Eliminar</button>
                        </div>
                    </form><hr>
                </div>
            </div>
        </div>



        <?php
        /* echo "<hr>";
          echo "<b>Matriz Adyacencia:</b><br>";
          print_r($n->getMatrizA());
          echo "<hr>"; */

        /* echo "<b>Vector Vertices:</b><br>";

          print_r($_SESSION['grafo']->getVectorV());
          echo "<hr>"; */


        //visualizar matriz adyacencia
        /* echo "<b>Recorrido Matriz Adyacencia:</b><br>";
          foreach ($n->getMatrizA() as $vp => $adya) {
          echo "<br>" . $vp . " ->";
          if ($adya != null) {
          foreach ($adya as $de => $pe) {
          echo " | " . $de . " | " . $pe . " |  --  ";
          }
          }
          }
          echo "<hr>"; */

        //Probar GetVertice
        /* echo "<b>GetVertice A:</b><br>";
          print_r($n->getVertice("A"));
          echo "<hr>"; */

        //Probar getAdyacentes
        /* echo "<b>Adyacentes de A:</b><br>";
          print_r($n->getAdyacentes("A"));
          echo "<hr>"; */


        //Probar grado
        /* echo "<b>Grado de A:</b><br>";
          print_r($_SESSION['grafo']->grado("O"));
          echo "<hr>"; */


        //Probar Eliminar Arista A-C
        /* echo "<b>Eliminar Arista A-C:</b><br>";
          if ($n->eliminarArista("A", "C")) {
          echo "Arista eliminada";
          } else {
          echo "Arista no Existe";
          }
          echo "<hr>"; */

        /* echo "<b>Recorrido Matriz Adyacencia:</b><br>";
          foreach ($n->getMatrizA() as $vp => $adya) {
          echo "<br>" . $vp . " ->";
          if ($adya != null) {
          foreach ($adya as $de => $pe) {
          echo " | " . $de . " | " . $pe . " |  --  ";
          }
          }
          }
         * 
          echo "<hr>"; */


        //Probar Eliminar vertice B
        /* echo "<b>Eliminar Vertice B:</b><br>";
          if ($n->eliminarVertice("B")) {
          echo "Vertice eliminado";
          } else {
          echo "Vertice no Existe";
          }
          echo "<hr>"; */

        /* echo "<b>Recorrido Matriz Adyacencia:</b><br>";
          foreach ($_SESSION['grafo']->getMatrizA() as $vp => $adya) {
          echo "<br>" . $vp . " ->";
          if ($adya != null) {
          foreach ($adya as $de => $pe) {
          echo " | " . $de . " | " . $pe . " |  --  ";
          }
          }
          }
          echo "<hr>"; */

        if (isset($_POST['AgregarIdVertice']) && !empty($_POST['AgregarIdVertice'])) {
            $v = $_POST['AgregarIdVertice'];
            if ($_SESSION["grafo"]->agregarVertice(new Vertice($v))) {
                $_SESSION['aux'] = 1;
                echo "<script>swal('Good Job','Vertice Agregado','success')</script>";
            }else{
                echo "<script>swal('Oops...','El Vertice <b>$v</b> ya Existe','error')</script>";
            }
        }
        if (isset($_POST['AddVerticeOrigen']) && !empty($_POST['AddVerticeOrigen']) && isset($_POST['AddVerticeDestino']) && !empty($_POST['AddVerticeDestino']) && isset($_POST['AddPeso']) && !empty($_POST['AddPeso'])) {
            if ($_SESSION["grafo"]->agregarArista($_POST['AddVerticeOrigen'], $_POST['AddVerticeDestino'], $_POST['AddPeso'])) {
                echo "<script>swal('Good Job','Arista Agregada','success')</script>";
                $_SESSION['aux'] = 1;
            }else{
                echo "<script>swal('Oops...','No se puede agregar esta Arista','error')</script>";
            }
        }
        if (isset($_POST['verVertice'])) {
            $v = $_POST['verVertice'];
            if ($_SESSION['grafo']->buscarVertice($v)) {
                $_SESSION['vertice'] = $_POST['verVertice'];
                $_SESSION['aux'] = 2;
            } else {
                $_SESSION['aux'] = 1;
                echo "<script>swal('Oops...','El vertice <b>$v</b> no existe!','error')</script>";
            }
        }
        if (isset($_POST['verAdyacente'])) {
            $v = $_POST['verVertice'];
            if ($_SESSION['grafo']->buscarVertice($_POST['verAdyacente'])) {
                $_SESSION['vertice'] = $_POST['verAdyacente'];
                $_SESSION['aux'] = 3;
            } else {
                $_SESSION['aux'] = 1;
                echo "<script>swal('Oops...','Este vertice no existe!','error')</script>";
            }
        }
        if (isset($_POST['verGrado'])) {
            $x = $_SESSION['grafo']->grado($_POST['verGrado']);
            $g = $_POST['verGrado'];
            echo "<script>swal('El grado del vertice $g','es: $x')</script>";
        }
        if (isset($_POST['eliminarVertice'])) {
            if ($_SESSION['grafo']->eliminarVertice($_POST['eliminarVertice'])) {
                echo "<script>swal('Good Job','Vertice Eliminado','success')</script>";
            } else {
                echo "<script>swal('Oops...','Este vertice no existe!','error')</script>";
            }
        }
        if (isset($_POST['eliminarOrigen']) && !empty($_POST['eliminarOrigen']) && isset($_POST['eliminarDestino']) && !empty($_POST['eliminarDestino'])) {
            if ($_SESSION['grafo']->eliminarArista($_POST['eliminarOrigen'], $_POST['eliminarDestino'])) {
                echo "<script>swal('Good Job','Arista Eliminada','success')</script>";
            } else {
                echo "<script>swal('Oops...','Esta Arista no existe!','error')</script>";
            }
        }
        ?>
        <script type="text/javascript">

            //Array con los nodos
            var nodos = new vis.DataSet([
<?php
if ($_SESSION['aux'] == 1) {
    foreach ($_SESSION["grafo"]->getVectorV() as $id => $value) {
        echo "{id: '$id', label: '$id'},";
    }
} else if ($_SESSION['aux'] == 2) {
    $x = $_SESSION['vertice'];
    echo "{id: '$x', label: '$x'}";
} else if ($_SESSION['aux'] == 3) {
    $a = $_SESSION['vertice'];
    echo "{id: '$a', label: '$a'},";
    foreach ($_SESSION['grafo']->getMatrizA() as $vp => $adya) {
        if ($adya != null) {
            if ($vp == $_SESSION['vertice']) {

                foreach ($adya as $de => $pe) {
                    echo "{id: '$de', label: '$de'},";
                }
            }
        }
    }
}
?>
<?php
/* for ($i = 1; $i <= 50; $i++) {
  if ($i == 50) {
  echo "{id: $i, label: '$i' }";
  } else {
  echo "{id: $i, label: '$i' },";
  }
  }; */
?>
            ])

            //Matriz con las Aristas
            var aristas = new vis.DataSet([
<?php
if ($_SESSION['aux'] == 1) {
    foreach ($_SESSION['grafo']->getMatrizA() as $vp => $adya) {
        if ($adya != null) {
            foreach ($adya as $de => $pe) {
                echo "{from: '$vp', to: '$de', label: '$pe'},";
            }
        }
    }
} else if ($_SESSION['aux'] == 3) {
    foreach ($_SESSION['grafo']->getMatrizA() as $vp => $adya) {
        if ($adya != null) {
            if ($vp == $_SESSION['vertice']) {
                foreach ($adya as $de => $pe) {
                    echo "{from: '$vp', to: '$de', label: '$pe'},";
                }
            }
        }
    }
}
/* {from: 1, to: 3},
  {from: 1, to: 2},
  {from: 2, to: 4},
  {from: 2, to: 3},
  {from: 3, to: 5} */
?>
            ])

            //var aristas = new vis.DataSet([
<?php
/* for ($i = 1; $i <= 50; $i++) {
  $num1 = rand(1, 50);
  $num2 = rand(1, 50);
  if ($i == 50) {
  echo "{from: $num1, to: $num2}";
  } else {
  echo "{from: $num1, to: $num2},";
  }
  }; */
?>
            //]);

            var contenedor = document.getElementById("grafo1");
            var datos = {
                nodes: nodos,
                edges: aristas
            };
            var opciones = {
                edges: {
                    arrows: {
                        to: {
                            enabled: true
                        }
                    }
                }
            };
            var grafo = new vis.Network(contenedor, datos, opciones);
            var botonVerGrafo = document.getElementById("#btnVerGrafo");
            botonVerGrafo.addEventListener("submit", function() {
                alert("w");
            });
        </script>
    </body>
</html>
