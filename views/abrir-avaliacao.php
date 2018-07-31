<div class="container">
	<h1>Adicione clientes à avaliação</h1>
	
	<?php 
	if(!empty($msg)){
		echo $msg;
	}
	?>
	<form method="POST">
		<div class="form-group">
			<label for = "data_avaliacao">Data Avaliação: </label>
			<input type="text" name="data_avaliacao" id="data_avaliacao" class="form-control"  value="<?php echo $info['data_avaliacao'];?>"readonly="true" />
		</div>
		<div class="form-group">
			<label for = "nome_cliente">Adicionar Cliente: </label>
			<input type="text" name="nome_cliente" id="nome_cliente" class="form-control"/>
		</div>

		<input type="submit" value="Adicionar" class="btn btn-default" />
	</form>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Clientes cadastrados nessa avaliação: </th>
			</tr>
		</thead>
		<?php foreach($lista as $lc):?>
			<tr>
				<td><?php echo $lc['nome_cliente']; ?></td>
				<td> <a href="<?php echo BASE_URL; ?>clientes_avaliacoes/registrar/<?php echo $lc['id'];?>"class="btn btn-default">Avaliar</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>