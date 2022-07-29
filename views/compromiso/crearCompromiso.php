<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/compromiso/css/Style.css">
    <title>Compromisos</title>
</head>

<body>
    <div class="main_compromiso">
        <div class="titulo_main">
            <h2>Asociar Compromiso</h2>
        </div>
        <form action="routes.php?controller=Compromiso&action=registrar&fila=<?php echo $_GET['fila']?>" method="post">
            <textarea id="descripcion_compromiso" name="descripcion_compromiso" rows="4" cols="40" placeholder="Descripcion"></textarea>
            <div class="fechas">
                <input type="date" name="fecha_inicial" id="fecha_inicial" placeholder="Fecha Inicial">
                <input type="date" name="fecha_final" id="fecha_final" placeholder="Fecha Final">
            </div>
            <input type="text" name="responsable_compromiso" id="responsable_compromiso" placeholder="Responsable">
            <input type="submit" value="Crear compromiso">
        </form>
    </div>
</body>

</html>