
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
		$Usu = $_POST['UsuarioF'];
		if(empty($Usu)) {
			echo "No seleccionó ninguna casilla";
		} else {
			session_start();
			$Usuario = $_SESSION["Usuario"];
			$Contrasena = $_SESSION["Contrasena"];		
			$db = new mysqli("localhost", $Usuario, $Contrasena, "Huerto");
			$numfilas = count($Usu);
			for ($x=0; $x<$numfilas; $x++) {
				$db->query("update Usuarios set Valido = '1' where ID_Usuario = '" . $Usu[$x] . "'");
				$resultado = $db->query("select * from Usuarios where ID_Usuario = '" . $Usu[$x] . "'");
				$Fila = $resultado->fetch_object();
				$db->query("create user '" . $Fila->ID_Usuario . "'@'%' identified by '" . $Fila->Contrasena . "'");
				$db->query("grant select, insert on Huerto.Eleccion to '" . $Fila->ID_Usuario . "'@'%'");
				$db->query("grant select on Huerto.Usuarios to '" . $Fila->ID_Usuario . "'@'%'");
				$db->query("grant select on Huerto.Frutas to '" . $Fila->ID_Usuario . "'@'%'");
				$db->query("grant select on Huerto.Des_Conjunto to '" . $Fila->ID_Usuario . "'@'%'");
				$db->query("grant select on Huerto.Des_Pares to '" . $Fila->ID_Usuario . "'@'%'");
				$db->query("grant select on Huerto.Des_Impares to '" . $Fila->ID_Usuario . "'@'%'");
				echo "Usuario " . $Fila->Nombre . " registrado<br />";
			}
			$db->close();
			echo "<a href='./Validar.php >Inicio</a>";
		}
		echo "<br /><br /><a href='./Validar.php' >Inicio</a>";
	?>
</body>

</html>
