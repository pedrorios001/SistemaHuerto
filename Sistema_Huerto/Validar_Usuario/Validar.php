<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.32" />
	<link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>

<body>
	<?php
		session_start();
		$Usuario = $_SESSION["Usuario"];
		$Contrasena = $_SESSION["Contrasena"];		
		$db = new mysqli("localhost", $Usuario, $Contrasena, "Huerto");
		$result = $db->query("select * from Usuarios where Valido = 0");
		$numfilas = $result->num_rows;
		echo "<form action='./Confirmar.php' method='POST' target='_self'>";
		for ($x=0; $x<$numfilas; $x++) {
			$fila = $result->fetch_object();
			echo "<input type='checkbox' name='UsuarioF[]' value = '" . $fila->ID_Usuario . "' /><span>Nombre: " . $fila->Nombre . " Grupo: " . $fila->Grupo . "</span><br /><br />";
		}
		echo "<input type='submit' value='Enviar' />";
		echo "<input type='reset'>";
		echo "</form>";
		$db->close();

	?>
</body>

</html>
