<?php
//Este api recibe dos numeros y regresa su suma
//El api regresa 200 y el resultado si todo esta bien
//El api regresa 300 si hubo un error en los datos
//El api regresa 400 si se llamo mal
//Para llamar a api usamos esa linea http://localhost/apis/colonias.php?codigo=83224

if (!empty($_GET["codigo"])) {
    //Validar que codigo sea numero entero
    if (filter_var($_GET["codigo"], FILTER_VALIDATE_INT) !== false) {

        $conexion = new mysqli("localhost","root","","sonora");

        if ($conexion -> connect_error) {
            response(500, NULL);
        }

        $consulta = "SELECT colonia FROM codigos_sonora WHERE codigo = $_GET[codigo]";
        $resultado = $conexion -> query($consulta);

        if ($resultado -> num_rows > 0) {

            $renglones = array();
            while ($renglon = mysqli_fetch_assoc($resultado)) {
                $renglones[] = $renglon["colonia"];
            }

            response(200,$renglones);

        }
        else{
            response(300, NULL);
        }

    } else {
        response(300, NULL);
    }
    
} else {
    response(400, NULL);
}

//Declaramos la funcion response
function response($status,$data){
    header("Content-Type: application/json;");
    header("HTTP/1.1 ".$status);
    $response = array(
        "status" => $status,
        "data" => $data
    );
    echo json_encode($response);
}
?>