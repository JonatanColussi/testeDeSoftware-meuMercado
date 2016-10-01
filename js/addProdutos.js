jQuery(document).ready(function($) {
	var i = 0;
	$("#formCadastro").on('submit', function(event) {
		$("input[type=submit]").hide();
		event.preventDefault();
		dados = $(this).serialize();
		jQuery.ajax({
			type: "POST",
			url: "partial/addProdutos.php",
			data: dados,
			dataType: "json",
			cache: true,
			error: function(data){
				console.log(data);
				alert('Oops, ocorreu um erro ao cadastrar o produto :(');
				$("input[type=submit]").show('slow');
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
                    }, 1650);
               	else
               		$("input[type=submit]").show('slow');
			}
		});
	});
});
// function loadMedicos(especialidade, medico){
// 	if(especialidade != ''){
// 		jQuery.ajax({
// 			type: "GET",
// 			url: "partial/selectMedicos.php",
// 			data: {
// 				especialidade: especialidade,
// 				medico: medico
// 			},
// 			cache: false,
// 			error: function(){
// 				alert('Oops, ocorreu um erro ao buscar os médicos :(');
// 			},
// 			success: function(data){
// 				$(".medicos").html(data);
// 				$("#medico").on('change', function() {
// 					validarDiasMedico($("#medico").val());
// 					if($("#data").val() != ''){
// 						searchHorarios($(this).val(), $("#data").val());
// 						$("#horario").prop('disabled', 'false');
// 					}else
// 						$("#horario").prop('disabled', 'true');
// 				});
// 				$("#data").prop('disabled', false);
// 			}
// 		});
// 	}
// }
// function validarDiasMedico(medico){
// 	if(medico != ''){
// 		jQuery.ajax({
// 			type: "GET",
// 			url: "partial/validarDiasMedico.php",
// 			data: {
// 				medico: medico
// 			},
// 			cache: false,
// 			error: function(){
// 				alert('Oops, ocorreu um erro ao buscar os dados :(');
// 			},
// 			success: function(data){
// 				$("#dateScript").html(data);
// 			}
// 		});
// 	}
// }
// function searchHorarios(medico, data){
// 	if(medico != ''){
// 		jQuery.ajax({
// 			type: "GET",
// 			url: "partial/searchHorarios.php",
// 			data: {
// 				medico: medico,
// 				data: data
// 			},
// 			cache: false,
// 			error: function(){
// 				alert('Oops, ocorreu um erro ao buscar os horários :(');
// 			},
// 			success: function(data){
// 				$(".horarios").html(data);
// 			}
// 		});
// 	}
// }