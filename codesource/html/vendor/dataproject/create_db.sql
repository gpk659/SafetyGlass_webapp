CREATE TABLE `defaut_agc` (
  `idDefaut_AGC` int(11) NOT NULL AUTO_INCREMENT,
  `initialeTypeDefaut` varchar(1) NOT NULL,
  `X0` int(4) NOT NULL,
  `Y0` int(4) NOT NULL,
  `X1` int(4) NOT NULL,
  `Y1` int(4) NOT NULL,
  `plateau_idPlateau` int(10) NOT NULL,
  PRIMARY KEY (`idDefaut_AGC`),
  UNIQUE KEY `idDefaut_AGC_UNIQUE` (`idDefaut_AGC`),
  KEY `fk_defaut_agc_plateau1_idx` (`plateau_idPlateau`),
  CONSTRAINT `fk_defaut_agc_plateau1` FOREIGN KEY (`plateau_idPlateau`) REFERENCES `plateau` (`idPlateau`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `emplacement` (
  `idEmplacement` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `largeurPied` int(4) DEFAULT NULL,
  `poidsMax` int(6) DEFAULT NULL,
  `usine_idUsine` int(10) NOT NULL,
  `zone_idZone` int(11) NOT NULL,
  `rack_idRack` int(10) NOT NULL,
  PRIMARY KEY (`idEmplacement`),
  KEY `fk_emplacement_usine1_idx` (`usine_idUsine`),
  KEY `fk_emplacement_zone1_idx` (`zone_idZone`),
  KEY `fk_emplacement_rack1_idx` (`rack_idRack`),
  CONSTRAINT `fk_emplacement_rack1` FOREIGN KEY (`rack_idRack`) REFERENCES `rack` (`idRack`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emplacement_usine1` FOREIGN KEY (`usine_idUsine`) REFERENCES `usine` (`idUsine`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emplacement_zone1` FOREIGN KEY (`zone_idZone`) REFERENCES `zone` (`idZone`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

CREATE TABLE `fammille_type` (
  `idFammille_Type` int(11) NOT NULL AUTO_INCREMENT,
  `nomFammille_Type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idFammille_Type`),
  UNIQUE KEY `idFammille_Type_UNIQUE` (`idFammille_Type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE TABLE `listechutte` (
  `idChutte` int(10) NOT NULL AUTO_INCREMENT,
  `largeur` int(4) DEFAULT NULL,
  `hauteur` int(4) DEFAULT NULL,
  `X0` int(4) DEFAULT NULL,
  `Y0` int(4) DEFAULT NULL,
  `dateMiseStock` date DEFAULT NULL,
  `heureMiseStock` time DEFAULT NULL,
  `commentaire` varchar(255) NOT NULL,
  `dateReutilisation` date DEFAULT NULL,
  `heureReutilisation` time DEFAULT NULL,
  `positionEmp` int(4) DEFAULT NULL,
  `plateau_idPlateau` int(10) NOT NULL,
  `emplacement_idEmplacement` int(10) NOT NULL,
  `type_idType` int(11) NOT NULL,
  PRIMARY KEY (`idChutte`),
  UNIQUE KEY `idChutte_UNIQUE` (`idChutte`),
  KEY `fk_listechutte_plateau1_idx` (`plateau_idPlateau`),
  KEY `fk_listechutte_emplacement1_idx` (`emplacement_idEmplacement`),
  CONSTRAINT `fk_listechutte_emplacement1` FOREIGN KEY (`emplacement_idEmplacement`) REFERENCES `emplacement` (`idEmplacement`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_listechutte_plateau1` FOREIGN KEY (`plateau_idPlateau`) REFERENCES `plateau` (`idPlateau`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

CREATE TABLE `listedefaut` (
  `idDefaut` int(10) NOT NULL AUTO_INCREMENT,
  `X0` int(10) DEFAULT NULL,
  `Y0` int(10) DEFAULT NULL,
  `X1` int(10) DEFAULT NULL,
  `Y1` int(10) DEFAULT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `plateau_idPlateau` int(10) NOT NULL,
  PRIMARY KEY (`idDefaut`),
  UNIQUE KEY `idDefaut_UNIQUE` (`idDefaut`),
  KEY `fk_listedefaut_plateau1_idx` (`plateau_idPlateau`),
  CONSTRAINT `fk_listedefaut_plateau1` FOREIGN KEY (`plateau_idPlateau`) REFERENCES `plateau` (`idPlateau`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `listeoperateur` (
  `idOperateur` int(11) NOT NULL AUTO_INCREMENT,
  `initialesOp` varchar(3) DEFAULT NULL,
  `nomOp` varchar(45) DEFAULT NULL,
  `usine_idUsine` int(10) NOT NULL,
  `zone_idZone` int(11) NOT NULL,
  PRIMARY KEY (`idOperateur`),
  UNIQUE KEY `idOperateur_UNIQUE` (`idOperateur`),
  KEY `fk_listeoperateur_usine1_idx` (`usine_idUsine`),
  KEY `fk_listeoperateur_zone1_idx` (`zone_idZone`),
  CONSTRAINT `fk_listeoperateur_usine1` FOREIGN KEY (`usine_idUsine`) REFERENCES `usine` (`idUsine`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_listeoperateur_zone1` FOREIGN KEY (`zone_idZone`) REFERENCES `zone` (`idZone`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `listevolume` (
  `idListeVolume` int(11) NOT NULL AUTO_INCREMENT,
  `numCom` varchar(45) NOT NULL,
  `lettre` varchar(3) NOT NULL,
  `x` int(11) DEFAULT NULL,
  `nnn` int(11) DEFAULT NULL,
  `datelivraison` date DEFAULT NULL,
  `typeverre` varchar(45) DEFAULT NULL,
  `largeur` varchar(45) NOT NULL,
  `hauteur` varchar(45) NOT NULL,
  `faconnage` varchar(45) DEFAULT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `chutesug` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idListeVolume`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

CREATE TABLE `listevolumesbons` (
  `idVolume` int(11) NOT NULL AUTO_INCREMENT,
  `numCom` varchar(45) NOT NULL,
  `lettre` varchar(3) NOT NULL,
  `numVol` int(4) DEFAULT NULL,
  `largeur` int(4) NOT NULL,
  `hauteur` int(4) NOT NULL,
  `X0` int(4) DEFAULT NULL,
  `Y0` int(4) DEFAULT NULL,
  `dateFabrication` date NOT NULL,
  `heureFabrication` time DEFAULT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idVolume`),
  UNIQUE KEY `idVolume_UNIQUE` (`idVolume`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

CREATE TABLE `plateau` (
  `idPlateau` int(10) NOT NULL AUTO_INCREMENT,
  `idEmplacement` int(10) NOT NULL,
  `numCadre` varchar(45) DEFAULT NULL,
  `positionCadre` int(4) NOT NULL,
  `numPlateau` varchar(45) NOT NULL,
  `largeur` int(4) NOT NULL,
  `hauteur` int(4) NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `nomFournisseur` varchar(45) NOT NULL,
  `numCommande` varchar(45) NOT NULL,
  PRIMARY KEY (`idPlateau`),
  UNIQUE KEY `idPlateau_UNIQUE` (`idPlateau`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `rack` (
  `idRack` int(10) NOT NULL AUTO_INCREMENT,
  `abreviation` varchar(5) DEFAULT NULL,
  `nomRack` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `largeur` int(6) DEFAULT NULL,
  `longueur` int(6) DEFAULT NULL,
  `X0` int(6) DEFAULT NULL,
  `Y0` int(6) DEFAULT NULL,
  `zone_idZone` int(11) NOT NULL,
  PRIMARY KEY (`idRack`),
  KEY `fk_rack_zone_idx` (`zone_idZone`),
  CONSTRAINT `fk_rack_zone` FOREIGN KEY (`zone_idZone`) REFERENCES `zone` (`idZone`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

CREATE TABLE `sousfamille_type` (
  `idSousFamille_Type` int(10) NOT NULL AUTO_INCREMENT,
  `nomSousFamilleType` varchar(45) DEFAULT NULL,
  `fammille_type_idFammille_Type` int(11) NOT NULL,
  PRIMARY KEY (`idSousFamille_Type`),
  UNIQUE KEY `idSousFamille_Type_UNIQUE` (`idSousFamille_Type`),
  KEY `fk_sousfamille_type_fammille_type1_idx` (`fammille_type_idFammille_Type`),
  CONSTRAINT `fk_sousfamille_type_fammille_type1` FOREIGN KEY (`fammille_type_idFammille_Type`) REFERENCES `fammille_type` (`idFammille_Type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

CREATE TABLE `type` (
  `idType` int(10) NOT NULL AUTO_INCREMENT,
  `nomType` varchar(45) DEFAULT NULL,
  `epType` double DEFAULT NULL,
  `masseType` double DEFAULT NULL,
  `codeAGCType` varchar(45) DEFAULT NULL,
  `sousfamille_type_idSousFamille_Type` int(10) NOT NULL,
  `descriptionCourte` varchar(45) NOT NULL,
  `descriptionComplete` varchar(45) NOT NULL,
  PRIMARY KEY (`idType`),
  UNIQUE KEY `idType_UNIQUE` (`idType`),
  KEY `fk_type_sousfamille_type1_idx` (`sousfamille_type_idSousFamille_Type`),
  CONSTRAINT `fk_type_sousfamille_type1` FOREIGN KEY (`sousfamille_type_idSousFamille_Type`) REFERENCES `sousfamille_type` (`idSousFamille_Type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

CREATE TABLE `typedefautagc` (
  `idTypeDefautAGC` int(10) NOT NULL AUTO_INCREMENT,
  `descriptionTypeDefaut` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idTypeDefautAGC`),
  UNIQUE KEY `idTypeDefautAGC_UNIQUE` (`idTypeDefautAGC`)
) ENGINE=InnoDB AUTO_INCREMENT=1103 DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `dateLastLogin` datetime DEFAULT NULL,
  `nivdroit` int(1) NOT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `iduser_UNIQUE` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

CREATE TABLE `usine` (
  `idUsine` int(10) NOT NULL AUTO_INCREMENT,
  `abreviation` varchar(2) DEFAULT NULL,
  `nomUsine` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `largeur` int(6) DEFAULT NULL,
  `longueur` int(6) DEFAULT NULL,
  `subdivisionLargeur` int(4) DEFAULT NULL,
  `subdivisionLongueur` int(4) DEFAULT NULL,
  `nomFichierPlan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUsine`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `zone` (
  `idZone` int(11) NOT NULL AUTO_INCREMENT,
  `abreviation` varchar(2) DEFAULT NULL,
  `nomZone` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `largeur` int(6) DEFAULT NULL,
  `longueur` int(6) DEFAULT NULL,
  `X0` int(6) DEFAULT NULL,
  `Y0` int(6) DEFAULT NULL,
  `usine_idUsine` int(10) NOT NULL,
  PRIMARY KEY (`idZone`),
  KEY `fk_zone_usine1_idx` (`usine_idUsine`),
  CONSTRAINT `fk_zone_usine1` FOREIGN KEY (`usine_idUsine`) REFERENCES `usine` (`idUsine`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
