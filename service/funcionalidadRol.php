<?php
 include_once './service/conexion.php';
function findAllR() {
    $conn = getConnectionF();
    $result= $conn->query("SELECT * FROM seg_rol");
    
    return $result;
}

function findAllRMA($codigoRol) {
    $conn = getConnectionF();
    $result= $conn->query("SELECT * from rol_modulo r, seg_modulo s WHERE r.COD_MODULO=s.COD_MODULO AND r.COD_ROL ='$codigoRol' ");
    return $result;
}
function findAllM() {
    $conn = getConnectionF();
    $result= $conn->query("SELECT * FROM seg_modulo");
    return $result;
}
?>