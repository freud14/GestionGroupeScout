-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 05 Décembre 2011 à 20:48
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

CREATE TABLE IF NOT EXISTS `adresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresses` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `ville` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `code_postal` varchar(6) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `adresses`
--

INSERT INTO `adresses` (`id`, `adresses`, `ville`, `code_postal`) VALUES
(6, '222 rue de florence', 'quebec', 'G3H 2K'),
(7, '222 de florence', 'quebec', 'G3H 2K'),
(8, '222 de florence', 'quebec', 'G3H 2K'),
(9, '123 Rue du fleuve', 'quebec', 'G3H 2K'),
(10, '123 rue du fleuve', 'quebec', 'G3H 2K'),
(11, '8778 Hamel', 'quebec', 'K3K2N7'),
(12, '8778 hamel', 'quebec', 'G3H 2K');

-- --------------------------------------------------------

--
-- Structure de la table `adultes`
--

CREATE TABLE IF NOT EXISTS `adultes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `tel_maison` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `sexe` varchar(11) COLLATE latin1_general_ci NOT NULL COMMENT 'Sexe de l''adulte ex:1 pour masculin ou 2 pour feminin ',
  `tel_bureau` varchar(12) COLLATE latin1_general_ci DEFAULT NULL,
  `poste_bureau` varchar(11) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Poste du numéro de téléphone au travail (s''il y a lieu) Ex: 232 ',
  `tel_autre` varchar(12) COLLATE latin1_general_ci DEFAULT NULL,
  `profession` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `compte_id` int(11) DEFAULT NULL COMMENT 'ID du compte relié ',
  `courriel` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_adultes_comptes` (`compte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=37 ;

--
-- Contenu de la table `adultes`
--

INSERT INTO `adultes` (`id`, `prenom`, `nom`, `tel_maison`, `sexe`, `tel_bureau`, `poste_bureau`, `tel_autre`, `profession`, `compte_id`, `courriel`) VALUES
(1, 'Alphonse', 'Biron', '343-443-3456', '1', '', '', '', '', 2, 'alphonse1@gmail.com'),
(22, 'Ginette', 'Tremblay', '418-444-3234', '', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Judith', 'Biron', '581-345-3253', '2', '', '', '581-223-4523', '', NULL, ''),
(24, 'Ginette', 'Tremblay', '418-444-3234', '', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Judith', 'Biron', '581-345-3253', '2', '', NULL, '', NULL, NULL, NULL),
(26, 'Ginette', 'Tremblay', '418-444-3234', '', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Cindy', 'Abigayle', '777-333-4564', '2', '', '', '454-345-6346', 'Secrétaire', 18, 'CindyAbigayle@gmail.com'),
(28, 'Josephine', 'Abigayle', '418-444-3234', '', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Rolph', 'Abigayle', '581-345-3253', '1', '', NULL, '', NULL, NULL, NULL),
(30, 'Henry', 'Abigayle', '434-444-3453', '', NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Charles', 'Blakes', '343-443-3453', '1', '', '', '', 'Déménageur', 19, 'charlesblakes@hotmail.com'),
(32, 'Judith', 'Blake', '581-325-2342', '', NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Ginette', 'Blake', '418-943-3452', '', NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Jacques', 'Faran', '581-325-9758', '1', '514-245-9745', '43248238', '', '', 20, 'farran@hotmail.com'),
(35, 'Jules', 'Handerson', '581-325-9758', '1', '', '', '', 'Cadre', 21, 'handerson@yahoo.com'),
(36, 'Nicolas', 'Cooper', '819-874-8847', '1', '', '', '', '', 22, 'cooper@yahoo.com');

-- --------------------------------------------------------

--
-- Structure de la table `adultes_enfants`
--

CREATE TABLE IF NOT EXISTS `adultes_enfants` (
  `adulte_id` int(11) NOT NULL,
  `enfant_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `adulte_id_UNIQUE` (`adulte_id`,`enfant_id`),
  KEY `fk_adultes_enfants_adultes` (`adulte_id`),
  KEY `fk_adultes_enfants_enfants` (`enfant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=23 ;

--
-- Contenu de la table `adultes_enfants`
--

INSERT INTO `adultes_enfants` (`adulte_id`, `enfant_id`, `id`) VALUES
(1, 8, 13),
(1, 9, 15),
(1, 10, 17),
(23, 8, 14),
(25, 9, 16),
(27, 11, 18),
(27, 12, 20),
(29, 11, 19),
(31, 13, 21),
(31, 14, 22);

-- --------------------------------------------------------

--
-- Structure de la table `adultes_implications`
--

CREATE TABLE IF NOT EXISTS `adultes_implications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `implication_id` int(11) NOT NULL,
  `adulte_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_implications_UNIQUE` (`implication_id`,`adulte_id`),
  KEY `fk_adultes_implications_implications` (`implication_id`),
  KEY `fk_adultes_implications_adultes` (`adulte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Contenu de la table `adultes_implications`
--

INSERT INTO `adultes_implications` (`id`, `implication_id`, `adulte_id`) VALUES
(9, 1, 27),
(14, 1, 36),
(12, 2, 35),
(13, 3, 35),
(10, 4, 31),
(11, 5, 34);

-- --------------------------------------------------------

--
-- Structure de la table `adultes_unites`
--

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

CREATE TABLE IF NOT EXISTS `annees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` datetime NOT NULL COMMENT 'La date de début est la même que la date de fin de l''année précédente ',
  `date_fin` datetime DEFAULT NULL COMMENT '"Lorsque la date de fin est inscrite, on crée une nouvelle année avec la  même date comme date de début" ',
  `inscription` int(11) NOT NULL COMMENT 'est a 0 si les inscriptions sont possible pour cette année, sinon a 1.  ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `annees`
--

INSERT INTO `annees` (`id`, `date_debut`, `date_fin`, `inscription`) VALUES
(3, '2011-08-05 09:57:03', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `autorisations`
--

CREATE TABLE IF NOT EXISTS `autorisations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_autorisations` varchar(45) COLLATE latin1_general_ci NOT NULL COMMENT 'Nom de l''autorisation ex. : Administrateur, trésorier, animateur… ',
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

CREATE TABLE IF NOT EXISTS `autorisations_comptes` (
  `autorisation_id` int(11) NOT NULL,
  `compte_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `autorisation_id_UNIQUE` (`autorisation_id`,`compte_id`),
  KEY `FK_id_comptes` (`compte_id`),
  KEY `FK_id_autorisations` (`autorisation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `autorisations_comptes`
--

INSERT INTO `autorisations_comptes` (`autorisation_id`, `compte_id`, `id`) VALUES
(1, 18, 13),
(4, 2, 12);

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `mot_de_passe` varchar(64) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_utilisateur_UNIQUE` (`nom_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=23 ;

--
-- Contenu de la table `comptes`
--

INSERT INTO `comptes` (`id`, `nom_utilisateur`, `mot_de_passe`) VALUES
(2, 'alphonse1@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(18, 'CindyAbigayle@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(19, 'charlesblakes@hotmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(20, 'farran@hotmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(21, 'handerson@yahoo.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(22, 'cooper@yahoo.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f');

-- --------------------------------------------------------

--
-- Structure de la table `comptes_notifications`
--

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

CREATE TABLE IF NOT EXISTS `contact_urgences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adulte_id` int(11) NOT NULL,
  `enfant_id` int(11) NOT NULL,
  `lien` varchar(45) COLLATE latin1_general_ci NOT NULL COMMENT 'Lien entre l''enfant et l''adulte  Ex. : mère, père',
  PRIMARY KEY (`id`),
  KEY `fk_contact_urgences_enfants` (`enfant_id`),
  KEY `fk_contact_urgences_adultes` (`adulte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `contact_urgences`
--

INSERT INTO `contact_urgences` (`id`, `adulte_id`, `enfant_id`, `lien`) VALUES
(5, 22, 8, 'Grand-mère'),
(6, 24, 9, 'Grand-mère'),
(7, 26, 10, 'Grand-mère'),
(8, 28, 11, 'Tante'),
(9, 30, 12, 'Grand-père'),
(10, 32, 13, 'Tante'),
(11, 33, 14, 'Tante');

-- --------------------------------------------------------

--
-- Structure de la table `enfants`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Contenu de la table `enfants`
--

INSERT INTO `enfants` (`id`, `nom`, `prenom`, `date_naissance`, `adresse_id`, `no_ass_maladie`, `sexe`, `particularite_jeunes`) VALUES
(8, 'Biron', 'George', '2006-01-01', 6, 'BIRG06010101', 1, ''),
(9, 'Biron', 'Mélanie', '2000-01-01', 7, 'BIRM00010101', 2, ''),
(10, 'Biron', 'Fabienne', '1992-05-02', 8, 'BIRF92050201', 2, 'Elle n''aime pas les champignons'),
(11, 'Abigayle', 'Jackie', '1994-10-07', 9, 'ABIJ94100701', 2, ''),
(12, 'Abigayle', 'Max', '1998-04-14', 10, 'ABIM98041401', 1, ''),
(13, 'Blake', 'Maxime', '1999-01-10', 11, 'MAXB99011002', 1, ''),
(14, 'Blake', 'Hugo', '2000-01-16', 12, 'BLAH00011601', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE IF NOT EXISTS `factures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_facture` varchar(45) COLLATE latin1_general_ci NOT NULL COMMENT 'Numéro de facture (décidé par les scouts(non implémenté))',
  `date_facturation` datetime NOT NULL,
  `inscription_id` int(11) NOT NULL,
  `nb_versement_id` int(11) NOT NULL,
  `fraterie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_factures_nb_versements` (`nb_versement_id`),
  KEY `fk_factures_frateries` (`fraterie_id`),
  KEY `fk_factures_inscriptions` (`inscription_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `factures`
--

INSERT INTO `factures` (`id`, `no_facture`, `date_facturation`, `inscription_id`, `nb_versement_id`, `fraterie_id`) VALUES
(12, 'a', '2011-12-05 13:52:31', 12, 1, 1),
(13, 'a', '2011-12-05 13:56:42', 13, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `fiche_medicales`
--

CREATE TABLE IF NOT EXISTS `fiche_medicales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enfant_id` int(11) NOT NULL COMMENT 'l''enfant concerné par la fiche médicale ',
  `allergie` varchar(200) COLLATE latin1_general_ci DEFAULT NULL COMMENT '"Allergie non spécifiée dans le questionnaire" ',
  `phobie` varchar(200) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Phobie non spécifiée dans le questionnaire ',
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_enfant` (`enfant_id`),
  KEY `fk_fiche_medicales_enfants` (`enfant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `fiche_medicales`
--

INSERT INTO `fiche_medicales` (`id`, `enfant_id`, `allergie`, `phobie`) VALUES
(6, 8, '', ''),
(7, 9, 'Allergie à l''aloès', ''),
(8, 10, '', ''),
(9, 11, '', ''),
(10, 12, '', 'Il a peur des Clowns'),
(11, 13, 'Allergie aux abeilles', ''),
(12, 14, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `fiche_medicales_maladies`
--

CREATE TABLE IF NOT EXISTS `fiche_medicales_maladies` (
  `maladie_id` int(11) NOT NULL,
  `fiche_medicale_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `maladie_id_UNIQUE` (`maladie_id`,`fiche_medicale_id`),
  KEY `fk_fiche_medicales_maladies_fiche_medicales` (`fiche_medicale_id`),
  KEY `fk_fiche_medicales_maladies_maladies` (`maladie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `fiche_medicales_maladies`
--

INSERT INTO `fiche_medicales_maladies` (`maladie_id`, `fiche_medicale_id`, `id`) VALUES
(1, 6, 11),
(14, 12, 15),
(16, 7, 12),
(18, 11, 14),
(24, 10, 13);

-- --------------------------------------------------------

--
-- Structure de la table `fiche_medicales_medicaments`
--

CREATE TABLE IF NOT EXISTS `fiche_medicales_medicaments` (
  `medicament_id` int(11) NOT NULL,
  `fiche_medicale_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `medicament_id_UNIQUE` (`medicament_id`,`fiche_medicale_id`),
  KEY `fk_fiche_medicales_medicaments_fiche_medicales` (`fiche_medicale_id`),
  KEY `fk_fiche_medicales_medicaments_medicaments` (`medicament_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=67 ;

--
-- Contenu de la table `fiche_medicales_medicaments`
--

INSERT INTO `fiche_medicales_medicaments` (`medicament_id`, `fiche_medicale_id`, `id`) VALUES
(1, 6, 25),
(1, 7, 31),
(1, 9, 43),
(1, 10, 50),
(1, 11, 53),
(1, 12, 60),
(2, 7, 32),
(2, 8, 37),
(2, 9, 44),
(2, 11, 54),
(2, 12, 61),
(3, 6, 26),
(3, 7, 33),
(3, 8, 38),
(3, 9, 45),
(3, 11, 55),
(3, 12, 62),
(4, 6, 27),
(4, 7, 34),
(4, 8, 39),
(4, 9, 46),
(4, 10, 51),
(4, 11, 56),
(4, 12, 63),
(5, 6, 28),
(5, 7, 35),
(5, 8, 40),
(5, 9, 47),
(5, 11, 57),
(5, 12, 64),
(6, 6, 29),
(6, 7, 36),
(6, 8, 41),
(6, 9, 48),
(6, 11, 58),
(6, 12, 65),
(7, 6, 30),
(7, 8, 42),
(7, 9, 49),
(7, 10, 52),
(7, 11, 59),
(7, 12, 66);

-- --------------------------------------------------------

--
-- Structure de la table `fiche_medicales_question_generales`
--

CREATE TABLE IF NOT EXISTS `fiche_medicales_question_generales` (
  `fiche_medicale_id` int(11) NOT NULL,
  `question_generale_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fiche_medicale_id_UNIQUE` (`fiche_medicale_id`,`question_generale_id`),
  KEY `fk_fiche_medicales_question_generales_fiche_medicales` (`fiche_medicale_id`),
  KEY `fk_fiche_medicales_question_generales_question_generales` (`question_generale_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=39 ;

--
-- Contenu de la table `fiche_medicales_question_generales`
--

INSERT INTO `fiche_medicales_question_generales` (`fiche_medicale_id`, `question_generale_id`, `id`) VALUES
(6, 1, 19),
(6, 3, 20),
(6, 5, 21),
(6, 7, 22),
(7, 1, 23),
(7, 2, 24),
(7, 3, 25),
(7, 4, 26),
(7, 5, 27),
(7, 7, 28),
(8, 1, 29),
(8, 7, 30),
(9, 7, 31),
(10, 1, 32),
(10, 7, 33),
(11, 1, 34),
(11, 2, 35),
(12, 1, 36),
(12, 2, 37),
(12, 3, 38);

-- --------------------------------------------------------

--
-- Structure de la table `frateries`
--

CREATE TABLE IF NOT EXISTS `frateries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL COMMENT 'Position de l''inscription du jeune dans la famille (ex: 2 pour 2 ieme enfant inscrit)',
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

CREATE TABLE IF NOT EXISTS `groupe_ages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL COMMENT '"Nom du groupe d''âge ex. Louveteau,  Exploratrice, Castor" ',
  `age_min` int(11) NOT NULL COMMENT '"Âge minimum pour être dans le groupe  d''âge" ',
  `age_max` int(11) NOT NULL COMMENT '"Âge maximum pour être dans le groupe  d''âge" ',
  `sexe` int(11) NOT NULL COMMENT 'Sexe des enfants admis dans ce groupe âge ex. 1 pour Masculin 2 pour féminin et 0 pour mixte ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Un groupe d''âge ex:Éclaireur, Jeanette…  ' AUTO_INCREMENT=7 ;

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

CREATE TABLE IF NOT EXISTS `implications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL COMMENT 'Ex. : Animation, Gestion ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `implications`
--

INSERT INTO `implications` (`id`, `nom`) VALUES
(1, 'Animation'),
(2, 'Gestion / Comptabilité'),
(3, 'Accompagnement'),
(4, 'Couture, costumes'),
(5, 'Cuisine (cuistot)');

-- --------------------------------------------------------

--
-- Structure de la table `information_scolaires`
--

CREATE TABLE IF NOT EXISTS `information_scolaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enfant_id` int(11) NOT NULL,
  `nom_ecole` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `niveau_scolaire` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `nom_enseignant` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_information_scolaires_enfants` (`enfant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `information_scolaires`
--

INSERT INTO `information_scolaires` (`id`, `enfant_id`, `nom_ecole`, `niveau_scolaire`, `nom_enseignant`) VALUES
(6, 8, 'Ecole st-sacrement', 'pri', 'Henry roberge'),
(7, 9, 'Rochebelle', 'sec', 'George Page'),
(8, 10, 'Rochebelle', 'sec', 'Julie Kurtz'),
(9, 11, 'Rochebelle', 'sec', 'Henry roberge'),
(10, 12, 'Rochebelle', 'sec', 'Henry roberge'),
(11, 13, 'Compagnon de cartier', 'sec', 'Linda Poulin'),
(12, 14, 'Ecole st-sacrement', 'sec', 'Henry roberge');

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE IF NOT EXISTS `inscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enfant_id` int(11) NOT NULL,
  `groupe_age_id` int(11) NOT NULL,
  `date_inscription` datetime NOT NULL COMMENT 'Date de l''inscription ',
  `annee_id` int(11) NOT NULL COMMENT 'Année de l''inscription ',
  `autorisation_photo` int(11) NOT NULL COMMENT 'Si les scouts peuvent utiliser les photos de l''enfant',
  `autorisation_baignade` int(11) NOT NULL COMMENT 'Si l''enfant peut se baigner ',
  `unite_id` int(11) DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL COMMENT 'Date de la désinscription. Est à "null" sauf si le jeune est désinscrit. ',
  PRIMARY KEY (`id`),
  KEY `fk_inscriptions_groupes_ages` (`groupe_age_id`),
  KEY `fk_inscriptions_annees` (`annee_id`),
  KEY `fk_inscriptions_enfants` (`enfant_id`),
  KEY `fk_inscriptions_unites` (`unite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id`, `enfant_id`, `groupe_age_id`, `date_inscription`, `annee_id`, `autorisation_photo`, `autorisation_baignade`, `unite_id`, `date_fin`) VALUES
(9, 8, 5, '2011-12-05 10:03:14', 3, 1, 1, 4, NULL),
(10, 9, 4, '2011-12-05 11:34:30', 3, 1, 1, 2, NULL),
(11, 10, 4, '2011-12-05 11:41:22', 3, 1, 1, 2, NULL),
(12, 11, 6, '2011-12-05 13:52:11', 3, 1, 1, 5, NULL),
(13, 12, 3, '2011-12-05 13:56:22', 3, 1, 1, 4, NULL),
(14, 13, 3, '2011-12-05 14:06:09', 3, 0, 1, NULL, NULL),
(15, 14, 3, '2011-12-05 14:09:57', 3, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `maladies`
--

CREATE TABLE IF NOT EXISTS `maladies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL COMMENT 'Nom de la maladie Ex. : Asthme ',
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

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_sujet_id` int(11) NOT NULL COMMENT 'Le nom de la table modifiée',
  `detail` varchar(200) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Les champs modifiés',
  `date` datetime NOT NULL COMMENT 'Date le la modification',
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

CREATE TABLE IF NOT EXISTS `paiements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_paiements` datetime DEFAULT NULL COMMENT 'La date à laquelle l''argent entre les mains des scouts ex: la date de réception si paiement en argent , si chèque, la date ou il est encaissé ',
  `montant` int(10) unsigned NOT NULL COMMENT 'Si le montant du paiement est 0$ alors le paiement est non applicable(l''utilisateur s’est inscrit après la date de ce paiement) ',
  `facture_id` int(11) NOT NULL,
  `paiement_type_id` int(11) NOT NULL,
  `date_reception` datetime DEFAULT NULL COMMENT 'Date a laquelle les scouts on reçu les chèques(vide si ce n''est pas par chèque) ',
  `ordre_paiement` int(11) NOT NULL COMMENT 'Ordre du paiement, Est a 0 si c''est un paiement uniqueEx: 1 pour premier etc...',
  PRIMARY KEY (`id`),
  KEY `fk_paiements_paiement_types` (`paiement_type_id`),
  KEY `fk_paiements_factures` (`facture_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Contenu de la table `paiements`
--

INSERT INTO `paiements` (`id`, `date_paiements`, `montant`, `facture_id`, `paiement_type_id`, `date_reception`, `ordre_paiement`) VALUES
(16, NULL, 195, 12, 1, NULL, 1),
(17, NULL, 175, 13, 3, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `paiement_types`
--

CREATE TABLE IF NOT EXISTS `paiement_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL COMMENT 'Ex.: Crédit, débit, Comptant, Chèque ',
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

CREATE TABLE IF NOT EXISTS `prescriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posologie` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `fiche_medicale_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prescriptions_fiche_medicales` (`fiche_medicale_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `posologie`, `fiche_medicale_id`) VALUES
(3, '2 comprimer de néomycine avant chaque repas', 9);

-- --------------------------------------------------------

--
-- Structure de la table `question_generales`
--

CREATE TABLE IF NOT EXISTS `question_generales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(200) COLLATE latin1_general_ci NOT NULL COMMENT 'Texte de la question ',
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

CREATE TABLE IF NOT EXISTS `type_sujets` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL COMMENT '"Nom de la table ex.  Enfant, adulte  ou fiche médicale" ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `type_sujets`
--


-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

CREATE TABLE IF NOT EXISTS `unites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupe_age_id` int(11) NOT NULL,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL COMMENT 'ex: Team wolf',
  PRIMARY KEY (`id`),
  KEY `fk_unite_groupe_age` (`groupe_age_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Instance d''un groupe d''âge. Example : Castor Joyeux.  ' AUTO_INCREMENT=6 ;

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

CREATE TABLE IF NOT EXISTS `versements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fraterie_id` int(11) NOT NULL,
  `montant` int(11) NOT NULL COMMENT 'Montant du versement ',
  `date` datetime DEFAULT NULL COMMENT '"Date à laquelle le versement  doit être effectué" ',
  `position` int(11) NOT NULL COMMENT 'Ordre du versement. Ex. : 1 pour 1er ,2 pour 2ieme  ou 3 pour 3ieme',
  `nb_versement_id` int(11) NOT NULL COMMENT 'Le nombre de versements du plan de paiement (voir plan de PAIEMENT dans la table FRATERIE ',
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
(3, 1, 50, '2012-02-20 00:00:00', 3, 2),
(4, 2, 35, '2011-10-20 00:00:00', 1, 2),
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
