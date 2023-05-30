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
		$_SESSION["Usuario"] = $_POST['Usuario'];
		$_SESSION["Contrasena"] = $_POST['Contrasena'];
		if($_POST['Usuario'] == "root") {
			$db = new mysqli("localhost", $_POST['Usuario'], $_POST['Contrasena'], "Huerto");
			if ($db->connect_errno) {
				echo "Contraseña incorrecta"; /*(" . $db->connect_errno . ") " . $db->connect_error;*/
			} else {
				$db->close();
				echo "<script>parent.location = '../MenuPrincipal.php';</script>"; 
			}
		} else {
			$db = new mysqli("localhost", "UserAdmin", "Ocamp96!", "Huerto");
			$Valido = $db->query("SELECT (Valido) from Usuarios where ID_Usuario = '" . $_POST['Usuario'] . "'");
			$fila = $Valido->fetch_object();
			if($fila->Valido) {
				$db->close();
				echo "Usuario autorizado ";
				$db = new mysqli("localhost", $_POST['Usuario'], $_POST['Contrasena'], "Huerto");
				if ($db->connect_errno) {
					echo "<br/>Usuario o contraseña incorrecta"; /*(" . $db->connect_errno . ") " . $db->connect_error;*/
				} else {
					$db->close();
					echo "<script>parent.location = '../Juego/Principal.php';</script>"; 
					/*header('Location: ../Juego/MenuJuego.php');*/
				}
			} else {
				echo "Usuario no autorizado";
			}
			$Valido->free();
		}
	?>
	<br /><br /><a href="./LogIn.html" >Regresar</a>
</body>
