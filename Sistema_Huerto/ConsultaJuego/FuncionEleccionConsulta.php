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
			echo "<hr />";
			session_start();
			$Usuario = $_SESSION["Usuario"];
			$Contrasena = $_SESSION["Contrasena"];		
			$db = new mysqli("localhost", $Usuario, $Contrasena, "Huerto");
			if ($db->connect_errno) {
				echo "Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
			}else{
				$result = $db->query("select * from Usuarios");
				$numfilas = $result->num_rows;
				echo "<table>";
				echo "<thead>";
				echo "<td>Id_Usuario</td>";
				echo "<td>Nombre</td>";
				echo "</thead>";
				echo "<tr>";
				echo "<td>root</td>";
				echo "<td>Sin nombre</td>";
				echo "</tr>";
				for ($x=0; $x<$numfilas; $x++) {
					$fila = $result->fetch_object();
					echo "<tr>";
					echo "<td>" . $fila->ID_Usuario . "</td>";
					echo "<td>" . $fila->Nombre . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				$result->free();
				$db->close();
			}
			echo "<hr />";
		?>
	<br /><br /><form action="./Consultar.php" method="POST" target="_self">		
		<?php
			switch($_POST['Gestion']){
				case "Usuario":
					echo "<input type='text' name='Gestion' value='Consulta_Usuario' readonly/><span>Función</span><br /><br />";
					echo "<input type='text' name='ID_Usuario' required/><br /><span>ID de Usuario</span><br />";
					break;
					
				case "Fecha":
					echo "<input type='text' name='Gestion' value='Consulta_Fecha' readonly/><span>Función</span><br /><br />";
					echo "<input type='text' name='FechaIni' /><br /><span>Fecha de inicio(aaaa-mm-dd)</span><br />";
					echo "<input type='text' name='FechaFin' /><br /><span>Fecha de fin(aaaa-mm-dd)</span>";
					break;

			}

		?>
		<input type="reset">
		<br /><br /><input type="submit" value="Enviar"/>
	</form>
	<br /><br /><a href="./EleccionConsulta.php" >Inicio</a>
</body>

</html>
