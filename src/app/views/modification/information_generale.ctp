<?php echo $form->create(array('controller' => 'modification', 'action' =>'informationGenerale', $id_enfant));     ?>
<table>
        <tr>
                <td>
                        <h3>Informations générales sur l'enfant</h3>

                        <?php
                        
                        echo $form->input('nom', array('READONLY' => $modification,'value' => $session['nom'],
                            'label' => array('class' => 'element', 'text' => __('Nom', true) . ' <span class="star">*</span>')));
                        ?>

                        <?php
                        echo $form->input('prenom', array('READONLY' => $modification,'value' => $session['prenom'], 'label' => array('class' => 'element', 'text' => __('Prénom', true) . ' <span class="star">*</span>')));
                        ?>

                        <?php
                        //echo $form->label('sexe', __('Sexe', true).' <span class="star">*</span>', array('class' => 'element'));
                        //echo $form->radio('sexe', 
                        //		array('M' => __('Masculin', true),'F' => __('Féminin', true)), 
                        //		array('label'=> 'Sexe', 'legend' => false));
                        ?>	
                        <?php
                        echo $form->input('sexe', array(
                            'before' => $form->label('sexe', __('Sexe', true) . ' <span class="star">*</span>', array('class' => 'element')),
                            'separator' => ' ',
                            'options' => array('1' => __('Masculin', true), '2' => __('Féminin', true)),
                            'type' => 'radio',
                            'default' => $session['sexe'],
                            'READONLY' => $modification,
                            'legend' => false
                                )
                        );
                        ?>


                        <?php
                        /* $elements = array();
                          for($i = date('Y') - 70; $i = date('Y') - 5; ++$i) {
                          $elements[] = $i;
                          }


                          echo $form->input('date_naissance', array('label' => 'Date de naissance',
                          'dateFormat' => 'DMY',
                          'minYear' => date('Y') - 70,
                          'maxYear' => date('Y') - 5)); */
                        //echo $form->dateTime('date_de_naissance','DMY', 'NONE', NULL , array('maxYear'=>date('Y') - 70,'minYear'=>date('Y') - 5), true); 
                        ?>

                        <?php
                        echo $form->label('date_de_naissance', __('Date de naissance', true) . ' <span class="star">*</span>', array('class' => 'element'));
                        echo $form->day('date_de_naissance', $session['date_de_naissance']['day']);
                        echo $form->month('date_de_naissance', $session['date_de_naissance']['month']);
                        echo $form->year('date_de_naissance', date('Y') - 70, date('Y') - 5, $session['date_de_naissance']['year']);
                        ?>

                        <?php
                        echo $form->input('assurance_maladie', array('READONLY' => $modification,'value' => $session['assurance_maladie'], 'label' => array('class' => 'element', 'text' => __('Numéro d\'assurance maladie', true) . ' <span class="star">*</span>')));
                        ?>

                        <?php
                        echo $form->label('adresse', __('Adresse', true) . ' <span class="star">*</span>', array('class' => 'element'));
                        echo $form->textarea('adresse', array('READONLY' => $modification,'value' => $session['adresse'], 'rows' => 3, 'cols' => 25));
                        ?>

                        <?php
                        echo $form->input('ville', array('READONLY' => $modification,'value' => $session['ville'], 'label' => array('class' => 'element', 'text' => __('Ville', true) . ' <span class="star">*</span>')));
                        ?>

                        <?php
                        echo $form->input('code_postal', array('READONLY' => $modification,'value' => $session['code_postal'], 'label' => array('class' => 'element', 'text' => __('Code postal', true) . ' <span class="star">*</span>')));
                        ?>

                        <h3>Informations scolaires</h3>

                        <?php
                        echo $form->input('etab_scolaire', array('READONLY' => $modification,'value' => $session['etab_scolaire'], 'label' => array('class' => 'element', 'text' => __('Nom de l\'établissement scolaire', true) . ' <span class="star">*</span>')));
                        ?>

                        <?php
                        // NE se garde pas
                        echo $form->label('niveau_scolaire', __('Niveau scolaire', true) . ' <span class="star">*</span>', array('class' => 'element'));
                        echo $form->select('niveau_scolaire', array('pre' => __('Préscolaire', true),
                            'pri' => __('Primaire', true),
                            'sec' => __('Secondaire', true)
                                ), array('READONLY' => $modification,'value' => $session['niveau_scolaire'])
                        );
                        ?>

                        <?php
                        echo $form->input('enseignant', array('READONLY' => $modification,'value' => $session['enseignant'], 'label' => array('class' => 'element', 'text' => __('Enseignement responsable', true))));
                        ?>

                        <br><h3><?php echo __('Groupe d\'âge') ?> </h3>
                        <?php
                        //ne se garde pas
                        $liste = array();
                        foreach ($groupe_age as $groupe) {
                                $liste[$groupe['GroupeAge']['id']] = $groupe['GroupeAge']['nom'] . "(" . $groupe['GroupeAge']['age_min'] . "-" . $groupe['GroupeAge']['age_max'] . " ans - " . ($groupe['GroupeAge']['sexe'] == '1' ? __("Masculin", true) : __("Féminin", true)) . ")";
                        }
                        echo $form->select('groupe_age', $liste, array('READONLY' => $modification,'value' => $session['groupe_age']));
                        ?>

                </td>
                <td>
                     
                        <h3>Autre parent ou tuteur</h3>
                        <?php
                        echo $form->input('nom_tuteur', array('READONLY' => $modification,'value' => $session['nom_tuteur'], 'label' => array('class' => 'element', 'text' => __('Nom', true))));
                        ?>

                        <?php
                        echo $form->input('prenom_tuteur', array('READONLY' => $modification,'value' => $session['prenom_tuteur'], 'label' => array('class' => 'element', 'text' => __('Prénom', true))));
                        ?>

                        <?php
                        echo $form->label('sexe_tuteur', __('Sexe', true), array('class' => 'element'));
                        echo $form->radio('sexe_tuteur', array('1' => __('Masculin', true), '2' => __('Féminin', true)), array('READONLY' => $modification,'label' => false, 'legend' => false, 'default' => $session['sexe_tuteur'],));
                        ?>

                        <?php
                        echo $form->input('courriel_tuteur', array('READONLY' => $modification,'value' => $session['courriel_tuteur'], 'label' => array('class' => 'element', 'text' => __('Courriel', true))));
                        ?>

                        <?php
                        echo $form->input('telephone_maison_tuteur', array('READONLY' => $modification,'value' => $session['telephone_maison_tuteur'], 'label' => array('class' => 'element', 'text' => __('Téléphone à la maison', true))));
                        ?>

                        <?php
                        echo $form->input('telephone_bureau_tuteur', array('READONLY' => $modification,'value' => $session['telephone_bureau_tuteur'], 'label' => array('class' => 'element', 'text' => __('Téléphone au bureau', true))));
                        ?>

                        <?php
                        echo $form->input('telephone_bureau_poste_tuteur', array('READONLY' => $modification,'value' => $session['telephone_bureau_poste_tuteur'], 'label' => array('class' => 'element', 'text' => __('Numéro du poste', true))));
                        ?>


                        <?php
                        echo $form->input('cellulaire_tuteur', array('READONLY' => $modification,'value' => $session['cellulaire_tuteur'], 'label' => array('class' => 'element', 'text' => __('Cellulaire', true))));
                        ?>

                        <?php
                        echo $form->input('emploi_tuteur', array('READONLY' => $modification,'value' => $session['emploi_tuteur'], 'label' => array('class' => 'element', 'text' => __('Emploi', true))));
                        ?>

                        <h3>Contact d'urgence</h3>
                        <?php
                        echo $form->input('nom_urgence', array('READONLY' => $modification,'value' => $session['nom_urgence'], 'label' => array('class' => 'element', 'text' => __('Nom', true) . ' <span class="star">*</span>')));
                        ?>

                        <?php
                        echo $form->input('prenom_urgence', array('READONLY' => $modification,'value' => $session['prenom_urgence'], 'label' => array('class' => 'element', 'text' => __('Prénom', true) . ' <span class="star">*</span>')));
                        ?>

                        <?php
                        echo $form->input('telephone_principal_urgence', array('READONLY' => $modification,'value' => $session['telephone_principal_urgence'], 'label' => array('class' => 'element', 'text' => __('Téléphone principal', true) . ' <span class="star">*</span>')));
                        ?>

                        <?php
                        echo $form->input('lien_jeune_urgence', array('READONLY' => $modification,'value' => $session['lien_jeune_urgence'], 'label' => array('class' => 'element', 'text' => __('Lien avec le jeune', true) . ' <span class="star">*</span>')));
                        ?>

                        <h3>Particularité de votre jeune (« Bon à savoir »)</h3>

                        <?php
                        echo $form->textarea('particularite', array('READONLY' => $modification,'value' => $session['particularite'], 'rows' => 5, 'cols' => 35));
                        ?>
                      
                </td>
        </tr>
        <tr>
                <td colspan="2">
                        <div style="text-align:right;padding-top: 20px ">

                                <?php
                                echo $form->button(__('Annuler l\'inscription', true), array('type' => 'submit', 'name' => 'annuler'));
                                echo "&nbsp;&nbsp;&nbsp;";
                                echo $form->button(__('Étape suivante', true), array('type' => 'submit', 'name' => 'suivant',));
                                echo $form->end();
                                ?>
                        </div>
                </td>
        </tr>
</table>

