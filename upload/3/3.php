<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta name="google-site-verification" content="YFiND9JgNACVlWO7grobNhyNZRDi-_W6Oc1W4yS2EYM" />
<!-- Basic Page Needs 
========================================================= -->
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php bloginfo('name'); ?> <?php wp_title(' - ', true, 'left'); ?></title>

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<meta name="google-site-verification" content="V63x-syYP6IKkGyOgcRkEeIiNMdWnrXuY2oA1fFa-lg" />
<?php global $data; ?>

<!-- Mobile Specific Metas & Favicons
========================================================= -->
<?php if($data['check_mobilezoom'] == 0) { ?><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"><?php } ?>

<?php if($data['media_favicon'] != "") { ?><link rel="shortcut icon" href="<?php echo $data['media_favicon']; ?>"><?php } ?>

<?php if($data['media_favicon_iphone'] != "") { ?><link rel="apple-touch-icon" href="<?php echo $data['media_favicon_iphone']; ?>"><?php } ?>

<?php if($data['media_favicon_iphone_retina'] != "") { ?><link rel="apple-touch-icon" sizes="114x114" href="<?php echo $data['media_favicon_iphone_retina']; ?>"><?php } ?>

<?php if($data['media_favicon_ipad'] != "") { ?><link rel="apple-touch-icon" sizes="72x72" href="<?php echo $data['media_favicon_ipad']; ?>"><?php } ?>

<?php if($data['media_favicon_ipad_retina'] != "") { ?><link rel="apple-touch-icon" sizes="144x144" href="<?php echo $data['media_favicon_ipad_retina']; ?>"><?php } ?>


<!-- WordPress Stuff
========================================================= -->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
<style>
.modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0px;
	bottom: 0;
	left: 0px;
	background: rgba(0,0,0,0.6);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
}


.modalDialog2 {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	width: 50%;
	right: 0px;
	bottom: 0;
	left: 0px;
	background: rgba(0,0,0,0.6);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
}

.modalDialog:target {
	opacity:1;
	pointer-events: auto;
}

.modalDialog > div {
	max-width: 400px;
	min-width: 200px;
	position: relative;
	margin: 10% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	background: #fff;
	//background: -moz-linear-gradient(#fff, #999);
	//background: -webkit-linear-gradient(#fff, #999);
	//background: -o-linear-gradient(#fff, #999);
}

.close {
	background: #1c3563;
	color: #FFFFFF !important;
	line-height: 25px;
	position: absolute;
	right: 12px;
	text-align: center;
	top: 10px;
	width: 24px;
	text-decoration: none;
	font-weight: bold;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	border-radius: 12px;
	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
	box-shadow: 1px 1px 3px #000;
}

.close:hover { background: #6cb94d; }
</style>
<meta name="google-site-verification" content="WTC6nHI_BHQnCFcV6Tqixf_zQMQkNx2MKQu9ibZs7Oc" />
</head>

<body <?php body_class(); ?>>

	<?php if($data['select_layoutstyle'] == 'Boxed Layout' || $data['select_layoutstyle'] == 'Boxed Layout with margin' ) { ?>	
	<div id="boxed-layout">
	<?php } ?>
	
	<?php if($data['check_topbar'] == true) { ?>
	<div id="topbar" class="clearfix <?php if($data['check_socialtopbar'] == false) { echo 'no-social'; } ?>">
	
		<div class="container">
		
			<div class="eight columns">
				<?php if($data['text_callus'] != "") { ?>
					<div class="callus"><?php echo $data['text_callus']; ?></div>
					<div class="clear"></div>
				<?php } ?>
			</div>
			
			<?php if($data['check_socialtopbar'] == true) { ?>
			<div class="eight columns">
				<div class="social-icons clearfix">
					<ul>
							<li style="display: none;" class="social-login"><a  href="#loginModal" title="Login">Login</a></li>
							<li class="social-login"><a href="#openModal" title="Login">Login</a></li>
						<?php if($data['social_twitter'] != "") { ?>
							<li class="social-twitter"><a href="http://www.twitter.com/<?php echo $data['social_twitter']; ?>" target="_blank" title="<?php _e( 'Twitter', 'minti' ) ?>"><?php _e( 'Twitter', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_forrst'] != "") { ?>
							<li class="social-forrst"><a href="<?php echo $data['social_forrst']; ?>" target="_blank" title="<?php _e( 'Forrst', 'minti' ) ?>"><?php _e( 'Forrst', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_dribbble'] != "") { ?>
							<li class="social-dribbble"><a href="<?php echo $data['social_dribbble']; ?>" target="_blank" title="<?php _e( 'Dribbble', 'minti' ) ?>"><?php _e( 'Dribbble', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_flickr'] != "") { ?>
							<li class="social-flickr"><a href="<?php echo $data['social_flickr']; ?>" target="_blank" title="<?php _e( 'Flickr', 'minti' ) ?>"><?php _e( 'Flickr', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_facebook'] != "") { ?>
							<li class="social-facebook"><a href="<?php echo $data['social_facebook']; ?>" target="_blank" title="<?php _e( 'Facebook', 'minti' ) ?>"><?php _e( 'Facebook', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_skype'] != "") { ?>
							<li class="social-skype"><a href="<?php echo $data['social_skype']; ?>" target="_blank" title="<?php _e( 'Skype', 'minti' ) ?>"><?php _e( 'Skype', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_digg'] != "") { ?>
							<li class="social-digg"><a href="<?php echo $data['social_digg']; ?>" target="_blank" title="<?php _e( 'Digg', 'minti' ) ?>"><?php _e( 'Digg', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_google'] != "") { ?>
							<li class="social-google"><a href="<?php echo $data['social_google']; ?>" target="_blank" title="<?php _e( 'Google', 'minti' ) ?>"><?php _e( 'Google+', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_instagram'] != "") { ?>
							<li class="social-instagram"><a href="<?php echo $data['social_instagram']; ?>" target="_blank" title="<?php _e( 'Instagram', 'minti' ) ?>"><?php _e( 'Instagram', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_linkedin'] != "") { ?>
							<li class="social-linkedin"><a href="<?php echo $data['social_linkedin']; ?>" target="_blank" title="<?php _e( 'LinkedIn', 'minti' ) ?>"><?php _e( 'LinkedIn', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_vimeo'] != "") { ?>
							<li class="social-vimeo"><a href="<?php echo $data['social_vimeo']; ?>" target="_blank" title="<?php _e( 'Vimeo', 'minti' ) ?>"><?php _e( 'Vimeo', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_yahoo'] != "") { ?>
							<li class="social-yahoo"><a href="<?php echo $data['social_yahoo']; ?>" target="_blank" title="<?php _e( 'Yahoo', 'minti' ) ?>"><?php _e( 'Yahoo', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_tumblr'] != "") { ?>
							<li class="social-tumblr"><a href="<?php echo $data['social_tumblr']; ?>" target="_blank" title="<?php _e( 'Tumblr', 'minti' ) ?>"><?php _e( 'Tumblr', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_youtube'] != "") { ?>
							<li class="social-youtube"><a href="<?php echo $data['social_youtube']; ?>" target="_blank" title="<?php _e( 'YouTube', 'minti' ) ?>"><?php _e( 'YouTube', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_picasa'] != "") { ?>
							<li class="social-picasa"><a href="<?php echo $data['social_picasa']; ?>" target="_blank" title="<?php _e( 'Picasa', 'minti' ) ?>"><?php _e( 'Picasa', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_deviantart'] != "") { ?>
							<li class="social-deviantart"><a href="<?php echo $data['social_deviantart']; ?>" target="_blank" title="<?php _e( 'DeviantArt', 'minti' ) ?>"><?php _e( 'DeviantArt', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_behance'] != "") { ?>
							<li class="social-behance"><a href="<?php echo $data['social_behance']; ?>" target="_blank" title="<?php _e( 'Behance', 'minti' ) ?>"><?php _e( 'Behance', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_pinterest'] != "") { ?>
							<li class="social-pinterest"><a href="<?php echo $data['social_pinterest']; ?>" target="_blank" title="<?php _e( 'Pinterest', 'minti' ) ?>"><?php _e( 'Pinterest', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_paypal'] != "") { ?>
							<li class="social-paypal"><a href="<?php echo $data['social_paypal']; ?>" target="_blank" title="<?php _e( 'PayPal', 'minti' ) ?>"><?php _e( 'PayPal', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_delicious'] != "") { ?>
							<li class="social-delicious"><a href="<?php echo $data['social_delicious']; ?>" target="_blank" title="<?php _e( 'Delicious', 'minti' ) ?>"><?php _e( 'Delicious', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_xing'] != "") { ?>
							<li class="social-xing"><a href="<?php bloginfo('social_xing'); ?>" target="_blank" title="<?php _e( 'XING', 'minti' ) ?>"><?php _e( 'XING', 'minti' ) ?></a></li>
						<?php } ?>
						<?php if($data['social_rss'] == true) { ?>
							<li class="social-rss"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="<?php _e( 'RSS', 'minti' ) ?>"><?php _e( 'RSS', 'minti' ) ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php } ?>
		
		</div>
	
	</div> <!-- end topbar -->
	<?php } ?>

	<?php
	
	if($data['header_layout']) {
		if(is_page('header-2')) {
			include_once('framework/inc/headers/header-v2.php');
		} elseif(is_page('header-3')) {
			include_once('framework/inc/headers/header-v3.php');
		} elseif(is_page('header-4')) {
			include_once('framework/inc/headers/header-v4.php');
		} elseif(is_page('header-5')) {
			include_once('framework/inc/headers/header-v5.php');
		} elseif(is_page('header-6')) {
			include_once('framework/inc/headers/header-v6.php');
		} else {
			include_once('framework/inc/headers/header-'.$data['header_layout'].'.php');
		}
	} else {
		if(is_page('header-2')) {
			include_once('framework/inc/headers/header-v2.php');
		} elseif(is_page('header-3')) {
			include_once('framework/inc/headers/header-v3.php');
		} elseif(is_page('header-4')) {
			include_once('framework/inc/headers/header-v4.php');
		} elseif(is_page('header-5')) {
			include_once('framework/inc/headers/header-v5.php');
		} elseif(is_page('header-6')) {
			include_once('framework/inc/headers/header-v6.php');
		} else {
			include_once('framework/inc/headers/header-v1.php');
		}
	}
	
	?>		
	<div id="openModal" class="modalDialog">
		<div id="formAuthentication">
			<a id="closeModal" href="#close" title="Close" class="close">X</a>
			<h2>Members Login</h2>
			Username:<br><input type="text" id="username1" style="width:100%; padding:0px; height:30px">
			Password:<br><input type="password" id="passwd"  style="width:100%; padding:0px; height:30px">
				<a href="javascript:;" onclick="formRememberPass();" align="center">Forgot your password?</a>
			<div id="processLogin">
				<div id="getaproved" style="align-text:center;" align="center">
					<a href="javascript:;" class=" button green medium" onclick="login();">Login</a>
				</div>	
			</div>
		</div>
		<div id="formReminderPass" style="display:none;">
			<a id="closeModal" href="#close" title="Close" class="close">X</a>
			<h2>Password Reminder Form</h2>
			Username:<br><input type="text" id="username2" style="width:100%; padding:0px; height:30px">
				<a href="javascript:;" onclick="formAuthentication();" align="center">Back to login</a>
			<div id="processReminder">
				<div id="getaproved" style="align-text:center;" align="center">
					<a href="javascript:;" class=" button green medium" onclick="reminderPass();">Send Password</a>
				</div>	
			</div>
		</div>
	</div>

	<div id="loginModal" class="modalDialog2">
		<div id="formAuthentication">
			<iframe id="test_frame" src="https://platform.gokapital.com/login" width="100%" onLoad="" height="350px"></iframe>
		</div>
		
	</div>
	<script type="text/javascript">
		function AjaxConsulta( pagDestino, parametros, htmlObjetivo ) 
		{
			htmlObjetivo = "#"+htmlObjetivo; 
			var txtLoad = "<table width='100%' align='center'><tr><td align='center'>Loading...<br><img src='http://www.gokapital.com/php_logic/loading.gif'  alt='Loading...'></td></tr></table>";
			jQuery(htmlObjetivo).html(txtLoad); 
			jQuery(htmlObjetivo).load(pagDestino, parametros, function(){});
		}

		function login()
		{
			var username = jQuery("#username1").val();
			var passwd = jQuery("#passwd").val();
			AjaxConsulta('http://www.gokapital.com/php_logic/processLogin.php',{username:username,passwd:passwd}, 'processLogin')
		}

		function reminderPass()
		{
			var username = jQuery("#username2").val();
			AjaxConsulta('http://www.gokapital.com/php_logic/processReminderPass.php',{username:username}, 'processReminder')
		}


		function formRememberPass()
		{
			jQuery("#formAuthentication").css('display', 'none');
			jQuery("#formReminderPass").css('display', 'block');
		}

		function formAuthentication()
		{
			jQuery("#formAuthentication").css('display', 'block');
			jQuery("#formReminderPass").css('display', 'none');
		}
	</script>
