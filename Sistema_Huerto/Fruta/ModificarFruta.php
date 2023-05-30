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
		if ($db->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
		}else{
			$result = $db->query("select * from Frutas where ID_Fruta = " . $_POST['ID_Fruta']);
			$fila = $result->fetch_object();
			if(isset($fila)){
				$db->query("update Frutas set Nombre = '" . $_POST['Nombre'] . "', Valor = '" . $_POST['Valor'] . "' where ID_Fruta = " . $_POST['ID_Fruta']);
				echo "Datos modificados";
			}else{
				echo "No existe una fruta con ese valor";
			}
		}
		echo "<br /><br /><a href='./AdministrarFruta.php' >Inicio</a>";
	?>
</body>

</html>
