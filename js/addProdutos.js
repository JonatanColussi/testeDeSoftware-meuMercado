jQuery(document).ready(function($) {
	$("#formCadastro").on('submit', function(event) {
		event.preventDefault();
		dados = $(this).serialize();
		jQuery.ajax({
			type: "POST",
			url: "partial/addProdutos.php",
			data: dados,
			dataType: "json",
			cache: false,
			error: function(data){
				console.log(data);
				alert('Oops, ocorreu um erro ao cadastrar o produto :(');
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