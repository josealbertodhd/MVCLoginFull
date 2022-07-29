<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/compromiso/css/mostrarStyles.css">
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Mostrar actas</title>
</head>
<body>
    <table class="tabla_actas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripcion</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <th>Responsable</th>
                <th>ID Acta</th>
            </tr>
        </thead>
        <tbody>
           <?php
              $contador = 0;
                foreach ($reporteCompromisos as $fila) {
                    $contador = $contador + 1;
                    ?>
                    <tr>
                        <td><?php echo $fila['id_compromiso'];?></td>
                        <td><?php echo $fila['descripcion_compromiso'];?></td>
                        <td><?php echo $fila['fecha_inicio'];?></td>
                        <td><?php echo $fila['fecha_final'];?></td>
                        <td><?php echo $fila['responsable_compromiso'];?></td>
                        <td><?php echo $fila['acta_id'];?></td>
                    </tr>
                      <?php
                  }
              if($contador == 0){
                  ?>
                  <tr>
                      <td colspan="6">
                            No se encontraron compromisos.
                      </td>
                  </tr>
                  <?php
              }
           ?>
    </body>
</html>