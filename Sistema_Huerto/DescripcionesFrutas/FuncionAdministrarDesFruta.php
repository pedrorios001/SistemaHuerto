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
				$result = $db->query("select * from Des_Conjunto");
				$numfilas = $result->num_rows;
				echo "<table>";
				echo "<thead>";
				echo "<td>Valor</td>";
				echo "<td>Descripción</td>";
				echo "</thead>";
				for ($x=0; $x<$numfilas; $x++) {
					$fila = $result->fetch_object();
					echo "<tr>";
					echo "<td>" . $fila->ID_Des_Conjunto . "</td>";
					echo "<td>" . $fila->Descripcion . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				$result->free();
				$db->close();
			}
			echo "<hr />";
		?>
	<form action="./FuncionGestionDesFruta.php" method="POST" target="_self">		
		<?php
			switch($_POST['Gestion']){
				case "Agregar":
					echo "<input type='text' name='Gestion' value='Agregar' readonly/><span>Función</span><br /><br />";
					echo "Ingrese datos<br /><br />";
					echo "<input type='number' min='1' max='22' name='ID_Des_Conjunto' required/><span>Valor</span><br />";
					echo "<input type='text' name='Descripcion' maxlength='800' required/><span>Descripción</span>";
					break;
					
				case "Modificar":
					echo "<input type='text' name='Gestion' value='Modificar' readonly/><span>Función</span><br /><br />";
					echo "Buscar por Valor<br /><br />";
					echo "<input type='number' name='ID_Des_Conjunto' min='1' max='22' required/><span>Valor</span>";
					break;
					
				case "Eliminar":
					echo "<input type='text' name='Gestion' value='Eliminar' readonly/><span>Función</span><br /><br />";
					echo "Buscar por Valor<br /><br />";
					echo "<input type='number' name='ID_Des_Conjunto' min='1' max='22' required/><span>Valor</span>";
					break;
			}

		?>
		<br /><br /><input type="submit" value="Enviar"/>
		<input type="reset">
	</form>
	<br /><br /><a href="./AdministrarDesFruta.php" >Inicio</a>
</body>

</html>
