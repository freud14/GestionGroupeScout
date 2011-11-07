<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
	<meta name="generator" content="HTML Tidy, see www.w3.org" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="http://www.102e.org/typo3temp/stylesheet_fc92b45ab8.css" />
	<link rel="stylesheet" type="text/css" href="http://www.102e.org/typo3conf/ext/air_filemanager/pi1/gallery.css" />
	<link href="http://www.102e.org/fileadmin/templates/jet_30/stylebase.css" rel="stylesheet" type="text/css" />
	<link href="http://www.102e.org/fileadmin/templates/jet_30/stylesub.css" rel="stylesheet" type="text/css" />
	<!--<script type="text/javascript" src="http://www.102e.org/typo3conf/ext/air_filemanager/pi1/jquery-1.2.2.min.js"></script>
	<script type="text/javascript" src="http://www.102e.org/typo3conf/ext/air_filemanager/pi1/air_filemanager.js"></script>-->
	<?php echo $scripts_for_layout; ?>

	<title><?php echo $title_for_layout; ?> - Scouts - 102e groupe des Laurentides</title>
</head>

<body>
	<div id="header">
		<div class="menu">
			<ul>
				<li class="link"><a href="index">Accueil</a></li>

				<li>
					<a href="enfant">Enfant</a> 

					<ul>
						<li><a href="inscriptions">Inscription des enfants</a></li>

						<li><a href="profil_enfant">Profil des enfants</a></li>
					</ul>
				</li>

				<li><a href="paiements">Gestionnaire des paiements</a></li>

				<li><a href="profil">Mon profil</a></li>
			</ul>
		</div>
		<a href="index"><img src="http://www.102e.org/fileadmin/templates/jet_30/images/logo102.png" alt="jet 30" width="214" height="125" border="0" class="logo" /></a>
	</div>

	<div id="body">
		<div id="right">
			<div id="ariane">
				<?php if(isset($ariane)) echo $ariane; ?>
			</div>

			<div id="menu2">
			</div>

			<div id="rightMiddle">
				<p class="h2"><?php if(isset($titre)) echo $titre; ?></p>
				<?php echo $content_for_layout ?>

				<p class="bodytext">&nbsp;</p>
			</div>
			<br class="spacer" />
		</div>
		<br class="spacer" />
	</div>

	<div id="bodyBottom">
		<div id="news">
		</div>

		<div id="service">
			<br class="spacer" />
		</div>
		<br class="spacer" />
	</div>

	<div id="footer">
		<!--<ul>
			<li><a href="#">Home</a>|</li>
			<li><a href="#">About Us</a>|</li>
			<li><a href="#">Services</a>|</li>
			<li><a href="#">Support</a>|</li>
			<li><a href="#">Communication</a>|</li>
			<li><a href="#">Why Choose Us</a>|</li>
			<li><a href="#">News</a>|</li>
			<li><a href="#">Testimonials</a>|</li>
			<li><a href="#">Contact Us</a></li>
		</ul>-->
	</div>
</body>
</html>

