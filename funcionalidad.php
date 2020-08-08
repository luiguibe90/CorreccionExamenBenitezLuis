<?php
include './service/moduloService.php';
include  './service/funcionalidadService.php';
$nombre = "";
$url = "";
$modulo = "";
$codModulo = "";
$codFuncionalidad = "";
$descripcion = "";
$accion = "Agregar";
$eliminarMod = "Eliminar";


if (isset($_POST["accion"]) && ($_POST["accion"] == "Agregar")) {
    insertFun($_POST['modulo'], $_POST["url"], $_POST["nombre"], $_POST["descripcion"]);
} else if (isset($_POST["accion"]) && ($_POST["accion"] == "Modificar")) {
    updateFun($_POST["nombre"], $_POST["url"], $_POST["descripcion"], $_POST["codFuncionalidad"]);
} else if (isset($_GET["update"])) {
    $modulo = findByPKFun($_GET["update"]);
    if ($modulo != null) {
        $codFuncionalidad = $modulo["COD_FUNCIONALIDAD"];
        $nombre = $modulo["NOMBRE"];
        $url = $modulo["URL_PRINCIPAL"];
        $descripcion = $modulo["DESCRIPCION"];
        $accion = "Modificar";
    }
} else if (isset($_POST["eliminarMod"])) {
    deleteFun($_POST["eliminarMod"]);
}
$result = findAll();

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
                                <form id="forma" name="forma" method="post" action="funcionalidad.php">
                                    <h5 class="card-title">Funcionalidades</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tr>
                                                <td scope="col" style="width: 1010px;">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table>


                                            <tr>
                                                <td><label id="lblCategoria" for="categoria">Seleccione Módulo: </label></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select class="custom-select" id="modulo" name="modulo">
                                                        <?php
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                                <option value="<?php echo $row["COD_MODULO"] ?>">
                                                                    <?php echo $row["NOMBRE"] ?></option>
                                                                <?php if (isset($_POST["aceptar"])) { ?>
                                                                    <option hidden selected>
                                                                        <?php echo $_POST['modulo'] ?></option>
                                                        <?php }
                                                            }
                                                        } ?>
                                                    </select>
                                                    <input class=" btn btn-light btn-round px-4 " name="aceptar" type="submit" value="Aceptar">
                                                </td>

                                            </tr>

                                        </table>

                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tr>
                                                <td scope="col" style="width: 1010px;">&nbsp;</td>
                                                <td>
                                                <th><input type="button" name="eliminar" class=" btn btn-light btn-round px-4 " value="Eliminar" onclick="eliminarFuncionalidad();"></th>

                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="text-align: center;">MODIFICAR</th>
                                                <th scope="col" style="text-align: center;">NOMBRE</th>
                                                <th scope="col" style="text-align: center;">URL</th>
                                                <th scope="col" style="text-align: center;">DESCRIPCION</th>
                                                <th scope="col" style="text-align: center;">ELIM</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST["aceptar"])) {
                                                $res = findAllFun($_POST['modulo']);
                                                if ($res->num_rows > 0) {
                                                    while ($row1 = $res->fetch_assoc()) {
                                            ?>
                                                        <tr>
                                                            <th scope="col" style="text-align: center;"><a href="editFuncionalidad.php?update=<?php echo $row1["COD_FUNCIONALIDAD"]; ?>"><i class="zmdi zmdi-brush"></i></a></th>
                                                            <th scope="col" style="text-align: center;"><?php echo $row1["NOMBRE"]; ?></td>
                                                            <th scope="col" style="text-align: center;"><?php echo $row1["URL_PRINCIPAL"]; ?></td>
                                                            <th scope="col" style="text-align: center;"><?php echo $row1["DESCRIPCION"]; ?></td>
                                                            <th scope="col" style="text-align: center;"><input type="radio" name="eliminarMod" value="<?php echo $row1["COD_FUNCIONALIDAD"]; ?>">
                                                                </td>
                                                        </tr>
                                                    <?php
                                                    } ?>
                                                    <input type="hidden" name="codFuncionalidad" value="<?php echo $codFuncionalidad ?>">

                                        </tbody>
                                        <table class="table table-hover">
                                            <tr>
                                                <td colspan=2 class="text-primary">
                                                    <h5 class="card-title" style="text-align: center;">Agregar Funcionalidad</h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label id="lblModulo" for="nombre">Nombre: </label></td>
                                                <td><input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>" size="25"></td>
                                            </tr>
                                            <tr>
                                                <td><label id="lblNombre" for="url">URL: </label></td>
                                                <td><input type="text" name="url" id="url" value="<?php echo $url ?>" maxlength="100" size="25"></td>
                                            </tr>
                                            <tr>
                                                <td><label id="lblEstado" for="descripcion">DESCRIPCION: </label></td>
                                                <td><input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion ?>" size="25"></td>
                                            </tr>
                                            <tr>
                                                <th><input type="submit" name="accion" class=" btn btn-light btn-round px-4 " value="<?php echo $accion ?>"></td>
                                            </tr>
                                        </table>
                                    <?php } else { ?>
                                        <tr>
                                            <td class="text-center" colspan="5">Sin Funcionalidades</td>
                                        </tr>
                                        <input type="hidden" name="codFuncionalidad" value="<?php echo $codFuncionalidad ?>">

                                        <table class="table table-hover">
                                            <tr>
                                                <td colspan=2><strong>Agregue Funcionalidad</strong></td>
                                            </tr>
                                            <tr>
                                                <td><label id="lblModulo" for="nombre">Nombre: </label></td>
                                                <td><input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>" size="25"></td>
                                            </tr>
                                            <tr>
                                                <td><label id="lblNombre" for="url">URL: </label></td>
                                                <td><input type="text" name="url" id="url" value="<?php echo $url ?>" maxlength="100" size="25"></td>
                                            </tr>
                                            <tr>
                                                <td><label id="lblEstado" for="descripcion">DESCRIPCION: </label></td>
                                                <td><input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion ?>" size="25"></td>
                                            </tr>
                                            <tr>
                                                <td colspan=2><input type="submit" name="accion" value="<?php echo $accion ?>"></td>
                                            </tr>
                                        </table>
                                    <?php }
                                            } else { ?>
                                    <tr>
                                        <td class="text-center" colspan="5">Debe seleccionar un modulo</td>
                                    </tr>
                                <?php } ?>

                                    </table>
                                    <!-- hidden ES PARA QUE LOS USUARIOS NO PUEDAN VER NI MODIFICAR DATOS CUANDO SE ENVÍA EN UN FORMULARIO, ESPECIALMENTE ID -->

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
</body>
<!-- CODIGO JAVA SCRIPT PARA HACER UN TYPE BUTTON EN SUBMIT -->
<script>
    function eliminarFuncionalidad() {
        document.getElementById("forma").submit();
    }

    function agregarModulo() {
        document.getSelection("forma").submit();
    }
</script>

</html>