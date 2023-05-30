<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Juego</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Geany 1.32" />
		<link rel="stylesheet" type="text/css" href="../CSS/style.css">
	</head>

	<body>
		<script>
			<!--
				var Contador = 0; var Elec = new Array(0, 0, 0, 0);
				var ModoJ, ElecModoJ = "S";
				
				function ModoJugar(){
					ModoJ = document.getElementById("ModoJuego");
					ElecModoJ = ModoJ.options[ModoJ.selectedIndex].value;
				}
				
				function CambiarImg(ImagenE, Fruta){
					Bandera = true;
					for(i = 0; i < 4; i++){
						if (Elec[i] == Fruta){
							Bandera = false;
						}
					}
					if(Bandera){
						if(Contador < 4){
							Elec[Contador] = Fruta;
							ImagenE = "Img" + ImagenE;
							document.getElementById(ImagenE).src="../Img/" + Fruta + ".jpg";
						}
						Contador += 1;
						if(Contador == 4){
							IngresarJuego();
						}
					}
				}
				
				function ObjetoRequest(){
					try{
						Objeto = new XMLHttpRequest();
					} catch(error1){
						try{
							Objeto = new ActiveXObject("Msxm12.XMLHTTP");
						} catch(error2){
							try{
								Objeto = new ActiveXObject("Microsoft.XMLHTTP");
							} catch(error3){
								Objeto = false;
							}
						}
					}
					return Objeto;
				}

				var ObjAjax = new ObjetoRequest();
							
				function MuestraResultado(){
					if (ObjAjax.readyState == 4 && ObjAjax.status == 200){
						alert("Juego registrado");
						var Respuesta = ObjAjax.responseText;
						/*alert(Respuesta);*/
						document.getElementById("txtaResultado").value = Respuesta;
					}
				}
				
				function IngresarJuego(){
					var URL = "./Algoritmo.php";
					ObjAjax.open("POST", URL, true);
					ObjAjax.onreadystatechange = MuestraResultado;
					ObjAjax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					ObjAjax.send("fruta1=" + Elec[0] + "&fruta2=" + Elec[1] + "&fruta3=" + Elec[2] + "&fruta4=" + Elec[3] + "&ElecModo=" + ElecModoJ);
				}
				
			//-->
		</script>
		<header>
			<?php
				session_start();
				$Usuario = $_SESSION["Usuario"];
				$Contrasena = $_SESSION["Contrasena"];
				if($Usuario == "root") {
					echo "<a class='sesion' onClick='self.close();'>Cerrar</a>";
				} else {
					echo "<a class='sesion' href='../Logout.php'>Cerrar Sesión</a>";
				}	
			?>
			<h1 style="color:red">Cultivos de frutas</h1>
		</header>
		<?php
			$db = new mysqli("localhost", $Usuario, $Contrasena, "Huerto");
			if ($db->connect_error) {
				echo "<script>alert('Conexión fallida');</script>";
				if($Usuario == "root") {
					echo "<script>self.close();</script>";
				} else {
					echo "<script>parent.location = '../index.html';</script>";
				}	
				/*die("Conexión fallida: " . $conn->connect_error);*/
			} else {
				$CantFrut = $db->query("SELECT COUNT(*) AS Fila FROM Frutas");
				$FilaF = $CantFrut->fetch_object();
				if ($FilaF->Fila < 22) {
					echo "<script>alert('Debe ingresar las 22 frutas antes de poder jugar');</script>";
					if($Usuario == "root") {
						echo "<script>self.close();</script>";
					} else {
						echo "<script>parent.location = '../index.html';</script>";
					}	
				}
			}
		?>
		<div>
			<select id="ModoJuego" name="ModoJuego" onChange="ModoJugar()">
				<option value="S" selected>Saludables</option>
				<option value="A">Amargos</option>
				<option value="F">Familiares</option>
				<option value="T">Transgenico</option>
				<option value="V">Viñedo</option>
			</select>
			<br /><br />
			<hr />
			<br />
			<?php
				$Fruta = range(1, 22);
				shuffle($Fruta);
				for($Num=0; $Num<22; $Num++){
					$Numero = "Img" . $Num;
					echo "<img id='" . $Numero . "' src='../Img/Baraja.jpg' border ='3px' width='100px' height='150px' alt='Imágen de ' onClick='CambiarImg(" . $Num . ", " . $Fruta[$Num] . ")'/>";
				}
			?>
		</div>
		<div style="height:330px;" >
			<h2>Resultado</h2>
			<textarea id="txtaResultado" cols="100" style="height:220px;" disabled></textarea>
		</div>
		<button onClick="parent.location = '../Juego/Principal.php';">Juego nuevo</button>
	</body>
</html>
