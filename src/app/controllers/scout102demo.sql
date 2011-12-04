-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 28 Novembre 2011 à 19:54
-- Version du serveur: 5.5.17
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `adresses`
--

INSERT INTO `adresses` (`id`, `adresses`, `ville`, `code_postal`) VALUES
(1, '2020 prevert', 'quebec', 'G1K2K8'),
(2, '19 chemin ste-foy', 'quebec', 'h3h2k3'),
(3, '123 du Fleuve', 'Kamouraska', 'h1h1h1'),
(4, '3842 rue des thuyas #7', 'Québec', 'G1G1V3'),
(5, '342 rue des tulipes', 'Québec', 'G1G1V3');

-- --------------------------------------------------------

--
-- Structure de la table `adultes`
--

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

INSERT INTO `adultes` (`id`, `prenom`, `nom`, `tel_maison`, `sexe`, `tel_bureau`, `poste_bureau`, `tel_autre`, `profession`, `compte_id`, `courriel`) VALUES
(1, 'alphonse', 'biron', '555-555-555', '1', NULL, NULL, NULL, NULL, 1, NULL),
(9, 'Pete', 'Calvin', '555-555-555', '1', '', '', '', '', 11, 'PeteCalvin@gmail.com'),
(10, 'Fabrice', 'Corin ', '555-555-555', '1', '', '', '', '', 12, 'fabricecorin@gmail.com'),
(11, 'david', 'renard', '555-555-555', '1', '', '', '', '', 13, 'RenardDavid@gmail.com'),
(12, 'Yanick', 'Juliane ', '555-555-555', '2', '', '', '', '', 14, 'yanickjuliane@gmail.com'),
(13, 'Laure', 'Cyrielle', '555-555-555', '2', '', '', '', '', 15, 'LaureCyrielle@gmail.com'),
(14, 'Sandra', 'Adeline ', '555-555-555', '2', '', '', '', '', 16, 'AdelineSandra@gmail.com'),
(15, 'Ethan', 'Ellery', '555-555-5555', '1', NULL, NULL, NULL, NULL, 9, NULL),
(16, 'Hedley', 'Prosper', '555-555-5555', '1', NULL, NULL, NULL, NULL, 10, NULL),
(17, 'Ginette', 'Gamache', '123-333-3333', '', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Roger', 'Gamache', '555-555-5555', '1', '543-555-5555', NULL, '444-444-4444', NULL, NULL, NULL),
(19, 'Frédérik', 'Paradis', '418-634-5268', '1', '418-234-2342', '', '', '', 17, 'fredy_14@live.fr'),
(20, 'Frédérik', 'Paradis', '418-634-5268', '', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Frédérik', 'Paradis', '418-634-5268', '', NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `adultes_enfants`
--

INSERT INTO `adultes_enfants` (`adulte_id`, `enfant_id`, `id`) VALUES
(1, 1, 5),
(1, 2, 6),
(1, 5, 7),
(9, 3, 8),
(9, 4, 9),
(19, 6, 11),
(19, 7, 12);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `adultes_implications`
--

INSERT INTO `adultes_implications` (`id`, `implication_id`, `adulte_id`) VALUES
(8, 2, 19);

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

INSERT INTO `adultes_unites` (`adulte_id`, `unite_id`, `id`) VALUES
(12, 1, 3),
(15, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `annees`
--

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
(1, '2010-10-01 00:00:00', '2011-10-12 00:00:00', 0),
(2, '2011-10-01 00:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `autorisations`
--

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

INSERT INTO `autorisations_comptes` (`autorisation_id`, `compte_id`, `id`) VALUES
(1, 9, 3),
(1, 14, 4),
(2, 1, 1),
(2, 11, 5),
(2, 14, 6),
(3, 11, 8),
(3, 16, 7),
(4, 1, 10),
(4, 11, 9),
(4, 17, 11);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Contenu de la table `comptes`
--

INSERT INTO `comptes` (`id`, `nom_utilisateur`, `mot_de_passe`) VALUES
(1, 'alphonse1@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(9, 'EthanEllery@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(10, 'HedleyProsper@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(11, 'PeteCalvin@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(12, 'fabricecorin@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(13, 'RenardDavid@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(14, 'yanickjuliane@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(15, 'LaureCyrielle@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(16, 'AdelineSandra@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(17, 'fredy_14@live.fr', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b');

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

-- --------------------------------------------------------

--
-- Structure de la table `contact_urgences`
--

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

INSERT INTO `contact_urgences` (`id`, `adulte_id`, `enfant_id`, `lien`) VALUES
(2, 17, 5, 'Grand mere'),
(3, 20, 6, 'Parent'),
(4, 21, 7, 'Parent');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `enfants`
--

INSERT INTO `enfants` (`id`, `nom`, `prenom`, `date_naissance`, `adresse_id`, `no_ass_maladie`, `sexe`, `particularite_jeunes`) VALUES
(1, 'jean', 'michaelle', '2003-11-20', 2, 'jeam20110302', 2, 'N''aime pas le poulet'),
(2, 'poisson', 'guy', '1999-11-09', 1, 'poig09119923', 1, NULL),
(3, 'jean', 'bob', '2001-11-07', 1, 'jeam07112011', 1, NULL),
(4, 'Tremblay', 'George', '2002-11-19', 2, 'treg19110204', 1, NULL),
(5, 'Gamache', 'Jeremy', '1994-06-13', 3, 'GAMJ13069401', 1, 'antisocial'),
(6, 'Biron', 'Michel', '1992-01-14', 4, 'BIRM92011412', 1, ''),
(7, 'Girard', 'Simon', '1989-04-08', 5, 'GIRS89040821', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

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

INSERT INTO `factures` (`id`, `no_facture`, `date_facturation`, `inscription_id`, `nb_versement_id`, `fraterie_id`) VALUES
(5, 'a', '2011-11-24 09:10:34', 2, 1, 1),
(6, 'a', '2011-11-24 09:10:47', 5, 2, 2),
(10, 'a', '2011-11-28 12:24:27', 6, 1, 2),
(11, 'a', '2011-11-28 16:28:47', 7, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fiche_medicales`
--

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

INSERT INTO `fiche_medicales` (`id`, `enfant_id`, `allergie`, `phobie`) VALUES
(1, 1, 'Allergie au poisson', NULL),
(2, 2, NULL, NULL),
(3, 5, 'noix', 'Le noir'),
(4, 6, '', ''),
(5, 7, '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `fiche_medicales_maladies`
--

INSERT INTO `fiche_medicales_maladies` (`maladie_id`, `fiche_medicale_id`, `id`) VALUES
(1, 3, 3),
(3, 5, 7),
(4, 4, 4),
(5, 1, 1),
(5, 5, 6),
(6, 1, 2),
(8, 4, 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `fiche_medicales_medicaments`
--

INSERT INTO `fiche_medicales_medicaments` (`medicament_id`, `fiche_medicale_id`, `id`) VALUES
(1, 3, 3),
(1, 4, 4),
(2, 1, 1),
(2, 2, 2),
(2, 5, 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `fiche_medicales_question_generales`
--

INSERT INTO `fiche_medicales_question_generales` (`fiche_medicale_id`, `question_generale_id`, `id`) VALUES
(1, 1, 1),
(1, 2, 2),
(3, 1, 3),
(3, 2, 4),
(4, 2, 5),
(5, 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `frateries`
--

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

CREATE TABLE IF NOT EXISTS `implications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `implications`
--

INSERT INTO `implications` (`id`, `nom`) VALUES
(1, 'Comptabilite'),
(2, 'Administrateur');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `information_scolaires`
--

INSERT INTO `information_scolaires` (`id`, `enfant_id`, `nom_ecole`, `niveau_scolaire`, `nom_enseignant`) VALUES
(1, 1, 'rochebelle', 'secondaire 1', 'George Aphonse'),
(2, 2, 'Seminaire des pères mariste', 'secondaire 2', 'Brigitte Wilson'),
(3, 5, 'ecole du buisson', 'pre', 'George'),
(4, 6, 'Cégep de Sainte-Foy', 'sec', 'Sylvie Monjal'),
(5, 7, 'Cégep de Sainte-Foy', 'sec', 'Sylvie Monjal');

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

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

INSERT INTO `inscriptions` (`id`, `enfant_id`, `groupe_age_id`, `date_inscription`, `annee_id`, `autorisation_photo`, `autorisation_baignade`, `unite_id`, `date_fin`) VALUES
(1, 1, 3, '2010-11-04 00:00:00', 1, 1, 1, NULL, '0000-00-00 00:00:00'),
(2, 1, 3, '2011-11-10 00:00:00', 2, 1, 1, NULL, NULL),
(3, 2, 4, '2011-11-17 00:00:00', 2, 1, 1, 2, NULL),
(4, 3, 3, '2011-11-02 00:00:00', 2, 1, 1, 3, NULL),
(5, 4, 3, '2011-11-08 00:00:00', 2, 1, 1, 3, NULL),
(6, 5, 5, '2011-11-27 18:36:31', 2, 1, 1, NULL, NULL),
(7, 6, 5, '2011-11-28 16:26:10', 2, 1, 1, 2, NULL),
(8, 7, 6, '2011-11-28 19:53:34', 2, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `maladies`
--

CREATE TABLE IF NOT EXISTS `maladies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

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
(8, 'Problème neurologique');

-- --------------------------------------------------------

--
-- Structure de la table `medicaments`
--

CREATE TABLE IF NOT EXISTS `medicaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `medicaments`
--

INSERT INTO `medicaments` (`id`, `nom`) VALUES
(1, 'Anti-histaminique pour allergies (Benadryl, etc )'),
(2, 'Acétaminophène (Tylénol, Tempora, etc )');

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

-- --------------------------------------------------------

--
-- Structure de la table `paiement_types`
--

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
-- Structure de la table `paiements`
--

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

INSERT INTO `paiements` (`id`, `date_paiements`, `montant`, `facture_id`, `paiement_type_id`, `date_reception`, `ordre_paiement`) VALUES
(5, NULL, 195, 5, 2, NULL, 1),
(6, '2011-11-28 14:40:08', 85, 6, 4, '2011-11-28 14:39:57', 1),
(7, '2011-11-28 14:40:08', 70, 6, 4, '2011-11-28 14:39:57', 2),
(8, '2011-11-28 14:40:08', 70, 6, 4, '2011-11-28 14:39:57', 3),
(14, NULL, 175, 10, 2, '2011-11-28 12:25:20', 1),
(15, '2011-11-28 16:41:08', 195, 11, 2, '2011-11-28 16:29:25', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `posologie`, `fiche_medicale_id`) VALUES
(1, '1 fois par jour', 1),
(2, 'tylenol 2 fois par jour', 3);

-- --------------------------------------------------------

--
-- Structure de la table `question_generales`
--

CREATE TABLE IF NOT EXISTS `question_generales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(200) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `question_generales`
--

INSERT INTO `question_generales` (`id`, `texte`) VALUES
(1, 'Ses VACCINS sont-ils à jour ?'),
(2, 'A-t-il un ÉPIPEN ?');

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

-- --------------------------------------------------------

--
-- Structure de la table `type_sujets`
--

CREATE TABLE IF NOT EXISTS `type_sujets` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

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
(3, 3, 'Team ninja'),
(4, 5, 'Colonie de Balquenouille'),
(5, 6, 'Les pionniers');

-- --------------------------------------------------------

--
-- Structure de la table `versements`
--

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
