-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 05 Décembre 2011 à 14:53
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `scout102`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
CREATE TABLE IF NOT EXISTS `adresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresses` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `ville` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `code_postal` varchar(6) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `adresses`
--


-- --------------------------------------------------------

--
-- Structure de la table `adultes`
--

DROP TABLE IF EXISTS `adultes`;
CREATE TABLE IF NOT EXISTS `adultes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `tel_maison` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `sexe` varchar(11) COLLATE latin1_general_ci NOT NULL,
  `tel_bureau` varchar(12) COLLATE latin1_general_ci DEFAULT NULL,
  `poste_bureau` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `tel_autre` varchar(12) COLLATE latin1_general_ci DEFAULT NULL,
  `profession` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `compte_id` int(11) DEFAULT NULL,
  `courriel` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_adultes_comptes` (`compte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=22 ;

--
-- Contenu de la table `adultes`
--



-- --------------------------------------------------------

--
-- Structure de la table `adultes_enfants`
--

DROP TABLE IF EXISTS `adultes_enfants`;
CREATE TABLE IF NOT EXISTS `adultes_enfants` (
  `adulte_id` int(11) NOT NULL,
  `enfant_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `adulte_id_UNIQUE` (`adulte_id`,`enfant_id`),
  KEY `fk_adultes_enfants_adultes` (`adulte_id`),
  KEY `fk_adultes_enfants_enfants` (`enfant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `adultes_enfants`
--


-- --------------------------------------------------------

--
-- Structure de la table `adultes_implications`
--

DROP TABLE IF EXISTS `adultes_implications`;
CREATE TABLE IF NOT EXISTS `adultes_implications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `implication_id` int(11) NOT NULL,
  `adulte_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_implications_UNIQUE` (`implication_id`,`adulte_id`),
  KEY `fk_adultes_implications_implications` (`implication_id`),
  KEY `fk_adultes_implications_adultes` (`adulte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `adultes_implications`
--


-- --------------------------------------------------------

--
-- Structure de la table `adultes_unites`
--

DROP TABLE IF EXISTS `adultes_unites`;
CREATE TABLE IF NOT EXISTS `adultes_unites` (
  `adulte_id` int(11) NOT NULL,
  `unite_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `adulte_id_UNIQUE` (`adulte_id`,`unite_id`),
  KEY `fk_adultes_unites_adultes` (`adulte_id`),
  KEY `fk_adultes_unites` (`unite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `adultes_unites`
--


-- --------------------------------------------------------

--
-- Structure de la table `annees`
--

DROP TABLE IF EXISTS `annees`;
CREATE TABLE IF NOT EXISTS `annees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `inscription` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `annees`
--
INSERT INTO `annees` (`id`, `date_debut`, `date_fin`, `inscription`) VALUES
(3, '2011-08-05 09:57:03', NULL, 0);


-- --------------------------------------------------------

--
-- Structure de la table `autorisations`
--

DROP TABLE IF EXISTS `autorisations`;
CREATE TABLE IF NOT EXISTS `autorisations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_autorisations` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `autorisations`
--

INSERT INTO `autorisations` (`id`, `nom_autorisations`) VALUES
(1, 'animateur'),
(2, 'consultation'),
(3, 'administrateur'),
(4, 'pilote');

-- --------------------------------------------------------

--
-- Structure de la table `autorisations_comptes`
--

DROP TABLE IF EXISTS `autorisations_comptes`;
CREATE TABLE IF NOT EXISTS `autorisations_comptes` (
  `autorisation_id` int(11) NOT NULL,
  `compte_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `autorisation_id_UNIQUE` (`autorisation_id`,`compte_id`),
  KEY `FK_id_comptes` (`compte_id`),
  KEY `FK_id_autorisations` (`autorisation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `autorisations_comptes`
--


-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `mot_de_passe` varchar(64) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_utilisateur_UNIQUE` (`nom_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Contenu de la table `comptes`
--



-- --------------------------------------------------------

--
-- Structure de la table `comptes_notifications`
--

DROP TABLE IF EXISTS `comptes_notifications`;
CREATE TABLE IF NOT EXISTS `comptes_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compte_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `etat` binary(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `comptes_id_UNIQUE` (`compte_id`,`notification_id`),
  KEY `fk_comptes_notifications_comptes` (`compte_id`),
  KEY `fk_comptes_notifications_notifications` (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `comptes_notifications`
--


-- --------------------------------------------------------

--
-- Structure de la table `contact_urgences`
--

DROP TABLE IF EXISTS `contact_urgences`;
CREATE TABLE IF NOT EXISTS `contact_urgences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adulte_id` int(11) NOT NULL,
  `enfant_id` int(11) NOT NULL,
  `lien` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contact_urgences_enfants` (`enfant_id`),
  KEY `fk_contact_urgences_adultes` (`adulte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `contact_urgences`
--


-- --------------------------------------------------------

--
-- Structure de la table `enfants`
--

DROP TABLE IF EXISTS `enfants`;
CREATE TABLE IF NOT EXISTS `enfants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `prenom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse_id` int(11) NOT NULL,
  `no_ass_maladie` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `sexe` int(11) NOT NULL,
  `particularite_jeunes` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enfants_adresses` (`adresse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `enfants`
--


-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

DROP TABLE IF EXISTS `factures`;
CREATE TABLE IF NOT EXISTS `factures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_facture` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `date_facturation` datetime NOT NULL,
  `inscription_id` int(11) NOT NULL,
  `nb_versement_id` int(11) NOT NULL,
  `fraterie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_factures_nb_versements` (`nb_versement_id`),
  KEY `fk_factures_frateries` (`fraterie_id`),
  KEY `fk_factures_inscriptions` (`inscription_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `factures`
--


-- --------------------------------------------------------

--
-- Structure de la table `fiche_medicales`
--

DROP TABLE IF EXISTS `fiche_medicales`;
CREATE TABLE IF NOT EXISTS `fiche_medicales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enfant_id` int(11) NOT NULL,
  `allergie` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `phobie` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_enfant` (`enfant_id`),
  KEY `fk_fiche_medicales_enfants` (`enfant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `fiche_medicales`
--


-- --------------------------------------------------------

--
-- Structure de la table `fiche_medicales_maladies`
--

DROP TABLE IF EXISTS `fiche_medicales_maladies`;
CREATE TABLE IF NOT EXISTS `fiche_medicales_maladies` (
  `maladie_id` int(11) NOT NULL,
  `fiche_medicale_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `maladie_id_UNIQUE` (`maladie_id`,`fiche_medicale_id`),
  KEY `fk_fiche_medicales_maladies_fiche_medicales` (`fiche_medicale_id`),
  KEY `fk_fiche_medicales_maladies_maladies` (`maladie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `fiche_medicales_maladies`
--


-- --------------------------------------------------------

--
-- Structure de la table `fiche_medicales_medicaments`
--

DROP TABLE IF EXISTS `fiche_medicales_medicaments`;
CREATE TABLE IF NOT EXISTS `fiche_medicales_medicaments` (
  `medicament_id` int(11) NOT NULL,
  `fiche_medicale_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `medicament_id_UNIQUE` (`medicament_id`,`fiche_medicale_id`),
  KEY `fk_fiche_medicales_medicaments_fiche_medicales` (`fiche_medicale_id`),
  KEY `fk_fiche_medicales_medicaments_medicaments` (`medicament_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `fiche_medicales_medicaments`
--


-- --------------------------------------------------------

--
-- Structure de la table `fiche_medicales_question_generales`
--

DROP TABLE IF EXISTS `fiche_medicales_question_generales`;
CREATE TABLE IF NOT EXISTS `fiche_medicales_question_generales` (
  `fiche_medicale_id` int(11) NOT NULL,
  `question_generale_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fiche_medicale_id_UNIQUE` (`fiche_medicale_id`,`question_generale_id`),
  KEY `fk_fiche_medicales_question_generales_fiche_medicales` (`fiche_medicale_id`),
  KEY `fk_fiche_medicales_question_generales_question_generales` (`question_generale_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `fiche_medicales_question_generales`
--


-- --------------------------------------------------------

--
-- Structure de la table `frateries`
--

DROP TABLE IF EXISTS `frateries`;
CREATE TABLE IF NOT EXISTS `frateries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `position_UNIQUE` (`position`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `frateries`
--

INSERT INTO `frateries` (`id`, `position`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `groupe_ages`
--

DROP TABLE IF EXISTS `groupe_ages`;
CREATE TABLE IF NOT EXISTS `groupe_ages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `age_min` int(11) NOT NULL,
  `age_max` int(11) NOT NULL,
  `sexe` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `groupe_ages`
--

INSERT INTO `groupe_ages` (`id`, `nom`, `age_min`, `age_max`, `sexe`) VALUES
(3, 'Louveteau', 9, 11, 1),
(4, 'Exploratrice', 9, 11, 2),
(5, 'Castor', 7, 8, 0),
(6, 'Pionniers', 14, 17, 0);

-- --------------------------------------------------------

--
-- Structure de la table `implications`
--

DROP TABLE IF EXISTS `implications`;
CREATE TABLE IF NOT EXISTS `implications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `implications`
--

INSERT INTO `implications` (`id`, `nom`) VALUES
(1, 'Animation'),
(2, 'Gestion / Comptabilité')
(3, 'Accompagnement'),
(4, 'Couture, costumes'),
(5, 'Cuisine (cuistot)');

-- --------------------------------------------------------

--
-- Structure de la table `information_scolaires`
--

DROP TABLE IF EXISTS `information_scolaires`;
CREATE TABLE IF NOT EXISTS `information_scolaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enfant_id` int(11) NOT NULL,
  `nom_ecole` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `niveau_scolaire` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `nom_enseignant` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_information_scolaires_enfants` (`enfant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `information_scolaires`
--


-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

DROP TABLE IF EXISTS `inscriptions`;
CREATE TABLE IF NOT EXISTS `inscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enfant_id` int(11) NOT NULL,
  `groupe_age_id` int(11) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `annee_id` int(11) NOT NULL,
  `autorisation_photo` int(11) NOT NULL,
  `autorisation_baignade` int(11) NOT NULL,
  `unite_id` int(11) DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inscriptions_groupes_ages` (`groupe_age_id`),
  KEY `fk_inscriptions_annees` (`annee_id`),
  KEY `fk_inscriptions_enfants` (`enfant_id`),
  KEY `fk_inscriptions_unites` (`unite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `inscriptions`
--


-- --------------------------------------------------------

--
-- Structure de la table `maladies`
--

DROP TABLE IF EXISTS `maladies`;
CREATE TABLE IF NOT EXISTS `maladies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

--
-- Contenu de la table `maladies`
--

INSERT INTO `maladies` (`id`, `nom`) VALUES
(1, 'Asthme'),
(2, 'Hypertension artérielle'),
(3, 'Palpitation cardiaque'),
(4, 'Menstruations'),
(5, 'Hypoglycémie'),
(6, 'Accident Vasculaire cérébral'),
(7, 'Hyperventilation'),
(8, 'Problème neurologique'),
(9, 'Malformation cardiaque'),
(10, 'Conjonctivite'),
(11, 'Incontinence'),
(12, 'Maux de ventre'),
(13, 'Otites'),
(14, 'Trouble auditif'),
(15, 'Handicap intellectuel'),
(16, 'Saignement de nez'),
(17, 'Trouble respiratoire'),
(18, 'Maux de tête / migraine'),
(19, 'Convulsions'),
(20, 'Problèmes musculaires'),
(21, 'Maux de dos'),
(22, 'Perte de conscience'),
(23, 'Handicap physique'),
(24, 'Problèmes cutanés'),
(25, 'Diabète'),
(26, 'Épilepsie');

-- --------------------------------------------------------

--
-- Structure de la table `medicaments`
--

DROP TABLE IF EXISTS `medicaments`;
CREATE TABLE IF NOT EXISTS `medicaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `medicaments`
--

INSERT INTO `medicaments` (`id`, `nom`) VALUES
(1, 'Anti-histaminique pour allergies (Benadryl, etc )'),
(2, 'Acétaminophène (Tylénol, Tempora, etc )'),
(3, 'Ibuprophène (Advil, Motrin, etc.)'),
(4, 'Anti-émétique (Gravol)'),
(5, 'Antibiotique en crème (Polysporin)'),
(6, 'Traitement pour piqûres (Afterbite, Calamine)'),
(7, 'Crème pour coups de soleil (Aloès)');

-- --------------------------------------------------------

--
-- Structure de la table `nb_versements`
--

DROP TABLE IF EXISTS `nb_versements`;
CREATE TABLE IF NOT EXISTS `nb_versements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nb_versements` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nb_versements_UNIQUE` (`nb_versements`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `nb_versements`
--

INSERT INTO `nb_versements` (`id`, `nb_versements`) VALUES
(1, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_sujet_id` int(11) NOT NULL,
  `detail` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `id_sujet` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notifications_type_sujets` (`type_sujet_id`),
  KEY `fk_notifications_fiche_medicales` (`id_sujet`),
  KEY `fk_notification_type_enfants` (`id_sujet`),
  KEY `fk_notification_type_adultes` (`id_sujet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `notifications`
--


-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_paiements` datetime DEFAULT NULL,
  `montant` int(10) unsigned NOT NULL,
  `facture_id` int(11) NOT NULL,
  `paiement_type_id` int(11) NOT NULL,
  `date_reception` datetime DEFAULT NULL,
  `ordre_paiement` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_paiements_paiement_types` (`paiement_type_id`),
  KEY `fk_paiements_factures` (`facture_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `paiements`
--


-- --------------------------------------------------------

--
-- Structure de la table `paiement_types`
--

DROP TABLE IF EXISTS `paiement_types`;
CREATE TABLE IF NOT EXISTS `paiement_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `paiement_types`
--

INSERT INTO `paiement_types` (`id`, `nom`) VALUES
(1, 'Argent'),
(2, 'Paypal'),
(3, 'Chèque'),
(4, 'Chèques postdatés'),
(5, 'Paypal différé');

-- --------------------------------------------------------

--
-- Structure de la table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE IF NOT EXISTS `prescriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posologie` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `fiche_medicale_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prescriptions_fiche_medicales` (`fiche_medicale_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `prescriptions`
--


-- --------------------------------------------------------

--
-- Structure de la table `question_generales`
--

DROP TABLE IF EXISTS `question_generales`;
CREATE TABLE IF NOT EXISTS `question_generales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(200) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `question_generales`
--

INSERT INTO `question_generales` (`id`, `texte`) VALUES
(1, 'Ses VACCINS sont-ils à jour ?'),
(2, 'A-t-il un ÉPIPEN ?'),
(3, 'Porte-t-il des LUNETTES ?'),
(4, 'Porte-t-il un APPAREIL (auditif, dentaire, etc.) ?'),
(5, 'A-t-il un DÉFICIT D''ATTENTION (TDAH) ?'),
(6, 'Fait-il des CAUCHEMARS ou de l''INSOMNIE ?'),
(7, 'Sait-il NAGER ?');

-- --------------------------------------------------------

--
-- Structure de la table `recu_impots`
--

DROP TABLE IF EXISTS `recu_impots`;
CREATE TABLE IF NOT EXISTS `recu_impots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_emission` datetime NOT NULL,
  `no_recu` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `factures_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recu_impots_factures` (`factures_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `recu_impots`
--


-- --------------------------------------------------------

--
-- Structure de la table `type_sujets`
--

DROP TABLE IF EXISTS `type_sujets`;
CREATE TABLE IF NOT EXISTS `type_sujets` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `type_sujets`
--


-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

DROP TABLE IF EXISTS `unites`;
CREATE TABLE IF NOT EXISTS `unites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupe_age_id` int(11) NOT NULL,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_unite_groupe_age` (`groupe_age_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `unites`
--

INSERT INTO `unites` (`id`, `groupe_age_id`, `nom`) VALUES
(1, 3, 'Team Wolf'),
(2, 4, 'Les exploratrices'),
(4, 5, 'Colonie de Balquenouille'),
(5, 6, 'Les pionniers');

-- --------------------------------------------------------

--
-- Structure de la table `versements`
--

DROP TABLE IF EXISTS `versements`;
CREATE TABLE IF NOT EXISTS `versements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fraterie_id` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `position` int(11) NOT NULL,
  `nb_versement_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_versements_nb_versements` (`nb_versement_id`),
  KEY `fk_versements_frateries` (`fraterie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `versements`
--

INSERT INTO `versements` (`id`, `fraterie_id`, `montant`, `date`, `position`, `nb_versement_id`) VALUES
(1, 1, 95, '2011-10-20 00:00:00', 1, 2),
(2, 1, 50, '2011-11-20 00:00:00', 2, 2),
(3, 1, 60, '2012-02-20 00:00:00', 3, 2),
(4, 2, 85, '2011-10-20 00:00:00', 1, 2),
(5, 2, 70, '2011-11-20 00:00:00', 2, 2),
(6, 2, 70, '2012-02-20 00:00:00', 3, 2),
(7, 1, 195, NULL, 0, 1),
(8, 2, 175, NULL, 0, 1),
(9, 3, 70, '2011-10-20 00:00:00', 1, 2),
(10, 3, 50, '2011-11-20 00:00:00', 2, 2),
(11, 3, 35, '2012-02-20 00:00:00', 3, 2),
(12, 3, 155, NULL, 0, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adultes`
--
ALTER TABLE `adultes`
  ADD CONSTRAINT `FK_adultes_comptes` FOREIGN KEY (`compte_id`) REFERENCES `comptes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `adultes_enfants`
--
ALTER TABLE `adultes_enfants`
  ADD CONSTRAINT `fk_adultes_enfants_adultes` FOREIGN KEY (`adulte_id`) REFERENCES `adultes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adultes_enfants_enfants` FOREIGN KEY (`enfant_id`) REFERENCES `enfants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `adultes_implications`
--
ALTER TABLE `adultes_implications`
  ADD CONSTRAINT `fk_adultes_implications_adultes` FOREIGN KEY (`adulte_id`) REFERENCES `adultes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adultes_implications_implications` FOREIGN KEY (`implication_id`) REFERENCES `implications` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `adultes_unites`
--
ALTER TABLE `adultes_unites`
  ADD CONSTRAINT `fk_adultes_unites` FOREIGN KEY (`unite_id`) REFERENCES `unites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adultes_unites_adultes` FOREIGN KEY (`adulte_id`) REFERENCES `adultes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `autorisations_comptes`
--
ALTER TABLE `autorisations_comptes`
  ADD CONSTRAINT `FK_id_autorisations` FOREIGN KEY (`autorisation_id`) REFERENCES `autorisations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_id_comptes` FOREIGN KEY (`compte_id`) REFERENCES `comptes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comptes_notifications`
--
ALTER TABLE `comptes_notifications`
  ADD CONSTRAINT `fk_comptes_notifications_comptes` FOREIGN KEY (`compte_id`) REFERENCES `comptes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comptes_notifications_notifications` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contact_urgences`
--
ALTER TABLE `contact_urgences`
  ADD CONSTRAINT `fk_contact_urgences_adultes` FOREIGN KEY (`adulte_id`) REFERENCES `adultes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contact_urgences_enfants` FOREIGN KEY (`enfant_id`) REFERENCES `enfants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `enfants`
--
ALTER TABLE `enfants`
  ADD CONSTRAINT `fk_enfants_adresses` FOREIGN KEY (`adresse_id`) REFERENCES `adresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `fk_factures_frateries` FOREIGN KEY (`fraterie_id`) REFERENCES `frateries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factures_inscriptions` FOREIGN KEY (`inscription_id`) REFERENCES `inscriptions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factures_nb_versements` FOREIGN KEY (`nb_versement_id`) REFERENCES `nb_versements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `fiche_medicales`
--
ALTER TABLE `fiche_medicales`
  ADD CONSTRAINT `fk_fiche_medicales_enfants` FOREIGN KEY (`enfant_id`) REFERENCES `enfants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `fiche_medicales_maladies`
--
ALTER TABLE `fiche_medicales_maladies`
  ADD CONSTRAINT `fk_fiche_medicales_maladies_fiche_medicales` FOREIGN KEY (`fiche_medicale_id`) REFERENCES `fiche_medicales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fiche_medicales_maladies_maladies` FOREIGN KEY (`maladie_id`) REFERENCES `maladies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `fiche_medicales_medicaments`
--
ALTER TABLE `fiche_medicales_medicaments`
  ADD CONSTRAINT `fk_fiche_medicales_medicaments_fiche_medicales` FOREIGN KEY (`fiche_medicale_id`) REFERENCES `fiche_medicales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fiche_medicales_medicaments_medicaments` FOREIGN KEY (`medicament_id`) REFERENCES `medicaments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `fiche_medicales_question_generales`
--
ALTER TABLE `fiche_medicales_question_generales`
  ADD CONSTRAINT `fk_fiche_medicales_question_generales_fiche_medicales` FOREIGN KEY (`fiche_medicale_id`) REFERENCES `fiche_medicales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fiche_medicales_question_generales_question_generales` FOREIGN KEY (`question_generale_id`) REFERENCES `question_generales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `information_scolaires`
--
ALTER TABLE `information_scolaires`
  ADD CONSTRAINT `fk_information_scolaires_enfants` FOREIGN KEY (`enfant_id`) REFERENCES `enfants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `fk_inscriptions_annees` FOREIGN KEY (`annee_id`) REFERENCES `annees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscriptions_enfants` FOREIGN KEY (`enfant_id`) REFERENCES `enfants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscriptions_groupes_ages` FOREIGN KEY (`groupe_age_id`) REFERENCES `groupe_ages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscriptions_unites` FOREIGN KEY (`unite_id`) REFERENCES `unites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_fiche_medicales` FOREIGN KEY (`id_sujet`) REFERENCES `fiche_medicales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notifications_type_sujets` FOREIGN KEY (`type_sujet_id`) REFERENCES `type_sujets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notification_type_adultes` FOREIGN KEY (`id_sujet`) REFERENCES `adultes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notification_type_enfants` FOREIGN KEY (`id_sujet`) REFERENCES `enfants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `fk_paiements_factures` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_paiements_paiement_types` FOREIGN KEY (`paiement_type_id`) REFERENCES `paiement_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `fk_prescriptions_fiche_medicales` FOREIGN KEY (`fiche_medicale_id`) REFERENCES `fiche_medicales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `recu_impots`
--
ALTER TABLE `recu_impots`
  ADD CONSTRAINT `fk_recu_impots_factures` FOREIGN KEY (`factures_id`) REFERENCES `factures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `unites`
--
ALTER TABLE `unites`
  ADD CONSTRAINT `fk_unite_groupe_age` FOREIGN KEY (`groupe_age_id`) REFERENCES `groupe_ages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `versements`
--
ALTER TABLE `versements`
  ADD CONSTRAINT `fk_versements_frateries` FOREIGN KEY (`fraterie_id`) REFERENCES `frateries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_versements_nb_versements` FOREIGN KEY (`nb_versement_id`) REFERENCES `nb_versements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
