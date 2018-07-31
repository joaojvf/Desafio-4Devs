<?php
	class Avaliacoes extends model{

		public function cadastrar($data_avaliacao){

			$sql = $this->db->prepare("SELECT * FROM avaliacoes WHERE MONTH(data_avaliacao) = MONTH(:data_avaliacao) AND YEAR(data_avaliacao) = YEAR(:data_avaliacao)");
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->execute();
			if($sql->rowCount()==0){

					$sql = $this->db->prepare("INSERT INTO avaliacoes SET data_avaliacao = :data_avaliacao");
					$sql->bindValue(":data_avaliacao", $data_avaliacao);
					$sql->execute();
					return true;
			}else{
				return false;
			}
		}

		public function getListaAvaliacoes(){ //Lista todas as avaliações
			$array = array();

			$sql = $this->db->prepare("SELECT * FROM avaliacoes ORDER BY data_avaliacao DESC");
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchALL();
			}

			return  $array;
		}

		public function getAvaliacao($data_avaliacao){//Busca uma avaliação de acordo com a data
			$array = array();

			$sql = $this->db->prepare("SELECT * FROM avaliacoes WHERE data_avaliacao = :data_avaliacao");
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->execute();

			if($sql->rowCount()>0){
				$array = $sql->fetch();
			}

			return $array;
		}

		public function calcularNPS($data_avaliacao){//Insere o NPS de cada avaliação. A fórmula de calcular é: NPS = ((total de promotores - total de detratores) / total de participantes) * 100
			$sql = $this->db->prepare("SELECT * FROM clientes_avaliacoes AS ca, clientes AS c WHERE c.nome_cliente = ca.nome_cliente AND ca.data_avaliacao = :data_avaliacao AND c.categoria ='Detrator'");
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->execute();			
			$detratores = $sql->rowCount();
			
			$sql = $this->db->prepare("SELECT * FROM clientes_avaliacoes AS ca, clientes AS c WHERE c.nome_cliente = ca.nome_cliente AND ca.data_avaliacao = :data_avaliacao AND c.categoria ='Promotor'");
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->execute();			
			$promotores = $sql->rowCount();

			$sql = $this->db->prepare("SELECT * FROM clientes_avaliacoes AS ca, clientes AS c WHERE c.nome_cliente = ca.nome_cliente AND ca.data_avaliacao = :data_avaliacao");
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->execute();
			$totalParticipantes = $sql->rowCount();

			$nps = (($promotores - $detratores) / $totalParticipantes) * 100;
			if($nps < 0){
				$nps = 0;
			}

			$sql = $this->db->prepare("UPDATE avaliacoes SET nps = :nps WHERE avaliacoes.data_avaliacao = :data_avaliacao");
			$sql->bindValue(":data_avaliacao", $data_avaliacao);
			$sql->bindValue(":nps", $nps);
			$sql->execute();

		}
	}
?>