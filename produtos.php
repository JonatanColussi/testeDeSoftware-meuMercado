<?php 
include 'partial/header.php';
// include 'partial/autenticacao.php';
?>
<body>
	<?php include 'partial/navbar.php'; ?>
	<div class="container container-fluid">
	</script>
	<div class="row">
		<div id="errors"></div>
		<?php include 'partial/tabelaProdutos.php'; ?>
	</div>
</div>
</body>

<?php include_once 'partial/footer.php' ?>
<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
	$(document).ready(function() {
		$('#tableProdutos tfoot th.fieldPesquisa').each( function () {
	        var title = $(this).text();
	        $(this).html( '<input type="text" placeholder="Pesquisar por '+title+'" />' );
    	} );
		var table = $('#tableProdutos').DataTable({
			"language":{
				"sEmptyTable": "Nenhum registro encontrado",
				"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
				"sInfoFiltered": "(Filtrados de _MAX_ registros)",
				"sInfoPostFix": "",
				"sInfoThousands": ".",
				"sLengthMenu": "_MENU_ Resultados por página",
				"sLoadingRecords": "Carregando...",
				"sProcessing": "Processando...",
				"sZeroRecords": "Nenhum registro encontrado",
				"sSearch": "Pesquisar",
				"oPaginate": {
					"sNext": "Próximo",
					"sPrevious": "Anterior",
					"sFirst": "Primeiro",
					"sLast": "Último"
				},
				"oAria": {
					"sSortAscending": ": Ordenar colunas de forma ascendente",
					"sSortDescending": ": Ordenar colunas de forma descendente"
				}
			}
		});
		table.columns().every( function () {
	        var that = this;
	 
	        $( 'input', this.footer() ).on( 'keyup change', function () {
	            if ( that.search() !== this.value ) {
	                that
	                    .search( this.value )
	                    .draw();
	            }
	        } );
    	} );
	});
</script>