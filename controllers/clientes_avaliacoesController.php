<?php
class clientes_avaliacoesController extends controller{

	public function index(){

	}

	public function abrir($data_avaliacao){
		$dados = array();

		$ca = new Clientes_Avaliacoes();
		$ca2= new Clientes_Avaliacoes();

		if(isset($_POST['data_avaliacao']) && !empty($_POST['data_avaliacao'])){
			$nome_cliente   = addslashes($_POST['nome_cliente']);
			$data_avaliacao   = addslashes($_POST['data_avaliacao']);

			if(!empty($data_avaliacao) && !empty($nome_cliente)){
				if($ca->validaQuantCli($data_avaliacao)){
					if($ca->cadastrarClienteAvaliacao($data_avaliacao, $nome_cliente)){
						
						$dados['msg']='<div class="alert alert-success">
						<strong>Parabéns cliente inserido com sucesso!</strong>							
						</div>';

					}else{

						$dados['msg']='<div class="alert alert-warning"> O cliente ainda não pode realizar outra avaliação!</div>';

					}
				}else{

					$dados['msg']='<div class="alert alert-warning"> Quantidade máxima de clientes já inserida!</div>';

				}					
			}else{

				$dados['msg']='<div class="alert alert-warning">
				Adicione um cliente.
				</div>';

			}
		}
		if(isset($data_avaliacao) &&!empty($data_avaliacao)){
			$info= $ca->getAvaliacao($data_avaliacao);
		}else{

			$dados['msg']='<div class="alert alert-warning">
			Nome do cliente inválido!
			</div>';
				//exit;
		}

		$lista=$ca2->getListaClientesAvaliacao($data_avaliacao);
		$dados['lista']=$lista;
		$info= $ca->getAvaliacao($data_avaliacao);
		$dados['info']=$info;

		$this->loadTemplate('abrir-avaliacao', $dados);	
	}

	public function registrar($id){

		$dados = array();
		$ca = new Clientes_Avaliacoes();
		$a = new Avaliacoes();

		if(isset($_POST['data_avaliacao']) && !empty($_POST['data_avaliacao'])){
			$data_avaliacao = addslashes($_POST['data_avaliacao']);
			$nome_cliente = addslashes($_POST['nome_cliente']);
			$resp_num = addslashes($_POST['resp_num']);
			$resp_text = addslashes($_POST['resp_text']);

			$data_avaliacao = implode("-",array_reverse(explode("/",$data_avaliacao)));
			$ca->salvarAvaliacao($id, $data_avaliacao, $nome_cliente, $resp_num, $resp_text);
			$a->calcularNPS($data_avaliacao);
			
			$dados['msg']='<div class="alert alert-success">
			<strong>Parabéns avaliação concluída!</strong>
			</div>';
			
		}

		if(isset($id) && !empty($id)){

			$info = $ca->getAvaliacaoCliente($id);
			$dados['info']=$info;

		}else{
			$dados['msg']='<div class="alert alert-warning">
			Não altere a data da avaliação!
			</div>';
			//exit;
		}	
		$this->loadTemplate('cliente-avaliacao', $dados);
	}
	
}
?>