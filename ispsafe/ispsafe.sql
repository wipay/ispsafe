-- MySQL dump 10.11
--
-- Host: localhost    Database: ispsafe
-- ------------------------------------------------------
-- Server version	5.0.75-0ubuntu10.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `nas`
--

DROP TABLE IF EXISTS `nas`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `nas` (
  `id` int(10) NOT NULL auto_increment,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) default NULL,
  `type` varchar(30) default 'other',
  `ports` int(5) default NULL,
  `secret` varchar(60) NOT NULL default 'secret',
  `community` varchar(50) default NULL,
  `description` varchar(200) default 'RADIUS Client',
  PRIMARY KEY  (`id`),
  KEY `nasname` (`nasname`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `nas`
--

LOCK TABLES `nas` WRITE;
/*!40000 ALTER TABLE `nas` DISABLE KEYS */;
/*!40000 ALTER TABLE `nas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radacct`
--

DROP TABLE IF EXISTS `radacct`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `radacct` (
  `RadAcctId` bigint(21) NOT NULL auto_increment,
  `AcctSessionId` varchar(32) NOT NULL default '',
  `AcctUniqueId` varchar(32) NOT NULL default '',
  `UserName` varchar(64) NOT NULL default '',
  `Realm` varchar(64) default '',
  `NASIPAddress` varchar(15) NOT NULL default '',
  `NASPortId` varchar(15) default NULL,
  `NASPortType` varchar(32) default NULL,
  `AcctStartTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `AcctStopTime` datetime default '0000-00-00 00:00:00',
  `AcctSessionTime` int(12) default NULL,
  `AcctAuthentic` varchar(32) default NULL,
  `ConnectInfo_start` varchar(50) default NULL,
  `ConnectInfo_stop` varchar(50) default NULL,
  `AcctInputOctets` bigint(12) default NULL,
  `AcctOutputOctets` bigint(12) default NULL,
  `CalledStationId` varchar(50) NOT NULL default '',
  `CallingStationId` varchar(50) NOT NULL default '',
  `AcctTerminateCause` varchar(32) NOT NULL default '',
  `ServiceType` varchar(32) default NULL,
  `FramedProtocol` varchar(32) default NULL,
  `FramedIPAddress` varchar(15) NOT NULL default '',
  `AcctStartDelay` int(12) default NULL,
  `AcctStopDelay` int(12) default NULL,
  `XAscendSessionSvrKey` int(10) NOT NULL,
  PRIMARY KEY  (`RadAcctId`),
  KEY `UserName` (`UserName`),
  KEY `FramedIPAddress` (`FramedIPAddress`),
  KEY `AcctSessionId` (`AcctSessionId`),
  KEY `AcctUniqueId` (`AcctUniqueId`),
  KEY `AcctStartTime` (`AcctStartTime`),
  KEY `AcctStopTime` (`AcctStopTime`),
  KEY `NASIPAddress` (`NASIPAddress`)
) ENGINE=MyISAM AUTO_INCREMENT=4199446 DEFAULT CHARSET=latin1 PACK_KEYS=0;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `radacct`
--

LOCK TABLES `radacct` WRITE;
/*!40000 ALTER TABLE `radacct` DISABLE KEYS */;
/*!40000 ALTER TABLE `radacct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radcheck`
--

DROP TABLE IF EXISTS `radcheck`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `radcheck` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `UserName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '==',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `UserName` (`UserName`(32))
) ENGINE=MyISAM AUTO_INCREMENT=6429 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `radcheck`
--

LOCK TABLES `radcheck` WRITE;
/*!40000 ALTER TABLE `radcheck` DISABLE KEYS */;
/*!40000 ALTER TABLE `radcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radgroupcheck`
--

DROP TABLE IF EXISTS `radgroupcheck`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `radgroupcheck` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `GroupName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '==',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `GroupName` (`GroupName`(32))
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `radgroupcheck`
--

LOCK TABLES `radgroupcheck` WRITE;
/*!40000 ALTER TABLE `radgroupcheck` DISABLE KEYS */;
/*!40000 ALTER TABLE `radgroupcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radgroupreply`
--

DROP TABLE IF EXISTS `radgroupreply`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `radgroupreply` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `GroupName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '=',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `GroupName` (`GroupName`(32))
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `radgroupreply`
--

LOCK TABLES `radgroupreply` WRITE;
/*!40000 ALTER TABLE `radgroupreply` DISABLE KEYS */;
/*!40000 ALTER TABLE `radgroupreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radpostauth`
--

DROP TABLE IF EXISTS `radpostauth`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `radpostauth` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL default '',
  `reply` varchar(32) NOT NULL default '',
  `authdate` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7598454 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `radpostauth`
--

LOCK TABLES `radpostauth` WRITE;
/*!40000 ALTER TABLE `radpostauth` DISABLE KEYS */;
/*!40000 ALTER TABLE `radpostauth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radreply`
--

DROP TABLE IF EXISTS `radreply`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `radreply` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `UserName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '=',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `UserName` (`UserName`(32))
) ENGINE=MyISAM AUTO_INCREMENT=4060 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `radreply`
--

LOCK TABLES `radreply` WRITE;
/*!40000 ALTER TABLE `radreply` DISABLE KEYS */;
/*!40000 ALTER TABLE `radreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_TecClientes`
--

DROP TABLE IF EXISTS `tbl_TecClientes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_TecClientes` (
  `id` int(5) NOT NULL auto_increment,
  `usuario` varchar(30) default NULL,
  `senha` varchar(30) default NULL,
  `dominio` varchar(30) default NULL,
  `pop` varchar(30) default NULL,
  `ap` int(3) default NULL,
  `ip` varchar(15) default NULL,
  `mascara` varchar(15) default '255.255.255.255',
  `mac` varchar(17) default NULL,
  `banda` varchar(40) default '128k/256k 256k/512k 160k/192k 8/8',
  `status` enum('ATIVO','BLOQUEADO') default 'ATIVO',
  `motivoBloqueio` longtext,
  `wpaPsk` varchar(50) default NULL,
  `eqptoPwd` varchar(50) default NULL,
  `loginFinanceiro` varchar(50) default NULL,
  `emailContato` varchar(300) default NULL,
  `nome` varchar(100) default NULL,
  `endereco` varchar(100) default NULL,
  `numero` varchar(5) default NULL,
  `bairro` varchar(30) default NULL,
  `cidade` varchar(50) default NULL,
  `uf` varchar(2) default NULL,
  `cep` varchar(9) default NULL,
  `cnpj` varchar(50) default NULL,
  `cpf` varchar(50) default NULL,
  `rg` varchar(50) default NULL,
  `ie` varchar(50) default NULL,
  `telefone` varchar(20) default NULL,
  `celular` varchar(20) default NULL,
  `funcionario` varchar(20) default NULL,
  `dataUltMod` datetime default NULL,
  `observacoes` longtext,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=MyISAM AUTO_INCREMENT=1230 DEFAULT CHARSET=latin1 COMMENT='Dados Tcnicos dos Clientes';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_TecClientes`
--

LOCK TABLES `tbl_TecClientes` WRITE;
/*!40000 ALTER TABLE `tbl_TecClientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_TecClientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ap`
--

DROP TABLE IF EXISTS `tbl_ap`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_ap` (
  `id` int(11) NOT NULL auto_increment,
  `estacao` varchar(50) NOT NULL,
  `accesspoint` varchar(50) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `snmp` varchar(50) NOT NULL,
  `pop` varchar(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1 COMMENT='Tabela de Acess Points';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_ap`
--

LOCK TABLES `tbl_ap` WRITE;
/*!40000 ALTER TABLE `tbl_ap` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ativacao`
--

DROP TABLE IF EXISTS `tbl_ativacao`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_ativacao` (
  `id` int(5) NOT NULL auto_increment,
  `loginFinanceiro` varchar(50) default 'NAO_INFORMADO',
  `emailContato` varchar(200) default NULL,
  `usuario` varchar(30) default NULL,
  `senha` varchar(30) default NULL,
  `banda` varchar(40) NOT NULL default '128k/256k 256k/512k 160k/192k 8/8',
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(5) default NULL,
  `bairro` varchar(30) default NULL,
  `cep` varchar(9) NOT NULL,
  `cnpj` varchar(25) default NULL,
  `cpf` varchar(15) default NULL,
  `rg` varchar(15) default NULL,
  `ie` varchar(25) default NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) default NULL,
  `observacoes` blob,
  `mac` varchar(20) default NULL,
  `ap` varchar(5) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=881 DEFAULT CHARSET=latin1 COMMENT='Tabela temporria de Ativao de Clientes Wireless';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_ativacao`
--

LOCK TABLES `tbl_ativacao` WRITE;
/*!40000 ALTER TABLE `tbl_ativacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_ativacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_banda`
--

DROP TABLE IF EXISTS `tbl_banda`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_banda` (
  `band_id` int(3) NOT NULL auto_increment,
  `band_plano` varchar(20) NOT NULL,
  `band_configuracao` varchar(50) NOT NULL,
  `band_observacoes` blob NOT NULL,
  PRIMARY KEY  (`band_id`),
  UNIQUE KEY `band_plano` (`band_plano`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_banda`
--

LOCK TABLES `tbl_banda` WRITE;
/*!40000 ALTER TABLE `tbl_banda` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_banda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_bloqueio`
--

DROP TABLE IF EXISTS `tbl_bloqueio`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_bloqueio` (
  `id` int(11) NOT NULL auto_increment,
  `dataBloqueio` date NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `motivo` enum('ADMINISTRATIVO','FINANCEIRO','CANCELAMENTO') NOT NULL,
  `status` enum('AGUARDANDO','RETIRADO','AGENDADO','RETIRAR') NOT NULL default 'AGUARDANDO',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=837 DEFAULT CHARSET=latin1 COMMENT='Registro de Bloqueios de Clientes';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_bloqueio`
--

LOCK TABLES `tbl_bloqueio` WRITE;
/*!40000 ALTER TABLE `tbl_bloqueio` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_bloqueio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_derruba`
--

DROP TABLE IF EXISTS `tbl_derruba`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_derruba` (
  `login` varchar(50) NOT NULL,
  PRIMARY KEY  (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_derruba`
--

LOCK TABLES `tbl_derruba` WRITE;
/*!40000 ALTER TABLE `tbl_derruba` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_derruba` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_modificacoes`
--

DROP TABLE IF EXISTS `tbl_modificacoes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_modificacoes` (
  `id` int(10) NOT NULL auto_increment,
  `data` datetime NOT NULL,
  `usuarioSistema` varchar(20) NOT NULL,
  `loginCliente` varchar(20) NOT NULL,
  `antes` longtext NOT NULL,
  `depois` longtext NOT NULL,
  `concluido` enum('S','N') NOT NULL default 'N',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5599 DEFAULT CHARSET=latin1 COMMENT='Tabela com histÃ³rico de modificaÃ§Ãµes dos Clientes';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_modificacoes`
--

LOCK TABLES `tbl_modificacoes` WRITE;
/*!40000 ALTER TABLE `tbl_modificacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_modificacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_paginas`
--

DROP TABLE IF EXISTS `tbl_paginas`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_paginas` (
  `id` int(3) NOT NULL auto_increment,
  `pagina` varchar(50) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `pagina` (`pagina`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_paginas`
--

LOCK TABLES `tbl_paginas` WRITE;
/*!40000 ALTER TABLE `tbl_paginas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_paginas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permissao`
--

DROP TABLE IF EXISTS `tbl_permissao`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_permissao` (
  `id` int(5) NOT NULL auto_increment,
  `usuario` int(5) NOT NULL,
  `pop` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COMMENT='Tabela de Permissões de usuários para visualizarem clientes';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_permissao`
--

LOCK TABLES `tbl_permissao` WRITE;
/*!40000 ALTER TABLE `tbl_permissao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pop`
--

DROP TABLE IF EXISTS `tbl_pop`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_pop` (
  `id` int(3) NOT NULL auto_increment,
  `dominio` varchar(30) NOT NULL,
  `pop` varchar(30) NOT NULL,
  `ip` varchar(15) default NULL,
  `snmp` varchar(25) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `dominio` (`dominio`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_pop`
--

LOCK TABLES `tbl_pop` WRITE;
/*!40000 ALTER TABLE `tbl_pop` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sinal`
--

DROP TABLE IF EXISTS `tbl_sinal`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_sinal` (
  `id` int(10) NOT NULL auto_increment,
  `cliente` int(5) NOT NULL,
  `data` datetime NOT NULL,
  `sinal` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cliente` (`cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=31445593 DEFAULT CHARSET=latin1 COMMENT='Tabela de monitoramento de sinal dos clientes';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_sinal`
--

LOCK TABLES `tbl_sinal` WRITE;
/*!40000 ALTER TABLE `tbl_sinal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_sinal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tbl_usuario` (
  `id` int(5) NOT NULL auto_increment,
  `login` varchar(20) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `nivel` int(5) NOT NULL,
  `acesso` varchar(18) NOT NULL,
  `grupo` varchar(30) NOT NULL default 'read',
  `status` enum('ATIVO','REMOVIDO') NOT NULL default 'ATIVO',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (42,'ispsafe','ispsafe','Usuario Administrativo ISP Safe',1,'0.0.0.0/0','full','ATIVO');
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usergroup`
--

DROP TABLE IF EXISTS `usergroup`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `usergroup` (
  `UserName` varchar(64) NOT NULL default '',
  `GroupName` varchar(64) NOT NULL default '',
  `priority` int(11) NOT NULL default '1',
  KEY `UserName` (`UserName`(32))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `usergroup`
--

LOCK TABLES `usergroup` WRITE;
/*!40000 ALTER TABLE `usergroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `usergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ispsafe'
--
DELIMITER ;;
DELIMITER ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-11-12 10:33:21
