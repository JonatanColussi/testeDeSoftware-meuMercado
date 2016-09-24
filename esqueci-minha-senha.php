<?php
	//include_once("../../admin/includes/database.php");
	//include_once("../../admin/includes/funcoes.php");

	/*$conexao = db_conectar();

	if ( isset( $_POST ) && !empty( $_POST ) ) {
		$email = filter_var( $_POST['reg_email'], FILTER_VALIDATE_EMAIL );

		$sql = "SELECT codcliente, nome_razao_social, responsavel, tipo_pessoa, email, senha FROM clientes WHERE email = '{$email}'";
		$query = db_query($conexao, $sql);
		$registro = mysql_num_rows($query);

		$dadosbanco = db_query_array($query);

		//imprimiPostGet($dadosbanco);

		if ( $registro == 0 ){
			echo "Este e-mail não consta na base de dados!";
		} else {
			include_once('php/recadastrar-senha.php');

			enviaEmail($dadosbanco);

		}
	}
	*/
	include '../partial/header.php';
?>
	<script type="text/javascript">
		function validarForm() {
			event.preventDefault();

			var vSErro = 'N';
			var pEmail = $('#reg_email').val();
			var vSAlerta = '';


			if( pEmail == "") {
				vSAlerta = 'O campo E-mail é de preenchimento obrigatório.';
				$('#reg_email').focus().css("border", "1px solid red");
				vSErro = 'S';
			} else if (!pEmail.match(/\S+@\S+\.\S+/)) {
				vSAlerta = "O campo E-mail est\xE1 preenchido incorretamente.";
				$('#reg_email').focus().css("border", "1px solid red");
				vSErro = 'S';
			} else if (!pEmail.match(/\S+@\S+\.\S+/) || pEmail.indexOf(' ')!=-1 || pEmail.indexOf('..')!=-1) {
				vSAlerta = "O campo E-mail est\xE1 preenchido incorretamente.";
				$('#reg_email').focus().css("border", "1px solid red");
				vSErro = 'S';
			}

			if ( vSErro == 'S'){
				$('.message_container').html('<div class="alert_box error relative m_bottom_10 fw_light"><p>'+vSAlerta+'</p></div>')
					.delay(150)
					.slideDown(300)
					.delay(4000)
					.slideUp(300,function(){
						$(this).html("");
					});
				return false;
			} else {
				document.forms[2].submit();
			}
		}

	</script>
			<!--breadcrumbs-->
			<div class="breadcrumbs bg_grey_light_2 fs_medium fw_light">
				<div class="container color_dark">
					<a href="index.php" class="sc_hover">Home</a> / <a href="esqueci-minha-senha.php" class="sc_hover"><span class="color_light">Esqueci Minha Senha</span></a>
				</div>
			</div>
			<!--main content-->
			<div class="page_section_offset">
				<div class="container numbered_title_init">
					<h2 class="fw_light second_font color_dark m_bottom_27 tt_uppercase">Esqueci Minha Senha</h2>
					<!--checkout method-->
					<section class="m_bottom_35 m_xs_bottom_30">
						<div class="d_table w_full m_bottom_5 second_font">
							<div class="d_table_cell col-lg-6 col-md-6 col-sm-6 col-xs-10">
								<h5 class="color_dark tt_uppercase fw_light numbered_title d_inline_m ellipsis_mxs w_full">Recuperar Senha</h5>
							</div>
							<div class="d_table_cell col-lg-6 col-md-6 col-sm-6 col-xs-2 t_align_r">
								<button class="button_type_4 grey state_2 tr_all vc_child d_inline_b black_hover"><i class="fa fa-pencil d_inline_m m_top_0"></i></button>
							</div>
						</div>
						<hr class="divider_bg m_bottom_23">
						<div class="row">

							<div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
								<b class="d_block color_dark m_bottom_20 second_font">Solicitar Nova Senha</b>
								<p class="m_bottom_10 color_dark second_font">Informe o seu email no campo abaixo que nós enviaremos uma nova senha</p>
								<div class="message_container d_none m_top_20"></div>
								<form action="" method="post" target="_self">
									<ul>
										<li class="m_bottom_15">
											<label for="reg_email" class="required clickable d_inline_b m_bottom_5 second_font">Seu Email</label><br>
											<input type="email" id="reg_email" name="reg_email" class="tr_all w_full fs_medium color_light required">
										</li>
										<li class="clearfix second_font">
											<button id="submit_btn" onClick="validarForm();" class="button_type_2 tt_uppercase fs_medium f_left t_align_c black state_2 m_bottom_5 tr_all">
												<span class="d_inline_b m_left_10 m_right_10">Solicitar Nova Senha</span>
											</button>
										</li>
									</ul>
								</form>
							</div>
						</div>
					</section>
				</div>
			</div>
<?php include 'footer.php';   ?>