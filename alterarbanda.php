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

			/*incio do codigo de conexao*/

			try
			{
				$connection = new PDO ("mysql: host=localhost;dbname=TheTown", "root", "root");
				$connection->exec("set names utf8");
			}
			catch(PDOException $e)
			{
				echo "Falha: " . $e->getMessage(); 
				exit();
			}
		
		$sql = "UPDATE banda SET 
					nome_banda =?, DiaShow = ?, DuracaoShow = ?, HorarioShowInicio = ?, 
					HorarioShowFinal = ?, NomePalco = ? WHERE cod_banda = ?";
					
			$stmt = $connection->prepare($sql);
			
			$stmt->bindParam(1, $_POST["nome_banda"]);
			$stmt->bindParam(2, $_POST["DiaShow"]);
			$stmt->bindParam(3, $_POST["DuracaoShow"]);
			$stmt->bindParam(4, $_POST["HorarioShowInicio"]);
			$stmt->bindParam(5, $_POST["HorarioShowFinal"]);
            $stmt->bindParam(6, $_POST["NomePalco"]);
			$stmt ->bindParam(7, $_POST["cod_banda"]);	
			
			$stmt ->execute ();
			
			if($stmt->errorCode() != "00000")
			{
				$valido = false;
				$erro = "Erro código " . $stmt->errorCode() . ": ";
				$erro = implode(", ", $stmt->errorInfo());
			}
			/*fim do codigo de conexao*/
		
	
	/*incio do codigo de alteração*/
	else
	{
		$rs = $connection->prepare("SELECT * FROM banda WHERE cod_banda = ?");
		$rs->bindParam(1, $_REQUEST["cod_banda"]);
		
		if($rs->execute())
		{
			if($registro = $rs->fetch(PDO::FETCH_OBJ))
			{
				$_POST["nome_banda"] = $registro->nome_banda;
				$_POST["DiaShow"] = $registro->DiaShow;
				$_POST["DuracaoShow"] = $registro->DuracaoShow;
				$_POST["HorarioShowInicio"] = $registro->HorarioShowInicio;
				$_POST["HorarioShowFinal"] = $registro->HorarioShowFinal;
				$_POST["NomePalco"] = $registro->NomePalco;

				
			}
			else
			{
				$erro = "Registro não encontrado";
			}
			
		}
		else
		{
			$erro = "Falha na captura do registro";
		}
		
	}
}
	}	
	
	/*fim do codigo de alteração*/
?>
<html>
	<head>
		<meta charset="UTF-8" /> 
		<title>Alterar - Banda</title>
		<link rel="stylesheet" href="csslegal.css"/>
		<div id=interface>
	</head>
	<body>
		<fieldset>
		<legend id=tituloprincipal>⠀⠀⠀Alterar Dados da Banda⠀⠀⠀</legend>
			<?php
			if($valido == true)
			{
				echo "Dados alterados com sucesso !!!";
				?>
				<p><a href="lista_bandaalterar.php"> Voltar </a></p>
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
			<p>Data: <input type=date name=DiaShow
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
		
		
			<input type=hidden name=cod_banda value="<?php echo $_REQUEST["cod_banda"]; ?>">
			
		 <!-- <p>Senha: <input type=password name=senha></p> apagar essa linha-->
		
		<p><input type=reset value="Limpar"> <input type=submit value="Alterar"></p>
		</legend>
		</form>
		<?php
		}
		?>
	</body>
</html>
		