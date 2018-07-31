<?php
	class Clientes extends model{

		public function cadastrar($nome_cliente, $nome_responsavel){//Insere um cliente e adiciona a categoria "Neutro",caso o cliente  com o mesmo nome já tenha sido inserido, o insert não é realizado.
			
			$sql = $this->db->prepare("SELECT id FROM clientes WHERE nome_cliente = :nome_cliente");
			$sql->bindValue(":nome_cliente", $nome_cliente);
			$sql->execute();

			if($sql->rowCount() == 0){
				$sql = $this->db->prepare("INSERT INTO clientes SET nome_cliente = :nome_cliente, nome_responsavel = :nome_responsavel, data_registro = now()");
				$sql->bindValue(":nome_cliente", $nome_cliente);
				$sql->bindValue(":nome_responsavel", $nome_responsavel);
				$sql->execute();

				$sql = $this->db->prepare("UPDATE clientes SET categoria = 'Neutro' WHERE nome_cliente = :nome_cliente");
				$sql->bindValue(":nome_cliente", $nome_cliente);
				$sql->execute();

				return true;
			}else{
				return false;
			}
		}

		public function getListaClientes(){//Lista todos o clientes
			
			$array = array();

			$sql = $this->db->prepare("SELECT * FROM clientes ORDER BY nome_cliente ASC");
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchALL();
			}

			return  $array;
		}

	}
?>