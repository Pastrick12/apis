<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llamada Api</title>
</head>
<body>
    <h1> Ejemplo llamando un api </h1>
    <form action="" method="get">
        <label>Numero 1: </label> 
            <input type="number" step="0.01" name="numero1" value="<?= empty($_GET["numero1"])?10:$_GET["numero1"]?>" required><br>
            <label>Numero 2: </label> 
            <input type="number" step="0.01" name="numero2" value="<?= empty($_GET["numero2"])?30:$_GET["numero2"]?>" required><br>
     <input type="submit" value="Confirmar">
    </form>
    
<?php
if (isset($_GET["numero1"]) && $_GET["numero2"]) {
    $response = file_get_contents("http://localhost/apis/suma.php?numero1=$_GET[numero1]&numero2=$_GET[numero2]");
    $data = json_decode($response, true);
    echo ($data["status"] == "200") ? "Resultado: ".$data["result"]:"Error: ".$data["status"];

}
?>
</body>
</html>