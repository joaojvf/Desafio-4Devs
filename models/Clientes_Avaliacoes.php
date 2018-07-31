<?php

	class Clientes_Avaliacoes extends model{

		public function getAvaliacao($data_avaliacao){ //Carrega uma avaliação a partir da data enviada.
			
			$array = array();

			$sql = $this->db->prepare("SELECT * FROM avaliacoes WHERE data_avaliacao = :data_avaliacao");
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->execute();

			if($sql->rowCount()>0){
				$array = $sql->fetch();
			}

			return $array;
		}

		public function validaQuantCli($data_avaliacao){ //Possibilita o usuário inserir até 20% dos clientes cadastrados.
			
			$sql = $this->db->query("SELECT nome_cliente FROM clientes");
			$totalClientes= $sql->rowCount();
			$totalClientes = $totalClientes * 20 / 100;

			$sql = $this->db->prepare("SELECT * FROM clientes_avaliacoes  WHERE data_avaliacao = :data_avaliacao ORDER BY nome_cliente ASC");
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->execute();
			$totalClientesAval= $sql->rowCount();

			if($totalClientesAval < $totalClientes){
				return  true;
			}else{
				return false;
			}
			
		}

		public function getListaClientesAvaliacao($data_avaliacao){//Gera uma lista de clientes cadastrados na avaliação recebida pela função.
			
			$array = array();

			$sql = $this->db->prepare("SELECT * FROM clientes_avaliacoes  WHERE data_avaliacao = :data_avaliacao ORDER BY nome_cliente ASC");
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->execute();

			if($sql->rowCount() >= 0) {
				$array = $sql->fetchAll();
			}

			return  $array;
		}

		public function cadastrarClienteAvaliacao($data_avaliacao, $nome_cliente){//Cadastra um cliente em uma determinada função, os SELECTS são feitos para validar se o cliente não participou de uma avaliação nos últimos 2 meses.
			
			$sql = $this->db->prepare("SELECT * FROM clientes_avaliacoes WHERE nome_cliente = :nome_cliente AND MONTH(DATE_ADD(data_avaliacao, INTERVAL 1 MONTH)) = MONTH(:data_avaliacao) AND YEAR(data_avaliacao) = YEAR(:data_avaliacao)");
			$sql->bindValue(":nome_cliente", $nome_cliente);
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->execute();

			if($sql->rowCount() == 0){

				$sql = $this->db->prepare("SELECT * FROM clientes_avaliacoes WHERE nome_cliente = :nome_cliente AND MONTH(DATE_ADD(data_avaliacao, INTERVAL 2 MONTH)) = MONTH(:data_avaliacao) AND YEAR(data_avaliacao) = YEAR(:data_avaliacao)");
				$sql->bindValue(":nome_cliente", $nome_cliente);
				$sql->bindValue(":data_avaliacao", $data_avaliacao);
				$sql->execute();

				if($sql->rowCount() == 0){
					$sql = $this->db->prepare("INSERT INTO clientes_avaliacoes SET nome_cliente = :nome_cliente, data_avaliacao = :data_avaliacao ");
					$sql->bindValue(":nome_cliente", $nome_cliente);
					$sql->bindValue(":data_avaliacao", $data_avaliacao);
					$sql->execute();

					return true;
				}else{
					return false;
				}	
			}else{

				return false;
			}
		}

		public function getAvaliacaoCliente($id){//Utilizada na view 'cliente-avaliao', essa função pega os dados da avaliação do cliente selecionado na view 'abrir-avaliacao'.
			$array = array();			

			$sql = $this->db->prepare("SELECT * FROM clientes_avaliacoes WHERE id = :id ");
			$sql->bindValue(":id", $id);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetch();
			}

			return $array;
		}

		public function salvarAvaliacao($id, $data_avaliacao, $nome_cliente, $resp_num, $resp_text){//Salva os dados da avaliação feita pelo cliente
			$array = array();
			
			$sql = $this->db->prepare("UPDATE clientes_avaliacoes SET data_avaliacao = :data_avaliacao, nome_cliente = :nome_cliente, resp_num = :resp_num, resp_text = :resp_text WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->bindValue(":nome_cliente", $nome_cliente);
			$sql->bindValue(":resp_num", $resp_num);
			$sql->bindValue(":resp_text", $resp_text);
			$sql->execute();
		}
	}

?>