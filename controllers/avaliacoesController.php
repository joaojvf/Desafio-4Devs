<?php
class avaliacoesController extends controller{

	public function index(){
		$dados = array();
		$a = new Avaliacoes();

		$avaliacoes = $a->getListaAvaliacoes();
		$dados ['avaliacoes']=$avaliacoes;

		$this->loadTemplate('avaliacoes', $dados);
	}

	public function cadastrar(){
		$dados = array();
		$a = new Avaliacoes();

		if(isset($_POST['data_avaliacao']) && !empty($_POST['data_avaliacao'])){
			$data_avaliacao = addslashes($_POST['data_avaliacao']);			

			if(!empty($data_avaliacao)){
				$data_avaliacao = implode("-",array_reverse(explode("/",$data_avaliacao)));
				if($a->cadastrar($data_avaliacao) == true){

					$dados['msg']='<div class="alert alert-success">
					<strong>Parabéns avaliação cadastrada com sucesso!</strong>							
					</div>';

				}else{

					$dados['msg']='<div class="alert alert-warning"> 
					Já existe uma avaliação neste mês!
					</div>';

				}
			}else{

				$dados['msg']='<div class="alert alert-warning"> 
				Insira uma data. 
				</div>';
			}
		}
		$this->loadTemplate('cadastrar-avaliacao', $dados);
	}
}
?>