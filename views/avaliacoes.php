	<div class="container">
			<div class="jumbotron">
				<h2>Avaliações cadastradas:</h2>
			</div>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>Data da Avaliação</th>
						<th>NPS</th>
					</tr>
				</thead>
				<?php
				foreach($avaliacoes as $avaliacao):

					if($avaliacao['nps'] >=0 && $avaliacao['nps'] < 70){
						echo '<tr style="background-color: red";>';
					}else if($avaliacao['nps'] >= 60 && $avaliacao['nps'] < 80){
						echo '<tr style="background-color: yellow";>';
					}else if($avaliacao['nps'] >= 80 && $avaliacao['nps'] < 101){
						echo '<tr style="background-color: green";>';
					}
					?>
					<td><?php echo implode("/",array_reverse(explode("-",$avaliacao['data_avaliacao'])));?></td>
					<td><?php echo $avaliacao['nps']; ?></td>
					<td><a href="<?php echo BASE_URL; ?>clientes_avaliacoes/abrir/<?php echo $avaliacao['data_avaliacao']; ?>" class="btn btn-default">Abrir Avaliação</a></td>
					<?php 	echo "</tr>";

				endforeach; ?>
				
			</table>
		</div>