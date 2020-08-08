<?php
    include './service/moduloService.php';
    include 'service/funcionalidadRol.php';
    $result=findAllM();
    $res= findAllR();
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
                    <form name="registro" action="./rol.php" method="POST">
                        <div class="border p-4 form">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label id="lblCategoria" for="categoria">Rol</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">

                                        <select class="custom-select" id="rol" name="rol">
                                            <?php
                        if($res->num_rows>0){
                            while($row1 = $res->fetch_assoc()) {?>
                                            <option value="<?php echo $row1["COD_ROL"]?>">
                                                <?php echo $row1["NOMBRE"]?></option>
                                            <?php if(isset($_POST["aceptar"])){?>
                                            <option hidden selected>
                                                <?php echo $_POST['rol']?></option>
                                            <?php }} }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label id="lblCategoria" for="categoria">Modulo</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">

                                        <select class="custom-select" id="modulo" name="modulo">
                                            <?php
                        if($result->num_rows>0){
                            while($row = $result->fetch_assoc()) {?>
                                            <option value="<?php echo $row["COD_MODULO"]?>">
                                                <?php echo $row["NOMBRE"]?></option>
                                            <?php if(isset($_POST["aceptar"])){?>
                                            <option hidden selected>
                                                <?php echo $_POST['rol']?></option>
                                            <?php }} }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="justify-content: center;">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input class="btn btn-primary btn-user btn-block" type="submit" name="registrar"
                                        value="Registrar">
                                </div>
                                <div class="col-sm-6">
                                    <a href="./index.php" class="btn btn-primary btn-user btn-block ">
                                        Cancelar
                                    </a>
                                </div>
                            </div>
                        </div>

                </div>
                </form>
            </div>
        </div>
    </div>

    </div>
</body>

</html>