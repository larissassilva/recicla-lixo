<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--funiona na Internet-->
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">-->
<!--funiona localmente-->

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/meucss.css">
<link rel="stylesheet" href="css/alertify.css">
<link rel="stylesheet" src="plugins/jquery/jquery.modal.min.css">

	
</head>
<body>

	<div class="header">
		<a href="#default" class="logo">ReciclaElixo</a>
		<div class="header-right">
			<a class="active" href="index.php">Início</a>
			<a href="contato.php">Contato</a>
			<a href="sobre.php">Sobre</a>
		</div>
		<h5>Software de gestão de coleta seletiva de Lixo Eletrônico</h5>
	</div>


	<h2>Cadastro de Tipo de Elixo</h2>

	<!-- Trigger/Open The Modal -->
	<button id="novo_cadastro" type="button" class="button2" data-target="#modalCadastrar" data-toggle="modal">Cadastrar Novo</button>
<div class="container">
	<div class="table-responsive">
		<table class="table table-hover table-striped width-full" id="tabelaTipo">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tipo</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div> 

</div>

<!-- The Modal Cadastrar -->
<div class="modal fade modal-primary" id="modalCadastrar" aria-hidden="true" aria-labelledby="modalCadastrar" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content modal-content2">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Cadastrar Tipo Elixo</h4>
			</div>
			<form id="form-cadastrar" action="" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="">
							<div class="form-group">

								<div class="modal2">
									<label for="fname">Tipo</label>
									<input type="text" name="tipo" class="tipo" placeholder="" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
                        <div class="modal-footer">
                            <div class="col-lg-12">
                                <button type="button" class="button3" data-dismiss="modal">Cancelar</button>
                                <button id="salvar" type="submit" class="button2">Salvar</button>
                            </div>
                        </div>
                    </div>
			</form>
		</div>
	</div>
</div>

<!-- The Modal Editar -->
<div class="modal fade modal-primary" id="modalEditar" aria-hidden="true" aria-labelledby="modalEditar" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content modal-content2">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Editar / Visualizar Tipo Elixo</h4>
			</div>
			<form id="form-editar" action="" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="">
							<div class="form-group">

								<div class="modal2">
									<label for="fname">Tipo</label>
									<input id="tipo" type="text" name="tipo" class="tipo" placeholder="" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
                        <div class="modal-footer">
                            <div class="col-lg-12">
                                <button id="excluir" type="button" class="button4">Excluir</button>
                                <button type="button" class="button3" data-dismiss="modal">Cancelar</button>
                                <button id="editar" type="button" class="button2">Editar</button>
                            </div>
                        </div>
                    </div>
			</form>
		</div>
	</div>
</div>

<!-- <div class="modal fade modal-primary" id="modalEditar" aria-hidden="true" aria-labelledby="modalEditar" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Editar ou Visualizar Fornecedor</h4>
			</div>
			<form id="form-editar" action="" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="">
							<div class="form-group">

								<div class="modal2">
									<label for="fname">Tipo</label>
									<input type="text" id="tipo" name="tipo" class="tipo" placeholder="">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
                        <div class="modal-footer">
                            <div class="col-lg-12">
                            	<button id="excluir" type="button" class="button4">Excluir</button>
                                <button type="button" class="button3" data-dismiss="modal">Cancelar</button>
                                <button id="editar" type="submit" class="button2">Editar</button>
                            </div>
                        </div>
                    </div>
			</form>
		</div>
	</div>
</div> -->

</br>


<div class="footer">
	<footer>
		<p>ReciclaElixo © 2019</p>
	</footer>
</div>
<!--funiona na Internet-->
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>-->

<!--funiona localmente-->
 <!--incluir tudo porque não tem Internet-->
<!--<script src="js/datatable.js"></script>-->


<script src="plugins/datatables/jquery-3.3.1.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="js/tabelas.js"></script>
<script src="js/msgErro.js"></script>
<?php include_once "scripts.php";?>
<script src="js/tipo.js"></script>

<!-- <script>
    $(document).ready(function() {
       
        // $('#example').DataTable();
        $('#tabelaTipo').DataTable(
          
            );
    } );
</script> -->
</body>
</html>
