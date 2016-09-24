<?php
	require 'classes/database.class.php';
	require 'classes/consultas.class.php';
	include_once 'funcoes.php';
	$consultas = new Consultas();

	$registros = $consultas->listConsultas();
	if($registros != false):
		?>
		<div class="table-responsive tabelaConsultas">
			<table id="tableConsultas" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Medico</th>
						<th>Especialidade</th>
						<th>Data</th>
						<th>Horário</th>
						<th>Status</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Medico</th>
						<th>Especialidade</th>
						<th>Data</th>
						<th>Horário</th>
						<th>Status</th>
						<th>Ações</th>
					</tr>
				</tfoot>
				<tbody>
				<?php
					foreach($registros as $registro):
					?>
					<tr>
						<td><?=$registro->medico;?></td>
						<td><?=$registro->especialidade;?></td>
						<td><?=dataExibicao($registro->data);?></td>
						<td><?=formataHora($registro->horarioInicial);?></td>
						<td>
							<?php
								date_default_timezone_set('America/Sao_Paulo');
	        					if($registro->data > date('Y-m-d'))
	        						echo 'Consulta à realizar';
	        					else
	        						echo 'Consulta realizada'
							?>
						</td>
						<td>
							<?php 
								if(($registro->data == date('Y-m-d') && date('H:i:s') <= date('H:i:s', strtotime("-2 hours", strtotime($registro->horarioInicial)))) || $registro->data > date('Y-m-d')): 
							?>
								<a href="#" class="btn btn-danger btn-small" title="Cancelar" data-toggle="tooltip" onclick="excluirConsulta(<?=$registro->id?>)"><i class="fa fa-times"></i></a>
								<a href="agendar.php?method=reagendar&consulta=<?=$registro->id?>" class="btn btn-success btn-small" title="Reagendar" data-toggle="tooltip"><i class="fa fa-calendar"></i></a>
								<?php
								else: 
								?>
								<a href="#" class="btn btn-danger btn-small disabled" title="Cancelar" data-toggle="tooltip"><i class="fa fa-times"></i></a>
								<a href="#" class="btn btn-success btn-small disabled" title="Reagendar" data-toggle="tooltip"><i class="fa fa-calendar"></i></a>
							<?php 
								endif; 
							?>
						</td>
					</tr>
					<?php
						endforeach;
					?>
				</tbody>
			</table>
			<div style="height: 5em;"></div>
		</div>
		<?php
	else:
		echo $registros;
	endif;
?>
<script>
	function excluirConsulta(consulta){
		bootbox.confirm("Você deseja realmente cancelar a consulta?", function(result) {
			if(result == true){
				jQuery.ajax({
					type: "GET",
					url: "partial/cancelarConsulta.php",
					data: {consulta : consulta},
					dataType: "json",
					cache: false,
					error: function(data){
						console.log(data);
						alert('Oops, ocorreu um erro ao cancelar a consulta :(');
					},
					success: function(data){
						$("#errors")
		                    .html(data[1])
		                    .hide()
		                    .css('opacity', 0)
		                    .slideDown('slow')
		                    .animate(
		                        { opacity: 1 },
		                        { queue: false, duration: 'slow' }
		                        );
		                    if(data[0] == true)
			                    setTimeout(function(){
			                        location.href = "minhas-consultas.php";
			                    }, 1200);
					}
				});
			}
		}); 
	}
</script>