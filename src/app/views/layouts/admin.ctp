<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
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
				<li class="link"><a href="index">Retour au coté « parent »</a></li>

				<li class="link"><a href="admin">Administration</a></li>

				<li>
					<a href="liste">Liste</a> 

					<ul>
						<li><a href="liste_enfants">Liste des enfants</a></li>

						<li><a href="liste_membres">Liste des membres</a></li>

						<li><a href="liste_inscriptions">Liste des inscriptions</a></li>

						<li><a href="liste_unites">Liste des unités</a></li>
					</ul>
				</li>

				<li>
					<a href="gestion_scouts">Gestion des scouts</a> 

					<ul>
						<li><a href="profil_jeunes">Profil des jeunes</a></li>

						<li>
							<a href="gestion_unites">Gestion des unités</a> 

							<ul>
								<li><a href="assigner_jeune">Assigner un jeune</a></li>

								<li><a href="desinscrire_jeune">Désinscrire un jeune</a></li>

								<li><a href="creation_unite">Création des unités</a></li>
							</ul>
						</li>

						<li><a href="lier_compte">Lier des comptes</a></li>

						<li><a href="inscriptions_sans_compte">Inscription sans compte</a></li>
					</ul>
				</li>

				<li>
					<a href="gestion_admin">Gestion administrative</a> 

					<ul>
						<li><a href="tarifs">Tarifs</a></li>

						<li><a href="paiements">Paiements</a></li>

						<li>
							<a href="assigner">Assigner</a> 

							<ul>
								<li><a href="assigner_jeune">Jeune</a></li>

								<li><a href="assigner_animateur">Animateur</a></li>
							</ul>
						</li>

						<li><a href="desinscription">Désinscription d'un jeune</a></li>
					</ul>
				</li>

				<li>
					<a href="gestion_sys">Gestion du système</a> 

					<ul>
						<li><a href="droits">Gestion des droits</a></li>

						<li><a href="droits">Gestion des années</a></li>

						<li><a href="droits">Gestion des fiches médicales</a></li>
					</ul>
				</li>
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

