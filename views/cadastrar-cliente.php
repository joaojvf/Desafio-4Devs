<div class="container">
	<h1>Cadastro de Cliente</h1>
	<?php 
	if(!empty($msg)){
		echo $msg;
	}
	?>
	<form method="POST">
		<div class="form-group">
			<label for = "nome_cliente">Nome do Cliente</label>
			<input type="text" name="nome_cliente" id="nome_cliente" class="form-control" />
		</div>
		<div class="form-group">
			<label for = "nome_responsavel">Nome do Responsavel</label>
			<input type="text" name="nome_responsavel" id="nome_responsavel" class="form-control" />
		</div>
		<input type="submit" value="Cadastrar" class="btn btn-default" />			
	</form>

</div>