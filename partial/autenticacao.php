<?php
if(!isset($_SESSION)) session_start();
if(!isset($_SESSION['id_usuario'])):
?>

<script type="text/javascript">
	alert("Você deve estar logado para realizar essa tarefa!");
	window.location.href = './';
</script>

<?php endif; ?>