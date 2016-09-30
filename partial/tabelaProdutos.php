<?php
	require 'classes/database.class.php';
	require 'classes/produtos.class.php';
	include_once 'funcoes.php';
	$produtos = new Produtos();

	$registros = $produtos->listProdutos();
	if($registros != false):
		?>
		<div class="table-responsive tabelaProdutos">
			<table id="tableProdutos" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Código</th>
						<th>Nome</th>
						<th>Tipo</th>
						<th>Valor</th>
						<th>Estoque</th>
						<?php if(isset($_SESSION['id_usuario'])): ?>
							<th>Ações</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th class="fieldPesquisa text-center">Nome</th>
						<th class="fieldPesquisa text-center">Tipo</th>
						<th></th>
						<th></th>
						<?php if(isset($_SESSION['id_usuario'])): ?>
							<th></th>
						<?php endif; ?>
					</tr>
				</tfoot>
				<tbody>
				<?php
					foreach($registros as $registro):
					?>
					<tr>
						<td><?=$registro->id_produto;?></td>
						<td><?=$registro->nome;?></td>
						<td><?=$registro->tipo;?></td>
						<td>R$ <?= str_replace('.', ',', $registro->valor); ?></td>
						<td><?=$registro->estoque;?></td>
						<?php if(isset($_SESSION['id_usuario'])): ?>
							<td class="text-center">
								<a href="#" class="btn btn-danger btn-small" title="Excluir" data-toggle="tooltip" onclick="excluirProduto(<?=$registro->id_produto?>)"><i class="fa fa-times"></i></a>
								<a href="addProdutos.php?method=editar&produto=<?=$registro->id_produto?>" class="btn btn-warning btn-small" title="Alterar" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
							</td>
						<?php endif; ?>
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
	function excluirProduto(Produto){
		bootbox.confirm("Você deseja realmente excluir o Produto?", function(result) {
			if(result == true){
				jQuery.ajax({
					type: "GET",
					url: "partial/excluirProduto.php",
					data: {Produto : Produto},
					dataType: "json",
					cache: false,
					error: function(data){
						console.log(data);
						alert('Oops, ocorreu um erro ao excluir Produto :(');
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
			                        location.href = "produtos.php";
			                    }, 1200);
					}
				});
			}
		}); 
	}
</script>