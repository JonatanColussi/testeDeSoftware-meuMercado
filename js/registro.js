$(window).load(function() {
    $(function($){
       $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
       $("#telefone").mask("(99)9999-9999?9");
       $("#cpf").mask("999.999.999-99");
   });
});
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpf(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}
$('#login').click(function() {
    if($('#usuario').val() == ""){
        alert('Voce deve informar o usuario!');
        $('#usuario').focus().parent().addClass('has-error has-feedback');
    }else if($('#senha').val() == ""){
        alert('Voce deve informar a senha!');
        $('#senha').focus().parent().addClass('has-error has-feedback')
    }
    else{
        dados = {             
            "usuario": $('#usuario').val(),
            "senha": $('#senha').val(),
            "method": $("#method").val()
        };
        $('#errors').hide();
        $.ajax({ 
            type: 'POST',                         
            url: 'partial/cadastrarUsuario.php',
            async: true,
            dataType: 'json',
            data: dados,
            cache: false,            
            error:function(rsp){
                console.log(rsp);
            },
            success: function(rsp){
                $("#errors")
                .html(rsp[1])
                .hide()
                .css('opacity', 0)
                .slideDown('slow')
                .animate(
                    { opacity: 1 },
                    { queue: false, duration: 'slow' }
                    );
                if(rsp[0] == true && rsp[2] == 'inserir'){
                    setTimeout(function(){
                        location.href = "login.php";
                    }, 1650);
                    
                }else if(rsp[0] == true && rsp[2] == 'editar'){
                    setTimeout(function(){
                        location.href = "registro.php?method=alterar";
                    }, 1650);
                }
            }
        });
    }
});
