-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 23 mai 2023 à 09:21
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cse-lcv`
--

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

CREATE TABLE `droit` (
  `Id_Droit` int(11) NOT NULL,
  `Libelle_Droit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `droit`
--

INSERT INTO `droit` (`Id_Droit`, `Libelle_Droit`) VALUES
(1, 'Florian'),
(2, 'Yannis'),
(3, 'Tom');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `Id_Image` int(11) NOT NULL,
  `Nom_Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`Id_Image`, `Nom_Image`) VALUES
(1, 'Chanel-LogoPNG1.png'),
(2, 'Lindt-Logo.png'),
(3, '1280px-Bic_Logo.svg.png'),
(4, 'enedis-presentation.png'),
(5, '6027ec7bed4efb000419981e.png'),
(6, '79183.png'),
(7, 'transbois.png'),
(8, '1200px-Logo_Parc_Astérix_2020.png'),
(9, 'Confiserie_Leonidas_SA_logo.png'),
(10, '79915_0_202008141133149082427.png');

-- --------------------------------------------------------

--
-- Structure de la table `info_accueil`
--

CREATE TABLE `info_accueil` (
  `Id_Info_Accueil` int(11) NOT NULL,
  `Num_Tel_Info_Accueil` bigint(255) NOT NULL,
  `Email_Info_Accueil` varchar(255) NOT NULL,
  `Emplacement_Bureau_Info_Accueil` varchar(255) NOT NULL,
  `Titre_Info_Accueil` varchar(255) NOT NULL,
  `Texte_Info_Accueil` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `info_accueil`
--

INSERT INTO `info_accueil` (`Id_Info_Accueil`, `Num_Tel_Info_Accueil`, `Email_Info_Accueil`, `Emplacement_Bureau_Info_Accueil`, `Titre_Info_Accueil`, `Texte_Info_Accueil`) VALUES
(1, 33303030303, 'cse@lyceestvincent.fr', 'Bureau du CSE', 'CSE Lycée Saint-Vincent', 'Nous vous souhaitons la bienvenue sur le site du comité social et économique du lycée Saint-Vincent à Senlis. Découvrez l’équipe, le rôle et missions de votre CSE.');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `Id_Message` int(11) NOT NULL,
  `Nom_Message` varchar(100) NOT NULL,
  `Prenom_Message` varchar(100) NOT NULL,
  `Email_Message` varchar(255) NOT NULL,
  `Contenu_Message` varchar(3000) NOT NULL,
  `Id_Offre` int(11) DEFAULT NULL,
  `Id_Partenaire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`Id_Message`, `Nom_Message`, `Prenom_Message`, `Email_Message`, `Contenu_Message`, `Id_Offre`, `Id_Partenaire`) VALUES
(1, 'Sauvage', 'Florian', 'florian.sauvage.etudiant@gmail.com', 'Bonjour, j\'aimerai avoir des renseignements supplémentaire sur la réduction des parfums Chanel à savoir si c\'est limité à une gamme en particulier.', 1, 31),
(2, 'Moncet', 'Yannis', 'moncet.yannis@lyceestvincent.fr', 'L\'offre Lindt est-t-elle toujours disponible ?', 2, 32),
(3, 'Zarb', 'Tom', 'zarb.tom@lyceestvincent.fr', 'L\'offre est limité à combien de lots par foyer ?', 3, 33);

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `Id_Offre` int(11) NOT NULL,
  `Nom_Offre` varchar(255) NOT NULL,
  `Description_Offre` varchar(3000) NOT NULL,
  `Date_Debut_Offre` date NOT NULL,
  `Date_Fin_Offre` date NOT NULL,
  `Nombre_Place_Min_Offre` int(11) NOT NULL,
  `Id_Partenaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`Id_Offre`, `Nom_Offre`, `Description_Offre`, `Date_Debut_Offre`, `Date_Fin_Offre`, `Nombre_Place_Min_Offre`, `Id_Partenaire`) VALUES
(1, 'Réduction de parfums Chanel', '-20% sur la gamme de parfums COCO', '2023-03-20', '2023-03-25', 8, 31),
(2, 'Lot variés chocolats Lindt', 'Profitez d\'un lot de dégustation de chocolats Lindt à prix réduit.', '2023-08-20', '2023-08-25', 20, 32),
(3, 'Réduction sur les fournitures scolaires Bic', '-20% sur la sélection de stylos 4 couleurs de la marque Bic', '2024-02-20', '2024-02-25', 80, 33),
(4, 'Aperitif dinatoire Enedis', 'Enedis vous invite à un apéritif dinatoire afin d\'inaugurer leur nouvelle structures le 13 Mai 2023', '2023-05-13', '2023-05-13', 20, 34),
(5, 'Offre sur les friandises Whiskas', 'Réduction sur un sélection de friandises Whiskas', '2024-01-04', '2024-01-12', 200, 35),
(6, 'Prix réduit sur la gamme Zenfone', '-100€ sur les téléphones de la gamme Zenfone', '2024-04-01', '2024-04-06', 2500, 36),
(7, 'Places de cinéma offertes', 'La société Trans-Bois propose aux membres du CSE Saint Vincent des places de cinéma de Compiègne pour le film de votre choix', '2023-03-22', '2023-03-29', 30, 37),
(8, 'Parc-Asterix 25ans', 'Le Parc Asterix fête ses 25 ans, et pour cette occasion, les places sont moitié-prix', '2023-07-14', '2023-08-14', 2000, 38),
(9, 'Chocolats à double-prix chez Leonidas (inflation)', 'Leonidas est en difficulté pour redresser la barre, ils vendent leurs chocolats à prix d\'or.', '2023-03-20', '2025-03-20', 0, 39),
(10, 'Libeltex nouveaux produits', 'Pour le respect de l\'environnement, le groupe TWE invite au sein de l\'usine de Crépy-en-Valois afin de présenter une partie de son procédé de fabrication respectant les nouvelles normes écologiques', '2024-10-02', '2024-10-02', 15, 40);

-- --------------------------------------------------------

--
-- Structure de la table `offre_image`
--

CREATE TABLE `offre_image` (
  `Id_Offre` int(11) NOT NULL,
  `Id_Image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `offre_image`
--

INSERT INTO `offre_image` (`Id_Offre`, `Id_Image`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE `partenaire` (
  `Id_Partenaire` int(11) NOT NULL,
  `Nom_Partenaire` varchar(255) NOT NULL,
  `Description_Partenaire` varchar(3000) NOT NULL,
  `Lien_Partenaire` varchar(500) NOT NULL,
  `Id_Image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `partenaire`
--

INSERT INTO `partenaire` (`Id_Partenaire`, `Nom_Partenaire`, `Description_Partenaire`, `Lien_Partenaire`, `Id_Image`) VALUES
(31, 'Chanel', 'Chanel ou Chanel SAS est une entreprise française productrice de haute couture, ainsi que de prêt-à-porter, accessoires, parfums et divers produits de luxe.', 'https://www.chanel.com/fr/', 1),
(32, 'Lindt', 'Lindt & Sprüngli AG est un fabricant de chocolat ayant son siège social à Kilchberg dans le canton de Zurich en Suisse.', 'https://www.lindt.fr/', 2),
(33, 'Bic', 'BIC est une société française fondée le 25 octobre 1945, dont le siège social se situe à Clichy. L’entreprise est principalement connue pour ses stylos commercialisés sous la marque BIC, BIC Kids ou Conté.', 'https://fr.bic.com/fr', 3),
(34, 'Enedis', 'Enedis, anciennement ERDF, est une société anonyme à conseil de surveillance et directoire, filiale à 100 % de EDF chargée de la gestion et des aménagement de 95 % du réseau de distribution électricité en France.', 'https://www.enedis.fr/', 4),
(35, 'Whiskas', 'Whiskas est une marque commerciale en alimentation pour chat du groupe agro-industriel américain Mars Incorporated. Les produits sous cette marque sont composés de produits et de sous-produits carnés et contenant des additifs conservés en poche ou en boîte.', 'https://www.whiskas.fr/', 5),
(36, 'Asus', 'AsusTeK Computer, Inc., en forme courte Asus, est une entreprise taïwanaise qui produit des cartes mères, des cartes graphiques, des lecteurs optiques, des assistants personnels, des ordinateurs ...', 'https://www.asus.com/fr/', 6),
(37, 'Trans-Bois', 'Trans-Bois, entreprise familiale basée en Oise proche de Paris est spécialisée dans les étude, la conception et la fabrication de moules, coffrages, et ouvrages en bois sur-mesure, destinés au coulage du béton armé.', 'https://www.transbois.fr/', 7),
(38, 'Parc-Asterix', 'Le parc Astérix est un complexe touristique comprenant un parc à thèmes et trois hôtels, ouvert le 30 avril 1989 et géré par la compagnie des Alpes — une filiale de la Caisse des dépôts — depuis 2002.', 'https://www.parcasterix.fr/', 8),
(39, 'Leonidas', 'Leonidas est une marque commerciale déposée de pralines belges, créée en 1913 par Léonidas Kestekides, qui appartient à la société des industries agroalimentaire Confiserie Leonidas.', 'https://www.leonidas.com/gb_en', 9),
(40, 'Libeltex TWE', 'Fournisseur de matériel médical, chirurgical et automobile à Crépy-en-Valois', 'https://www.twe-group.com/', 10);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `Id_Utilisateur` int(11) NOT NULL,
  `Nom_Utilisateur` varchar(100) NOT NULL,
  `Prenom_Utilisateur` varchar(100) NOT NULL,
  `Email_Utilisateur` varchar(255) NOT NULL,
  `Password_Utilisateur` varchar(255) NOT NULL,
  `Id_Droit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Id_Utilisateur`, `Nom_Utilisateur`, `Prenom_Utilisateur`, `Email_Utilisateur`, `Password_Utilisateur`, `Id_Droit`) VALUES
(1, 'Sauvage', 'Florian', 'florian.sauvage.etudiant@gmail.com', 'adminf', 1),
(4, 'Moncet', 'Yannis', 'moncet.yannis@lyceestvincent.fr', 'adminy', 2),
(5, 'Zarb', 'Tom', 'zarb.tom@lyceestvincent.fr', 'admint', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `droit`
--
ALTER TABLE `droit`
  ADD PRIMARY KEY (`Id_Droit`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`Id_Image`);

--
-- Index pour la table `info_accueil`
--
ALTER TABLE `info_accueil`
  ADD PRIMARY KEY (`Id_Info_Accueil`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Id_Message`),
  ADD KEY `fk_Id_Offre` (`Id_Offre`),
  ADD KEY `fk_Id_Partenaire2` (`Id_Partenaire`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`Id_Offre`),
  ADD KEY `fk_Id_Partenaire` (`Id_Partenaire`);

--
-- Index pour la table `offre_image`
--
ALTER TABLE `offre_image`
  ADD PRIMARY KEY (`Id_Offre`,`Id_Image`),
  ADD KEY `fk_Id_image2` (`Id_Image`),
  ADD KEY `Id_Offre` (`Id_Offre`);

--
-- Index pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`Id_Partenaire`),
  ADD KEY `fk_Id_Image` (`Id_Image`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Id_Utilisateur`),
  ADD KEY `fk_Id_Droit` (`Id_Droit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `droit`
--
ALTER TABLE `droit`
  MODIFY `Id_Droit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `Id_Image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `info_accueil`
--
ALTER TABLE `info_accueil`
  MODIFY `Id_Info_Accueil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `Id_Message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `Id_Offre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `Id_Partenaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `Id_Utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_Id_Offre` FOREIGN KEY (`Id_Offre`) REFERENCES `offre` (`Id_Offre`),
  ADD CONSTRAINT `fk_Id_Partenaire2` FOREIGN KEY (`Id_Partenaire`) REFERENCES `partenaire` (`Id_Partenaire`);

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `fk_Id_Partenaire` FOREIGN KEY (`Id_Partenaire`) REFERENCES `partenaire` (`Id_Partenaire`);

--
-- Contraintes pour la table `offre_image`
--
ALTER TABLE `offre_image`
  ADD CONSTRAINT `fk_Id_Offre2` FOREIGN KEY (`Id_Offre`) REFERENCES `offre` (`Id_Offre`),
  ADD CONSTRAINT `fk_Id_image2` FOREIGN KEY (`Id_Image`) REFERENCES `images` (`Id_Image`);

--
-- Contraintes pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD CONSTRAINT `fk_Id_Image` FOREIGN KEY (`Id_Image`) REFERENCES `images` (`Id_Image`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_Id_Droit` FOREIGN KEY (`Id_Droit`) REFERENCES `droit` (`Id_Droit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
