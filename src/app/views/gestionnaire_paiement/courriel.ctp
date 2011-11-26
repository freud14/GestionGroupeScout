<?php foreach($inscription as $cle => $value) { ?>

<table cellspacing="0" cellpadding="5" width="760" border="0">
	<tr>
		<td bgcolor="#ffffff"><br /><br /></td>
	</tr>
	<tr>
            <td bgcolor="#00B0D8"><font size="4" color="#ffffff" face="Trebuchet MS"><strong>Reçu aux fins d'impôt sur le revenu
                        <br> Crédit pour la condition physique des enfants</strong>

                    </font></td>
	</tr>
	<tr>
		<td style="padding:0px;">
			<table width="760" cellpadding="5" cellspacing="0" border="0">
				<tr style="background-color:#eeeeee">
					<th width="200" align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Adresse'); ?></font></th>
					<td>455, rue des Couventines, Québec (Québec), G3G 1J9</font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Numéro Entreprise'); ?></font></th>
					<td><?php echo "889032868RR0001"; ?></font></td>
				</tr>
				<tr style="background-color:#eeeeee">
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Payeur'); ?></font></th>
					<td><?php echo $parent[0]['Adulte'][0]['prenom'] . " " . $parent[0]['Adulte'][0]['nom'] ;?></font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Adresse'); ?></font></th>
					<td><?php echo $value[0]['Enfant']['Adresse']['adresses'] . " " .
									$value[0]['Enfant']['Adresse']['ville'] . "(Québec), " .
									$value[0]['Enfant']['Adresse']['code_postal']; ?></font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Montant admissible'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php   ?></font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Pour l\'activité'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php  echo $unite[$cle][0]['Unite']['nom']; ?></font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Nom du participant'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php echo $value[0]['Enfant']['prenom'] . " " .  $value[0]['Enfant']['nom']?></font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Date de naissance'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php echo $value[0]['Enfant']['date_naissance'] ?></font></td>
				</tr>
				<tr style="background-color:#eeeeee">
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Date '); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php  echo date('Y-m-d'); ?></font></td>
				</tr>
				<tr style="background-color:#eeeeee">
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Numéro de reçu'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php  ?></font></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php } ?>