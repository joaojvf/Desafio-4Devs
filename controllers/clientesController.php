<?php
class clientesController extends controller{

	public function  index(){
		$dados = array();
		$c = new Clientes();

		$clientes = $c->getListaClientes();
		$dados ['clientes']=$clientes;

		$this->loadTemplate('clientes', $dados);
	}

	public function cadastrar(){
		$dados = array();
		$c = new Clientes();

		if(isset($_POST['nome_cliente']) && !empty($_POST['nome_cliente'])){
			$nome_cliente = addslashes($_POST['nome_cliente']);
			$nome_responsavel = addslashes($_POST['nome_responsavel']);

			if(!empty($nome_cliente) && !empty($nome_responsavel)){
				if($c->cadastrar($nome_cliente, $nome_responsavel) == true){
					
					$dados['msg']='<div class="alert alert-success">
					<strong>Parabéns cliente cadastrado com sucesso!</strong>							
					</div>';
					
				}else{
					
					$dados['msg']='<div class="alert alert-warning">
					Esse cliente ja existe!
					</div>';		
				}

			}else{

				$dados['msg']='<div class="alert alert-warning">
				Preencha todos os campos.
				</div>';
			}
		}
		$this->loadTemplate('cadastrar-cliente',$dados);
	}
}
?>