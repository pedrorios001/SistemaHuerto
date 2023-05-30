<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.32" />
	<link rel="stylesheet" type="text/css" href="../CSS/style.css">
	<script language="javascript">
		<!--
		function Calculo(){
			var Fruta1 = parseInt(document.getElementById("TxtNum1").value);
			var Fruta2 = parseInt(document.getElementById("TxtNum2").value);
			if(Fruta1!=Fruta2){
				if(Fruta1<=22 && Fruta2<=22 && Fruta1>=1 && Fruta2>=1){
					var IDPar = (Fruta1 - 1) * 22 + Fruta2;
	/*				var IDPar2 = (Fruta2 - 1) * 22 + Fruta1;
					if(IDPar1 < IDPar2){
						IDPar = IDPar1;
					}else{
						IDPar = IDPar2;
					}*/
					document.getElementById("ID_Des_Par").value = IDPar;
				}else{
					alert("El valor de las frutas debe estar entre 1 y 22");
				}
			}else{
				alert("El valor de las frutas debe ser distinto");
			}
		}
		//-->
	</script>
	<noscript>
		<p>Su navegador no soporta scripts.</p>
	</noscript>
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
			if ($_POST['Gestion'] != "Consultar"){
				$result = $db->query("select * from Frutas");
				$numfilas = $result->num_rows;
				echo "<table>";
				echo "<thead>";
				echo "<td>Nombre</td>";
				echo "<td>Valor</td>";
				echo "</thead>";
				for ($x=0; $x<$numfilas; $x++) {
					$fila = $result->fetch_object();
					echo "<tr>";
					echo "<td>" . $fila->Nombre . "</td>";
					echo "<td>" . $fila->Valor . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				$result->free();
				$db->close();
				echo "<hr />";
				echo "<input type='number' id='TxtNum1' min='1' max='22' required/><span>Segunda Fruta</span>";
				echo "<input type='number' id='TxtNum2' min='1' max='22' required/><span>Cuarta Fruta</span>";
				echo "<button onClick='Calculo()'>Calcular ID de la descripción</button><br /><br />";
			}
		}
	?>
	<form action="./FuncionGestionDesFrutaPar.php" method="POST" target="_self">		
		<?php
			switch($_POST['Gestion']){
				case "Agregar":
					echo "<input type='text' name='Gestion' value='Agregar' required readonly/><span>Función</span><br /><br />";
					echo "Ingrese datos<br /><br />";
					echo "<input type='number' min='2' max='483' id='ID_Des_Par' name='ID_Des_Par' required/><span>Identificador</span><br />";
					echo "<input type='text' name='Descripcion' maxlength='800' required/><span>Descripción</span>";
					break;
					
				case "Modificar":
					echo "<input type='text' name='Gestion' value='Modificar' required readonly/><span>Función</span><br /><br />";
					echo "Buscar por Valor<br /><br />";
					echo "<input type='number' min='2' max='483' id='ID_Des_Par' name='ID_Des_Par' required/><span>Identificador</span>";
					break;
					
				case "Eliminar":
					echo "<input type='text' name='Gestion' value='Eliminar' required readonly/><span>Función</span><br /><br />";
					echo "Buscar por Valor<br /><br />";
					echo "<input type='number' min='2' max='483' id='ID_Des_Par' name='ID_Des_Par' required/><span>Identificador</span>";
					break;
					
				case "Consultar":
					echo "<input type='text' name='Gestion' value='Consultar' required readonly/><span>Función</span><br /><br />";
					echo "Tipo de descripción<br /><br />";
					break;
					
			}
			echo "<select id='Des_Par' name='Des_Par'>";
				echo "<option value='Saludables' selected>Saludables</option>";
				echo "<option value='Amargos'>Amargos</option>";
				echo "<option value='Familiares'>Familiares</option>";
				echo "<option value='Transgenicos'>Transgenico</option>";
				echo "<option value='Vinero'>Viñedo</option>";
			echo "</select>";
		?>
		<br /><br /><input type="submit" value="Enviar"/>
		<input type="reset">
	</form>
	<br /><br /><a href="./AdministrarDesFrutaPar.php" >Inicio</a>
</body>

</html>
