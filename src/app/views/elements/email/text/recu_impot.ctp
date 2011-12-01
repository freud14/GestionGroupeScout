<?php foreach($rapport as $cle => $value) { ?>

<table cellspacing="0" cellpadding="5" width="760" border="0">
	<tr>
		<td bgcolor="#ffffff"><br /><br /></td>
	</tr>
	<tr>
		<td bgcolor="#00B0D8"><img alt=""  src="<?php echo $html->url('/img/logo102.png', true); ?>"><font size="4" color="#ffffff" face="Trebuchet MS">
				<strong><br>Reçu aux fins d'impôt sur le revenu
                        <br> Crédit pour la condition physique des enfants</strong>

                    </font></td>
	</tr>
	<tr>
		<td style="padding:0px;">
			<table width="760" cellpadding="5" cellspacing="0" border="0">
				<tr style="background-color:#eeeeee">
					<th width="200" align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Adresse'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS">455, rue des Couventines, Québec (Québec), G3G 1J9</font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Numéro Entreprise'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php echo "889032868RR0001"; ?></font></td>
				</tr>
				<tr style="background-color:#eeeeee">
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Payeur'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php echo $value[0]['adulte_nom'] ;?></font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Adresse'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php echo $value[0]['adresse']; ?></font></td>
				</tr>
				<tr style="background-color:#eeeeee">
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Montant admissible'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php echo $value[0]['montant_total'] . __('$', true);  ?></font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Pour l\'activité'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php echo __('Membre du 102e groupe scout des Laurentides ', true);  ?></font></td>
				</tr>
				<tr style="background-color:#eeeeee">
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Nom du participant'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php echo $value[0]['enfant_nom']?></font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Date de naissance'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php echo $value['enfants']['date_naissance'] ?></font></td>
				</tr>
				<tr style="background-color:#eeeeee">
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Date '); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php  echo $value[0]['date'] ?></font></td>
				</tr>
				<tr>
					<th align="left" valign="top"><font size="3" color="#000000" face="Trebuchet MS"><?php __('Numéro de reçu'); ?></font></th>
					<td><font size="3" color="#000000" face="Trebuchet MS"><?php echo __('RI-') . date('Y') . "-" . str_pad($value['factures']['id'], 4,"0", STR_PAD_LEFT) ; ?></font></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php } ?>