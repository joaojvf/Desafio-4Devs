		<div class="container">
			<div class="jumbotron">
				<h2>Clientes cadastrados:</h2>
			</div>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nome do Cliente</th>
						<th>Nome do Responsável</th>
						<th>Categoria</th>
						<th>Data do Registro</th>
					</tr>
				</thead>
				<?php foreach($clientes as $cliente):?>
					<tr>
						<td><?php echo $cliente['nome_cliente']; ?></td>
						<td><?php echo $cliente['nome_responsavel']; ?></td>
						<td><?php echo $cliente['categoria']; ?></td>
						<td><?php echo implode("/",array_reverse(explode("-",$cliente['data_registro']))); ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>