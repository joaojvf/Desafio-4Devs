		<div class="container">
			<h1>Responda a Avaliação</h1>
			<?php 
			if(!empty($msg)){
				echo $msg;
			}
			?>

			<form method="POST">
				<div class="form-group">
					<label for = "data_avaliacao">Data Avaliação: </label>
					<input type="text" name="data_avaliacao" id="data_avaliacao" class="form-control"  value="<?php echo $info['data_avaliacao']; ?>" readonly="true" />
				</div>
				<div class="form-group">
					<label for = "nome_cliente">Cliente: </label>
					<input type="text" name="nome_cliente" id="nome_cliente" class="form-control" value="<?php echo $info['nome_cliente']; ?>" readonly="true" />
				</div>
				<div class="form-group">
					<label for="resp_num">Em uma escala de 0 a 10, qual a probabilidade de você recomendar nosso produto/serviço a um amigo/conhecido?</label>
					<select name="resp_num" id="resp_num" class="form-control">
						<option value="0" <?php echo ($info['resp_num']=='0')?'selected="selected"':''; ?>>0</option>
						<option value="1" <?php echo ($info['resp_num']=='1')?'selected="selected"':''; ?>>1</option>
						<option value="2" <?php echo ($info['resp_num']=='2')?'selected="selected"':''; ?>>2</option>
						<option value="3" <?php echo ($info['resp_num']=='3')?'selected="selected"':''; ?>>3</option>
						<option value="4" <?php echo ($info['resp_num']=='4')?'selected="selected"':''; ?>>4</option>
						<option value="5" <?php echo ($info['resp_num']=='5')?'selected="selected"':''; ?>>5</option>
						<option value="6" <?php echo ($info['resp_num']=='6')?'selected="selected"':''; ?>>6</option>
						<option value="7" <?php echo ($info['resp_num']=='7')?'selected="selected"':''; ?>>7</option>
						<option value="8" <?php echo ($info['resp_num']=='8')?'selected="selected"':''; ?>>8</option>
						<option value="9" <?php echo ($info['resp_num']=='9')?'selected="selected"':''; ?>>9</option>
						<option value="10" <?php echo ($info['resp_num']=='10')?'selected="selected"':''; ?>>10</option>
					</select>
				</div>
				<div class="form-group">
					<label for="resp_text">Qual é o motivo dessa nota?</label>
					<textarea class="form-control" name="resp_text"><?php echo $info['resp_text']; ?></textarea>
				</div>
				<input type="submit" value="Salvar" class="btn btn-default" />
			</form>

		</div>