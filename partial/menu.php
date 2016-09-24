<div id="menu">
    <ul class="nav nav-pills">
<?php
    session_start();    
    if(empty($_SESSION['usuario'])){    
?>
        <li class="menuSelect"> <a href="index.php">Login</a> </li>        
<?php
    }
?>
        <li class="menuSelect"><a  href="createUsuario.php">Criar Usuário</a></li>
<?php
  
    if(!empty($_SESSION['usuario'])){    
?>    
        <li class="menuSelect"><a href="criarSala.php"> Criar Sala </a></li>
        <li class="menuSelect"><a href="removeSala.php"> Remoção de Salas </a></li>
        <li class="menuSelect"><a href="emprestimoSala.php"> Emprestimo de Salas </a></li>        
        <li class="menuSelect"><a href="devolucaoSala.php"> Devolução de Salas </a></li>   
        <li class="menuSelect"><a href="emprestimosRealizados.php"> Emprestimos Realizados </a></li>          
<?php
    }
?>    
    </ul>
</div>

