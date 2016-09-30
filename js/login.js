jQuery(document).ready(function($) {
    
    $('#logar').click(function() {
        if($('#usuario').val() === ""){
            alert('Voce deve informar um usuario!');
        }
        else if($('#senha').val() === ""){
            alert('Voce deve informar uma senha!');
        }
        else{
            dados = {
                "acao": "loginUsuario",
                "dataSource" : {              
                    "usuario": $('#usuario').val(),
                    "senha": $('#senha').val()            
                }        
            };    

            $.ajax({ 
                type: 'POST',                         
                url: 'partial/login.php',
                async: true,
                complete: function(rsp){
                    console.log(rsp);
                    if(rsp.responseText == 1){
                        $("#errors")
                        .html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Usuário com acesso liberado</strong></div>')
                        .hide()
                        .css('opacity', 0)
                        .slideDown('slow')
                        .animate(
                            { opacity: 1 },
                            { queue: false, duration: 'slow' }
                            );
                        setTimeout(function(){
                            location.href = "produtos.php";
                        }, 1650);
                    }else
                    $("#errors")
                    .html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+rsp.responseText+'</strong></div>')
                    .hide()
                    .css('opacity', 0)
                    .slideDown('slow')
                    .animate(
                        { opacity: 1 },
                        { queue: false, duration: 'slow' }
                        );
                },
                data: {
                    "usuario": $('#usuario').val(),
                    "senha": $('#senha').val() 
                },
                cache: false            
            });
        }
    });
});

function reload(){    
    window.location.href = './';
}