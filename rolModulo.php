<?php
    include './service/moduloService.php';
    include 'service/funcionalidadRol.php';
    $result= findAllR();
       
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

        <form name="rol" action="rolModulo.php" method="POST">
            <div class="col">
                <div class="form-group row" style="justify-content: center;">

                    <div class="py-2">
                        <label id="lblCategoria" for="categoria">ROLES</label>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group mb-3">

                            <select class="custom-select" id="rol" name="rol">
                                <?php
                        if($result->num_rows>0){
                            while($row = $result->fetch_assoc()) {?>
                                <option value="<?php echo $row["COD_ROL"]?>">
                                    <?php echo $row["NOMBRE"]?></option>
                                <?php if(isset($_POST["aceptar"])){?>
                                <option hidden selected>
                                    <?php echo $_POST['rol']?></option>
                                <?php }} }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input class=" btn btn-light btn-round px-4 " name="aceptar" type="submit" value="Aceptar">
                    </div>
                </div>
                <div class="card">

                    <div class="card-header border-0" style="text-align: center;">
                        <h3 class="mb-0">Modulos por rol</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">Modulo</th>
                                    <th scope="col" style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <?php
                            if(isset($_POST["aceptar"])){
                                $res= findAllRMA($_POST['rol']);
                            
                                if($res->num_rows>0){
                                    while($row1 = $res->fetch_assoc()) {
                            ?>
                            <tbody class="list">
                                <tr>
                                    <td><?php echo $row1["NOMBRE"]?></td>
                                    <td>
                                        <a href="rol.php?delete='<?php echo $row1["COD_ROL"]?>'" title="Eliminar"
                                            class="btn btn-danger btn-sm"><span class="far fa-trash-alt fa-lg"
                                                aria-hidden="true"></span></a>
                                    </td>
                                </tr>

                                <?php }
                                } }else{ ?>
                                <tr>
                                    <td colspan="4">No hay datos</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="py-2"></div>
                <div class="form-group row" style="justify-content: center;">
                    <div class="col-sm-2">
                        <a href="/registerRol.php"
                        class=" btn btn-light btn-round px-4 ">
                            Registrar
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="./index.php" class=" btn btn-light btn-round px-4 ">
                            Cancelar
                        </a>
                    </div>

                </div>
            </div>
        </form>


    </div>
    </form>
</body>

</html>