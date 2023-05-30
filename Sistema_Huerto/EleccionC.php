<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Consultas sobre partidas jugadas</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.32" />
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
</head>

<body>
	<?php
		session_start();
		$Usuario = $_SESSION["Usuario"];
		$Contrasena = $_SESSION["Contrasena"];
		$db = new mysqli("localhost", $Usuario, $Contrasena, "Huerto");
		if($Usuario <> "root" || $db->connect_error) {
			echo "<script>alert('Conexión fallida');</script>";
			echo "<script>parent.location = './index.html';</script>";
		}
	?>
	<a class="sesion" onClick="self.close();">Cerrar</a>
	<div class="divEspecial2">
		<iframe src='./ConsultaJuego/EleccionConsulta.php' frameborder="0" allowfullscreen>Iframe no soportado</iframe>
	</div>
</body>


</html>
