CREATE TABLE `encuesta` (
  `idenc` int(7) NOT NULL auto_increment,
  `pregunta` varchar(255) NOT NULL default '',
  `nrovotos` int(7) default '0',
  `opciones` text NOT NULL,
  `respuestas` text NOT NULL,
  KEY `id` (`idenc`)
) ENGINE=MyISAM;