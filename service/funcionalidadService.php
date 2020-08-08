<?php
 include_once './service/conexion.php';


 function insertF($NOMBRE, $URL_PRINCIPAL, $DESCRIPCION){
    $conn = getConnectionF();
    $stmt = $conn->prepare("INSERT INTO seg_funcionalidad (NOMBRE, URL_PRINCIPAL, DESCRIPCION) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $NOMBRE, $URL_PRINCIPAL, $DESCRIPCION);
    $stmt->execute();
    $stmt->close();
 }
  function findAllF(){
      $conn = getConnectionF();
      return $conn->query("SELECT * from seg_funcionalidad ");
  }
  function findAllFun($CODMODULO){
    $conn = getConnectionF();
    return $conn->query("SELECT f.NOMBRE, f.URL_PRINCIPAL, f.DESCRIPCION, f.COD_FUNCIONALIDAD 
    FROM SEG_FUNCIONALIDAD f, SEG_MODULO m 
    WHERE m.ESTADO = 'ACT' AND f.COD_MODULO=m.COD_MODULO AND f.COD_MODULO=".$CODMODULO);
}

  function findByPKF($COD_MODULO){
    $conn = getConnectionF();
    $result = $conn->query("SELECT * FROM seg_funcionalidad WHERE COD_MODULO= '$COD_MODULO'" );
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }else{
        return null;
    }
   }

  function updateF($COD_MODULO, $NOMBRE, $ESTADO){
    $conn = getConnectionF();
    $stmt = $conn->prepare("UPDATE seg_modulo set COD_MODULO= ?, NOMBRE=?, ESTADO=? where COD_MODULO='$COD_MODULO'");
    $stmt->bind_param("sss",$COD_MODULO , $NOMBRE, $ESTADO);
    $stmt->execute();
    $stmt->close();
  }
  function deleteF($COD_MODULO){
    $conn = getConnectionF();
    $stmt = $conn->prepare("DELETE FROM seg_modulo WHERE COD_MODULO= '$COD_MODULO'" );
    $stmt->execute();
    $stmt->close();

  }
 
  function insertFun($codModulo, $url, $nombre, $descripcion){
    $conn = getConnectionF();
    $stmt = $conn->prepare("INSERT INTO SEG_FUNCIONALIDAD (cod_modulo, url_principal, nombre, descripcion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $codModulo, $url, $nombre, $descripcion);
    $stmt->execute();
    $stmt->close();
}

function updateFun($nombre, $url, $descripcion, $codFuncionalidad) {
  $conn = getConnectionF();
    $stmt = $conn->prepare("UPDATE SEG_FUNCIONALIDAD  set NOMBRE=?, URL_PRINCIPAL=?, DESCRIPCION=? WHERE COD_FUNCIONALIDAD= ?");
  $stmt->bind_param("sssi", $nombre, $url, $descripcion, $codFuncionalidad);
  $stmt->execute();
  $stmt->close();
}

function deleteFun($codFuncionalidad){
  $conn = getConnectionF();
    $stmt = $conn->prepare("DELETE FROM SEG_FUNCIONALIDAD WHERE COD_FUNCIONALIDAD = ?");
  $stmt->bind_param("i", $codFuncionalidad);
  $stmt->execute();
  $stmt->close();
}
function findByPKFun($codFuncionalidad) {
  $conn = getConnectionF();
 
  $result = $conn->query("SELECT * FROM SEG_FUNCIONALIDAD WHERE COD_FUNCIONALIDAD=".$codFuncionalidad);
  if ($result->num_rows > 0) {
      $row1 = $result->fetch_assoc();
      return $row1;
  }else{
      return null;
  }
}
 
 
 
 ?>