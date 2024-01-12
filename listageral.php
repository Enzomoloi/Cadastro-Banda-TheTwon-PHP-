<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Lista Usuário</title>
		<link rel="stylesheet" href="CSSLISTALEGAL.css"/>
	</head>
	<body>
	<div id=interface>
	<fieldset>
	<legend id=tituloprincipal>The Town - Banda</legend>
		<table>
			<tr>
				<th>Código da Banda</th>
				<th>Nome da Banda</th>
				<th>Dia do Show</th>
				<th>Duração</th>
				<th>Horario de Inicio</th>
				<th>Horario Final</th>
				<th>Nome do Palco</th>
			</tr>
			
			<?php
			try
			{
				$connection = new PDO ("mysql:host=localhost;dbname=TheTown", "root", "root");
				$connection->exec("set names utf8");
			}
			catch(PDOException $e)
			{
				echo "Falha: " . $e->getMessage();
				exit();
			}
			
			
		
		$rs = $connection->prepare("SELECT * FROM banda");
			
			if($rs->execute())
			{
				while($registro = $rs->fetch(PDO::FETCH_OBJ))
				{
					echo "<tr>";
					echo "<td>" . $registro->cod_banda . "</td>";
						echo "<td>" . $registro->nome_banda . "</td>";
						echo "<td>" . $registro->DiaShow . "</td>";
						echo "<td>" . $registro->DuracaoShow . "</td>";
						echo "<td>" . $registro->HorarioShowInicio . "</td>";
						echo "<td>" . $registro->HorarioShowFinal . "</td>";
						echo "<td>" . $registro->NomePalco . "</td>";
						
						echo "<td>";
						 
			
						
						echo "</td>";
					echo "</tr>";
				}
			}else
				{
					echo "Falha na seleção de usuários <br/>";
				}
			?>
		</table>
		</fieldset>
		<p><a href="..\aula_menu.php">Menu Principal</a></p>
	</div>
	</body>
</html>