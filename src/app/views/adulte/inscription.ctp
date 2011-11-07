<?php $javascript->link('jquery-1.6.4.min.js'); ?>
<script type="text/javascript">
	$(function() {
		$('#ComplaintAddForm').validate({
			'#ComplaintName': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' },
			'#ComplaintCity': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' },
			'#ComplaintContact': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' },
			'#ComplaintZipCode': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' },
			'#ComplaintPhone': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' },
			'#ComplaintTime': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' },
			'#ComplaintPlace': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' },
			'#ComplaintMessage': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' }
		}, {
			'errorLocation' : 'appendLabel'
		});
		
		$("#ComplaintPhone").mask("(999) 999-9999");

	});
</script>





<div class="">
	<?php echo $form->create('Complaint', array('url' => array('controller' => 'pages', 'action' => 'complaints')));?>

<h3><?php __('Information du compte'); ?></h3>

<div>
<?php
		echo $form->input('nom_utilisateur', array('label' => __('Courriel', true) . ' <span class="star">*</span>'));
		echo $form->input('mot_de_passe', array('label' => __('Mot de passe', true) . ' <span class="star">*</span>'));
		echo $form->input('mot_de_passe', array('label' => __('Mot de passe', true) . ' <span class="star">*</span>'));
	
?>
</div>	


<h3><?php __('Information personnel'); ?></h3>
<div>
<?php
		echo $form->input('nom', array('label' => __('Nom', true) . ' <span class="star">*</span>'));
		echo $form->input('prenom', array('label' => __('Prenom', true) . ' <span class="star">*</span>'));
		echo $form->input('Sexe', array('label' => __('Mot de passe', true) . ' <span class="star">*</span>'));
	
?>
</div>
	<?php echo $this->element('btn', array('type' => 'submit', 'txt' => __('Envoyez votre demande', true))); ?>
	<?php echo $form->end();?>

	<p style="clear:left;padding-top: 16px;"><?php __('Les champs marqu&eacute;s d\'une &eacute;toile (<span class="star">*</span>) sont obligatoires.'); ?></p>
</div>
