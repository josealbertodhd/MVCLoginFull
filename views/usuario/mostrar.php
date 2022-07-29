<h1>Pagina Principal del Usuario</h1>
<h3>Tipo de Usuario</h3>
<hr>
<?php  while($usuario = $usuarios->fetchObject()):  ?>
<b><?=$usuario->nombres ?></b> - <?=$usuario->apellidos ?> <br>
<?=$usuario->email ?>
<hr>
<br>
<?php  endwhile;  ?>