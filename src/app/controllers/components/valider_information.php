<?php
class ValiderInformationComponent extends Object {
   
   
    function validerInformation($nom_utilisateur,$mot_de_passe)
	{
		
		$resultat = null;
    		$conditions = array("Compte.nom_utilisateur" => $nom_utilisateur,'Compte.mot_de_passe' => $mot_de_passe);    			
    		$resultat = ClassRegistry::init('Compte')->find('first', array('conditions' => $conditions,'fields' => 'Compte.id'));
    		
		
		if(!empty($resultat))
		{
			$resultat = array('autorisation' => $resultat['Autorisation'],'id_compte' => $resultat['Compte']['id'],'id_adulte' => $resultat['Adulte']['0']['id'],
			    'nom_adulte' =>$resultat['Adulte'][0]['prenom']. " ". $resultat['Adulte'][0]['nom']);
		}
			
			
		return $resultat;
			//return $this->QuestionGenerale->find('all');
	}
    }
    ?>

