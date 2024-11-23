<?php
//Este api recibe dos numeros y regresa su suma
//El api regresa 200 y el resultado si todo esta bien
//El api regresa 300 si hubo un error en los datos
//El api regresa 400 si se llamo mal
//Para llamar a api usamos esa linea http://localhost/apis/suma.php?numero1=5&numero2=195

header("Content-Type:application/json");

if (!empty($_GET["numero1"]) && !empty($_GET["numero2"])) {
    //Validar numero1 y numero2 sean numeros
    if (is_numeric($_GET["numero1"]) && is_numeric($_GET["numero2"])) {
        //echo $_GET["numero1"] + $_GET["numero2"];
        $data=$_GET["numero1"] + $_GET["numero2"];
        response(200,$data);
    } else {
        $data="";
        response(300,$data);
        //echo "Los datos puestos no son numeros";
    }
    
} else {
    //echo "Error en la llamada al api";
    $data="";
    response(400,$data);
}
 

//Declaramos la funcion response
function response($status,$data){
    header("HTTP/1.1 ".$status);
    $response["status"]=$status;
    $response["result"]=$data;
    $json_response=json_encode($response);
    echo $json_response;

}
?>