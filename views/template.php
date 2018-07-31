<!DOCTYPE html>
<html>
	<head>
		<title>Desafio 4Devs</title>
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css" />
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="./" class="navbar-brand">Guia</a>
					<a href="<?php echo BASE_URL; ?>clientes" class="navbar-brand">Clientes</a>
					<a href="<?php echo BASE_URL; ?>avaliacoes" class="navbar-brand">Avaliacões</a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo BASE_URL; ?>clientes/cadastrar">Cadastre um Cliente</a></li>
					<li><a href="<?php echo BASE_URL; ?>avaliacoes/cadastrar">Cadastre uma Avaliacao</a></li>
				</ul>
			</div>
		</nav>

		<?php $this->loadViewInTemplate($viewName, $viewData); ?>

		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>

	</body>
</html>