<?php
include './service/moduloService.php';
$COD_MODULO = "";
$NOMBRE = "";
$ESTADO = "";
$accion = "Agregar";
if (isset($_POST["accion"]) && ($_POST["accion"] == "Agregar")) {
    insert($_POST["COD_MODULO"], $_POST["NOMBRE"], $_POST["ESTADO"]);
} else if (isset($_POST["accion"]) && ($_POST["accion"] == "Modificar")) {
    update($_POST["COD_MODULO"], $_POST["NOMBRE"], $_POST["ESTADO"]);
} else if (isset($_GET["update"])) {
    $MODULO = findByPK($_GET["update"]);
    if ($MODULO != null) {
        $COD_MODULO = $MODULO["COD_MODULO"];
        $NOMBRE = $MODULO["NOMBRE"];
        $ESTADO = $MODULO["ESTADO"];
        $accion = "Modificar";
    }
} else if (isset($_POST["PAS"])) {
    delete($_POST["PAS"]);
}
?>



<!DOCTYPE html>
<html lang="sp">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Gestion</title>



    <link href=".css/simplebar.css" rel="stylesheet" />
    <link href="./css/bootstrap.min.css" rel="stylesheet" />

    <link href="./css/icons.css" rel="stylesheet" type="text/css" />

    <link href="./css/sidebar-menu.css" rel="stylesheet" />

    <link href="./css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme1">
    <div id="pageloader-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    <div id="wrapper">
        <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
            <div class="brand-logo ">
                <a href="index.html">

                    <h5 class="logo-text">Gestion Modulos</h5>
                </a>
            </div>
            <ul class="sidebar-menu do-nicescrol ">
                <li class="sidebar-header">Menu Gestiones</li>
                <li>
                    <a href="./index.php">
                        <i class="zmdi zmdi-grid"></i> <span>Modulos</span>
                    </a>

                </li>
                <li>
                    <a href="./funcionalidad.php">
                        <i class="zmdi zmdi-grid"></i> <span>Funcionalidad</span>
                    </a>
                </li>
                <li>
                    <a href="./rolModulo.php">
                        <i class="zmdi zmdi-grid"></i> <span>Roles</span>
                    </a>
                </li>
            </ul>
        </div>
        <header class="topbar-nav">
            <nav class="navbar navbar-expand fixed-top">
            </nav>
        </header>
        <div class="clearfix"></div>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form id="forma" name="forma" method="post" action="index.php">
                                    <h5 class="card-title">Modulos Activos</h5>
                                    <div class="table-responsive">
                                        <table>
                                            <tr>
                                                <td scope="col" style="width: 1010px;">&nbsp;</td>
                                                <th><input type="button" name="eliminar" class=" btn btn-light btn-round px-4 " value="Eliminar" onclick="eliminarModulo();"></th>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="text-align: center;">CodigoModulo</th>
                                                    <th scope="col" style="text-align: center;">Nombre Modulo </th>
                                                    <th scope="col" style="text-align: center;">Estado</th>
                                                    <th scope="col" style="text-align: center;">ELIM.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = findAll();
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <tr>
                                                            <th scope="col" style="text-align: center;"><a href="index.php?update=<?php echo $row["COD_MODULO"]; ?>"><?php echo $row["COD_MODULO"]; ?></a></th>
                                                            <th scope="col" style="text-align: center;"><?php echo $row["NOMBRE"]; ?></th>
                                                            <th scope="col" style="text-align: center;"><?php echo $row["ESTADO"]; ?></th>
                                                            <th scope="col" style="text-align: center;"><input type="radio" name="PAS" value="<?php echo $row["COD_MODULO"]; ?>"></th>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <th scope="col">No hay Modulos Registrados</th>
                                                    </tr>
                                                <?php  } ?>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" name="COD_MODULO" value="<?php echo $COD_MODULO; ?>" />
                                <h5 class="card-title">Gestion Modulos</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <td><label id="lblcodmodulo">Codigo:</label></td>
                                            <td><input type="text" name="COD_MODULO" value="<?php echo $COD_MODULO; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><label id="lblnombre" for="nombre">Nombre:</label></td>
                                            <td><input type="text" name="NOMBRE" value="<?php echo $NOMBRE; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><label id="lblestado">Estado:</label></td>
                                            <td> <select class="custom-select" name="ESTADO">
                                                    <option value="ACT">Activo</option>
                                                    <option value="PAS">Pasivo</option>
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td><input type="submit" class=" btn btn-light btn-round px-5 " name="accion" value="<?php echo $accion; ?>" /></td>
                                        </tr>

                                    </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   <footer class="footer">
        <div class="container">
            <div class="text-center">
                ESPE
            </div>
        </div>
    </footer> -->
</body>
<script>
    function eliminarModulo() {
        document.getElementById('forma').submit();
    }
</script>

</html>