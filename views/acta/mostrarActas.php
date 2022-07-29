<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/acta/css/mostrarStyle.css">
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Mostrar actas</title>
</head>
<body>
    <table class="tabla_actas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Asunto</th>
                <th>Fecha</th>
                <th>Descripcion</th>
                <th>Responsable</th>
                <th>Programa</th>
                <th>V/A</th>
            </tr>
        </thead>
        <tbody>
           <?php
              $contador = 0;
                foreach ($actas as $fila) {
                    $contador = $contador + 1;
                    ?>
                    <tr>
                        <td><?php echo $fila['id_acta'];?></td>
                        <td><?php echo $fila['asunto'];?></td>
                        <td><?php echo $fila['fecha_acta'];?></td>
                        <td><?php echo $fila['descripcion_acta'];?></td>
                        <td><?php echo $fila['responsable_acta'];?></td>
                        <td><?php echo $fila['programa_id'];?></td>
                        <td><a href="routes.php?controller=ReporteCompromisos&action=mostrar&fila=<?php echo $fila['id_acta'];?>"><i class="fas fa-eye"></i></a>
                        <a href="routes.php?controller=Compromiso&action=crear&fila=<?php echo $fila['id_acta'];?>"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                      <?php
                  }
              if($contador == 0){
                  ?>
                  <tr>
                      <td colspan="7">
                          <div class="alert alert-warning">
                              No se encontarron registros de actas.
                          </div>
                      </td>
                  </tr>
                  <?php
              }
           ?>
    </body>
</html>