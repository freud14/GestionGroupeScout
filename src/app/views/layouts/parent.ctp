<?php
$accesNum = 0;
$autorisation = $this->Session->read('authentification.autorisation');
if (!empty($autorisation)) {
	foreach ($autorisation as $valeur) {
		if ($valeur['id'] > $accesNum) {
			$accesNum = $valeur['id'];
		}
	}
}
?>
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

		<title><?php echo $title_for_layout; ?> - 102e Groupe scout des Laurentides</title>
	</head>

	<body>
		<div id="header">
			<div class="menu">
				<ul>
					<li><?php echo $this->Html->link(__('Accueil', true), array("controller" => "accueil", "action" => "index")); ?></li>

					<li>
						<a>Enfant</a>							

						<ul>
							<li><?php echo $this->Html->link(__('Inscription d\'un enfant', true), array("controller" => "information_generale", "action" => "index")); ?></li>

							<li><?php echo $this->Html->link(__('Profil des enfants', true), array("controller" => "liste_profil_enfant", "action" => "index")); ?></li>
						</ul>
					</li>

					<li><?php echo $this->Html->link(__('Gestionnaire des paiements', true), array("controller" => "gestionnaire_paiement", "action" => "index")); ?></li>

					<li><?php echo $this->Html->link(__('Mon profil', true), array("controller" => "inscrire_adulte", "action" => "profil")); ?></li>

					<?php if ($accesNum > 1) { ?>
						<li><?php echo $this->Html->link(__('Section d\'administration', true), array("controller" => "accueil", "action" => "admin")); ?></li>
					<?php } ?>

					<li style="float:right;"><?php echo $this->Html->link(__('Déconnexion', true), array("controller" => "connexion", "action" => "detruire")); ?></li>
				</ul>
			</div>
			<?php echo $html->image('logo102.png', array('alt' => __('Accueil du site', true), 'style' => 'width:214px; height:125px; border:0px', 'class' => 'logo', 'url' => array("controller" => "accueil", "action" => "index"))); ?>
		</div>

		<div id="body">
			<div id="right">
				<div id="ariane">
					<?php if (isset($ariane))
						echo $ariane; ?>
				</div>

				<div id="menu2">
				</div>

				<div id="rightMiddle">
					<p class="h2"><?php if (isset($titre))
						echo $titre; ?></p>
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

