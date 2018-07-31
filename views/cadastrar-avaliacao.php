<div class="container">
	<h1>Cadastro de Avaliações</h1>
	<?php 
	if(!empty($msg)){
		echo $msg;
	}
	?>
	<form method="POST">
		<div class="form-group">
			<label for = "data_avaliacao">Data da Avaliação</label>
			<input type="date" name="data_avaliacao" id="data_avaliacao" class="form-control" />
		</div>

		<input type="submit" value="Cadastrar" class="btn btn-default" />
	</form>

</div>