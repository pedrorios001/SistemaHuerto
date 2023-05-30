<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Menú principal</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Geany 1.32" />
		<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	</head>

	<body>
		<script>
			var Parametros = "width=800, height=520, left=50, top=50, resizable=no, menubar=yes, toolbar=no, directories=no, location=no, scrollbars=no, status=no";
		</script>
		<header>
			<?php
				session_start();
				$Usuario = $_SESSION["Usuario"];
				$Contrasena = $_SESSION["Contrasena"];
				$db = new mysqli("localhost", $Usuario, $Contrasena, "Huerto");
				if($Usuario <> "root" || $db->connect_error) {
					echo "<script>alert('Conexión fallida');</script>";
					echo "<script>parent.location = './index.html';</script>";
				}
				/*echo "<script>self.close();</script>";*/
			?>
			<a class="sesion" href="./Logout.php">Cerrar Sesión</a>
		</header>
		<div class="divEspecial">
			<br /><br />
			<button class="btnMenu" type="button" onClick="open('./Juego/Principal.php', 'Validar0', Parametros);">Juego</button><br /><br />
			<button class="btnMenu" type="button" onClick="open('ValidarUsuario.php', 'Validar1', Parametros);">Usuarios pendientes de validación</button><br /><br />
			<button class="btnMenu" type="button" onClick="open('AdministrarF.php', 'Validar2', Parametros);">Gestión de la fruta</button><br /><br />
			<button class="btnMenu" type="button" onClick="open('AdministrarDesF.php', 'Validar3', Parametros);">Gestión de las descripciones síntesis(Udishere)</button><br /><br />
			<button class="btnMenu" type="button" onClick="open('AdministrarDesFrutaI.php', 'Validar4', Parametros);">Gestión de las descripciones actuales</button><br /><br />
			<button class="btnMenu" type="button" onClick="open('AdministrarDesFrutaP.php', 'Validar5', Parametros);">Gestión de las descripciones futuras(evolución probable)</button><br /><br />
			<button class="btnMenu" type="button" onClick="open('EleccionC.php', 'Validar6', Parametros);">Consultas del juego</button><br /><br />
		</div>
	</body>
</html>
