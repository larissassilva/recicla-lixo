<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include_once 'classes/DAOFornecedor.class.php';
include_once 'classes/DAOTipo.class.php';
include_once 'classes/DAOMaterial.class.php';
include_once 'classes/DAORecicla.class.php';
?>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--funiona na Internet-->
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">-->
<!--funiona localmente-->

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/meucss.css">
<link rel="stylesheet" href="css/alertify.css">
<link rel="stylesheet" src="plugins/jquery/jquery.modal.min.css">


	<?php
	include_once 'classes/DAOFornecedor.class.php';
include_once 'classes/DAOTipo.class.php';
include_once 'classes/DAOMaterial.class.php';
include_once 'classes/DAORecicla.class.php';
?>
	
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



	<!-- Trigger/Open The Modal -->
<div>


<img src="img/E-LIXO.jpg" alt="">


</div>
<!--<div class="container ">

<p>Cadastrar</p>
</div>-->

<div class="container ">
<p>O maior fornecedor é:</p>

<?php

										   $dao = new DAORecicla();
    $lista= $dao->listarEspecial('SELECT f.nome as nome, SUM(r.peso) as peso FROM recicla as r JOIN fornecedor as f on (r.idfornecedor=f.idfornecedor) GROUP BY f.nome');
    // json_encode($lista);

var_dump($lista);


                                                
    ?>

</div>
</br>

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
<script src="plugins/datatables/jquery-3.3.1.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="js/tabelas.js"></script>
<script src="js/msgErro.js"></script>
<script src="js/select2.min.js"></script>
<?php include_once "scripts.php";?>
<script src="js/recicla.js"></script>

 <!-- <script>
    $(document).ready(function() {
       
        // $('#example').DataTable();
        $('#tabelaRecicla').DataTable(
          
            );
    } );
</script>  -->
</body>

</html>
