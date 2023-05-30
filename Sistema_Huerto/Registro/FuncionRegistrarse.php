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
		$db = new mysqli("localhost", "UserAdmin", "Ocamp96!", "Huerto");
		if ($db->connect_error) {
			die("Conexión fallida: " . $conn->connect_error);
		} else {
			if ( $_POST['Usuario'] == "") {
				echo "Debe ingresar un Usuario";
			} else {
				if ( $_POST['Nombre'] == "") {
					echo "Debe ingresar un Nombre";
				} else {
					if ( $_POST['Contrasena'] == "") {
						echo "Debe ingresar una Contraseña";
					} else {
						$sql = "INSERT INTO Usuarios VALUES ('" . $_POST['Usuario'] . "','" . $_POST['Nombre'] . "','" . $_POST['E_Mail'] . "','" . $_POST['Grupo'] . "', 0,'" . $_POST['Contrasena'] . "')";
						if ($db->query($sql) === TRUE) {
							echo "Registro satisfactorio";
						} else {
							echo "Error: El Usuario ya existe";
						}
					}					
				}
			}
		}
		$db->close();
	?>
	<br /><br /><a href="./Registrarse.html" >Regresar</a>
</body>

</html>
