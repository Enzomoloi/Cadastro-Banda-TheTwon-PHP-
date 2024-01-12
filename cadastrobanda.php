<?php
	$erro = null;
	$valido = false;		
	
	if(isset($_REQUEST["validar"]) && $_REQUEST["validar"]==true)
	{
		if(strlen(utf8_decode($_POST["nome_banda"]))<3)
		{
			$erro = "Preencha o campo nome corretamente(3 ou mais caracteres)";
		}
		else if(strlen(utf8_decode($_POST["DiaShow"]))==false)
		{
			$erro = "O campo data deve ser numérico";
		}
		else if(strlen(utf8_decode($_POST["DuracaoShow"]))==false)
		{
			$erro = "O campo duração deve ser numérico";
		}
		else if(strlen(utf8_decode($_POST["HorarioShowInicio"]))==false)
		{
			$erro = "O campo Tempo Inicial deve ser numérico";
		}
		else if(strlen(utf8_decode($_POST["HorarioShowFinal"]))==false)
		{
			$erro = "O campo Tempo Final deve ser numérico";
		}
		else if(strlen(utf8_decode($_POST["NomePalco"]))<3)
		{
			$erro = "Preecha o campo corretamente(3 ou mais caracteres)";
		}
		else
		{
			$valido = true;

			try
			{
				$connection = new PDO("mysql:host=localhost;dbname=TheTown", "root", "root");
				$connection->exec("set names utf8");
			}
			catch(PDOException $e)
			{
				echo "Falha : " . $e->getMessage();
				exit();
			}
			/*incio do codigo de conexao*/


		$sql = "INSERT INTO banda
					(nome_banda, DiaShow, DuracaoShow, HorarioShowInicio, HorarioShowFinal, NomePalco)
					VALUES (?, ?, ?, ?, ?, ?)";
					
			$stmt = $connection->prepare($sql);
			
			$stmt->bindParam(1, $_POST["nome_banda"]);
			$stmt->bindParam(2, $_POST["DiaShow"]);
			$stmt->bindParam(3, $_POST["DuracaoShow"]);
			$stmt->bindParam(4, $_POST["HorarioShowInicio"]);
			$stmt->bindParam(5, $_POST["HorarioShowFinal"]);
            $stmt->bindParam(6, $_POST["NomePalco"]);
			
			$stmt->execute();
			
			if($stmt->errorCode() != "00000")
			{
				$valido = false;
				$erro = "Erro código " . $stmt->errorCode() . ": ";
				$erro = implode(", ", $stmt->errorInfo());
			}
			/*fim do codigo de conexao*/
		}
	}
	
?>
<html>
	<head>
		<meta charset="UTF-8" /> 
		<title>Cadastro Banda</title>
		<link rel="stylesheet" href="csslegal.css"/>
		<div id=interface>
	</head>
	<body>

	<fieldset>
			<legend id=tituloprincipal>⠀⠀⠀Cadastro Banda⠀⠀⠀</legend>
			<?php
			if($valido == true)
			{
				echo "Dados enviados com sucesso !!!";
				?>
				 <p><a href="..\aula_menu.php">Menu Principal</a></p>
				<?php
			}
			else
			{
			
			if(isset($erro))
			{
				echo $erro . "<br /><br />";
			}
			?>
			<form method=POST action="?validar=true">
			<p>Nome da Banda: <input type=text name=nome_banda
			<?php if(isset($_POST["nome_banda"])) {echo "value= '" . $_POST["nome_banda"] . "'";} ?>
			></p>
			<p>Data do Show: <input type=date name=DiaShow
			<?php if(isset($_POST["DiaShow"])) {echo "value= '" . $_POST["DiaShow"] . "'";} ?>
			></p>
			<p>Duração: <input type=time name=DuracaoShow
			<?php if(isset($_POST["DuracaoShow"])) {echo "value= '" . $_POST["DuracaoShow"] . "'";} ?>
			></p>
			<p>Tempo Inicial: <input type=time name=HorarioShowInicio
			<?php if(isset($_POST["HorarioShowInicio"])) {echo "value= '" . $_POST["HorarioShowInicio"] . "'";} ?>
			></p>
			<p>Tempo Final: <input type=time name=HorarioShowFinal
			<?php if(isset($_POST["HorarioShowFinal"])) {echo "value= '" . $_POST["HorarioShowFinal"] . "'";} ?>
			></p>
			<p>Nome do Palco: <input type=text name=NomePalco
			<?php if(isset($_POST["NomePalco"])) {echo "value= '" . $_POST["NomePalco"] . "'";} ?>
			></p>
		
		<p><input type=reset value="Limpar"> <input type=submit value="Enviar"></p>
		</legend>
		</form>
		</fieldset>
		<?php
		}
		?>
	</body>
	</div>
</html>