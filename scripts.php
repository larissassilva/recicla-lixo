

<!-- JQuery -->
<script src="plugins/jquery/jquery.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.js"></script>



<!-- Core  -->
<script src="plugins/bootstrap/bootstrap.js"></script>


<!-- DataTables -->
<script src="plugins/dataTables/jquery.dataTables.min.js"></script>

<script src="js/tabelas.js"></script>

<!-- Alert -->
<script src="plugins/alertify-js/alertify.js"></script>

<!-- Exibe mensagem de Erro -->
<script src="js/msgErro.js"></script>

<!-- AUTOCOMPLETE DOS CAMPOS OFF (datepicker) -->
<script src="js/autocomplete.js"></script>

<!-- Validation -->
<script src="plugins/validation/jquery.validate.js"></script>
<script src="plugins/validation/additional-methods.js"></script>

<!-- Modal -->
<script src="plugins/jquery/jquery.modal.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script> -->


<!-- Data Calendario -->
<script src="plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

<script>
	$(document).ready(function () {
		$("#fechar").click(function (event) {
			event.toElement.parentElement.click();
		})
	})

	// converter br em quebra de linha no textarea
	function nl2br(varTest){
		return varTest.replace(/<br>/g, "\n");
	};
</script>