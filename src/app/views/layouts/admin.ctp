<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php echo $html->css('stylesheet_fc92b45ab8'); ?>

		<?php echo $html->css('gallery'); ?>

		<?php echo $html->css('stylebase'); ?>

		<?php echo $html->css('stylesub'); ?>

		<?php echo $html->css('scout'); ?>

		<?php echo $this->Html->script('jquery-1.6.4.min'); ?>

		<?php echo $scripts_for_layout; ?>

		<title><?php echo $title_for_layout; ?> - Scouts - 102e groupe des Laurentides</title>
	</head>

	<body>
		<div id="header">
			<div class="menu">
				<ul>
					<li><?php echo $this->Html->link(__('Retour au coté « parent »', true) ,array("controller" => "accueil", "action" => "index"));?></li>
					
					<li><?php echo $this->Html->link(__('Administration', true) ,array("controller" => "admin", "action" => "index"));?></li>

					<li><?php echo $this->Html->link(__('Liste des unités', true) ,array("controller" => "liste_unite", "action" => "index"));?></li>

					<li>
						<a>Gestion administrative</a> 

						<ul>
							<li><?php echo $this->Html->link(__('Paiements', true) ,array("controller" => "paiement_membre", "action" => "index"));?></li>
							
							<li>
								<a>Assigner</a> 

								<ul>
									<li><?php echo $this->Html->link(__('Jeune', true) ,array("controller" => "liste_unite", "action" => "assigner"));?></li>
									
									<li><?php echo $this->Html->link(__('Animateur', true) ,array("controller" => "liste_unite", "action" => "assigner"));?></li>
								</ul>
							</li>
						</ul>
					</li>

					<li>
						<a>Gestion du système</a> 

						<ul>
							<li><?php echo $this->Html->link(__('Gestion des droits', true) ,array("controller" => "assigner_droit", "action" => "index"));?></li>
						</ul>
					</li>
				</ul>
			</div>
			<?php echo $html->image('logo102.png', array('alt' => __('Accueil du site', true), 'style' => 'width:214px; height:125px; border:0px', 'class' => 'logo', 'url' => array("controller" => "accueil", "action" => "index")));?>
		</div>

		<div id="body">
			<div id="right">
				<div id="ariane">
					<?php if (isset($ariane)) echo $ariane; ?>
				</div>

				<div id="menu2">
				</div>

				<div id="rightMiddle">
					<p class="h2"><?php if (isset($titre)) echo $titre; ?></p>
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

