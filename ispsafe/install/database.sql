CREATE DATABASE ispsafe;

USE ispsafe;


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



CREATE TABLE `radcheck` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `UserName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '==',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `UserName` (`UserName`(32))
) ENGINE=MyISAM AUTO_INCREMENT=6429 DEFAULT CHARSET=latin1;

CREATE TABLE `radgroupcheck` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `GroupName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '==',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `GroupName` (`GroupName`(32))
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


CREATE TABLE `radgroupreply` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `GroupName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '=',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `GroupName` (`GroupName`(32))
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

CREATE TABLE `radpostauth` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL default '',
  `reply` varchar(32) NOT NULL default '',
  `authdate` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7598454 DEFAULT CHARSET=latin1;

CREATE TABLE `radreply` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `UserName` varchar(64) NOT NULL default '',
  `Attribute` varchar(32) NOT NULL default '',
  `op` char(2) NOT NULL default '=',
  `Value` varchar(253) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `UserName` (`UserName`(32))
) ENGINE=MyISAM AUTO_INCREMENT=4060 DEFAULT CHARSET=latin1;

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

CREATE TABLE `tbl_ap` (
  `id` int(11) NOT NULL auto_increment,
  `estacao` varchar(50) NOT NULL,
  `accesspoint` varchar(50) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `snmp` varchar(50) NOT NULL,
  `pop` varchar(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1 COMMENT='Tabela de Acess Points';

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

CREATE TABLE `tbl_banda` (
  `band_id` int(3) NOT NULL auto_increment,
  `band_plano` varchar(20) NOT NULL,
  `band_configuracao` varchar(50) NOT NULL,
  `band_observacoes` blob NOT NULL,
  PRIMARY KEY  (`band_id`),
  UNIQUE KEY `band_plano` (`band_plano`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_bloqueio` (
  `id` int(11) NOT NULL auto_increment,
  `dataBloqueio` date NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `motivo` enum('ADMINISTRATIVO','FINANCEIRO','CANCELAMENTO') NOT NULL,
  `status` enum('AGUARDANDO','RETIRADO','AGENDADO','RETIRAR') NOT NULL default 'AGUARDANDO',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=837 DEFAULT CHARSET=latin1 COMMENT='Registro de Bloqueios de Clientes';

CREATE TABLE `tbl_derruba` (
  `login` varchar(50) NOT NULL,
  PRIMARY KEY  (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_modificacoes` (
  `id` int(10) NOT NULL auto_increment,
  `data` datetime NOT NULL,
  `usuarioSistema` varchar(20) NOT NULL,
  `loginCliente` varchar(20) NOT NULL,
  `antes` longtext NOT NULL,
  `depois` longtext NOT NULL,
  `concluido` enum('S','N') NOT NULL default 'N',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5599 DEFAULT CHARSET=latin1 COMMENT='Tabela com hist√¬≥rico de modifica√¬ß√¬µes dos Clientes';

CREATE TABLE `tbl_paginas` (
  `id` int(3) NOT NULL auto_increment,
  `pagina` varchar(50) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `pagina` (`pagina`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_permissao` (
  `id` int(5) NOT NULL auto_increment,
  `usuario` int(5) NOT NULL,
  `pop` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COMMENT='Tabela de Permiss√µes de usu√°rios para visualizarem clientes';

CREATE TABLE `tbl_pop` (
  `id` int(3) NOT NULL auto_increment,
  `dominio` varchar(30) NOT NULL,
  `pop` varchar(30) NOT NULL,
  `ip` varchar(15) default NULL,
  `snmp` varchar(25) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `dominio` (`dominio`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_sinal` (
  `id` int(10) NOT NULL auto_increment,
  `cliente` int(5) NOT NULL,
  `data` datetime NOT NULL,
  `sinal` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cliente` (`cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=31445593 DEFAULT CHARSET=latin1 COMMENT='Tabela de monitoramento de sinal dos clientes';

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

INSERT INTO `tbl_usuario` VALUES (42,'ispsafe','ispsafe','Usuario Administrativo ISP Safe',1,'0.0.0.0/0','full','ATIVO');

CREATE TABLE `usergroup` (
  `UserName` varchar(64) NOT NULL default '',
  `GroupName` varchar(64) NOT NULL default '',
  `priority` int(11) NOT NULL default '1',
  KEY `UserName` (`UserName`(32))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `bloqueia`( login CHAR(30))
BEGIN
UPDATE ispsafe.tbl_TecClientes SET status = 'BLOQUEADO' WHERE usuario = login ;
DELETE FROM ispsafe.usergroup WHERE UserName = login ;
DELETE FROM ispsafe.radreply WHERE UserName = login;
DELETE FROM ispsafe.radcheck WHERE UserName = login;
END */;;
DELIMITER ;


DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `libera`( login CHAR(30))
BEGIN
INSERT INTO ispsafe.usergroup ( UserName, GroupName, priority ) VALUES ( login, 'mdbrasil', '1' );
INSERT INTO ispsafe.radreply ( UserName , Attribute , op , Value ) VALUES ( login, 'Framed-IP-Address', '=', '1' );
INSERT INTO ispsafe.radreply ( UserName , Attribute , op , Value ) VALUES ( login, 'Mikrotik-Rate-Limit', '=', '1' );
INSERT INTO ispsafe.radcheck ( UserName , Attribute , op , Value ) VALUES ( login, 'Password', '==', '1' );
INSERT INTO ispsafe.radcheck ( UserName , Attribute , op , Value ) VALUES ( login, 'Mikrotik-Realm', '==', '1');
INSERT INTO ispsafe.radcheck ( UserName , Attribute , op , Value ) VALUES ( login, 'Called-Station-Id', '==', '1' );
INSERT INTO ispsafe.radcheck ( UserName , Attribute , op , Value ) VALUES ( login, 'Calling-Station-Id', '==', '1');
UPDATE tbl_TecClientes SET status = 'ATIVO' WHERE usuario = login ;
END */;;
DELIMITER ;

DELIMITER ;;

CREATE  TRIGGER insere_cliente AFTER INSERT ON tbl_TecClientes
FOR EACH ROW BEGIN
INSERT INTO usergroup ( UserName, GroupName, priority ) VALUES ( NEW.usuario, 'mdbrasil', '1' );
INSERT INTO radreply ( UserName , Attribute , op , Value ) VALUES ( NEW.usuario, 'Framed-IP-Address', '=', NEW.ip );
INSERT INTO radreply ( UserName , Attribute , op , Value ) VALUES ( NEW.usuario, 'Framed-IP-Netmask', '=', NEW.mascara );
INSERT INTO radreply ( UserName , Attribute , op , Value ) VALUES ( NEW.usuario, 'Mikrotik-Rate-Limit', '=', NEW.banda );
INSERT INTO radcheck ( UserName , Attribute , op , Value ) VALUES (NEW.usuario , 'Password', '==', NEW.senha );
INSERT INTO radcheck ( UserName , Attribute , op , Value ) VALUES (NEW.usuario , 'Mikrotik-Realm', '==', NEW.dominio);
INSERT INTO radcheck ( UserName , Attribute , op , Value ) VALUES (NEW.usuario , 'Called-Station-Id', '==', NEW.pop );
INSERT INTO radcheck ( UserName , Attribute , op , Value ) VALUES (NEW.usuario , 'Calling-Station-Id', '==', NEW.mac);
INSERT INTO usergroup ( UserName, GroupName, priority ) VALUES ( NEW.mac, 'mdbrasil-mac', '1' );
INSERT INTO radcheck ( UserName , Attribute , op , Value ) VALUES (NEW.mac , 'Password', '==', NEW.mac );
INSERT INTO radreply ( UserName , Attribute , op , Value ) VALUES ( NEW.mac, 'Mikrotik-Wireless-Psk', '=', NEW.wpaPsk );
END

;;

CREATE TRIGGER atualiza_cliente AFTER UPDATE ON tbl_TecClientes
FOR EACH ROW BEGIN
UPDATE usergroup SET UserName = NEW.usuario WHERE UserName = OLD.usuario;
UPDATE radreply SET UserName = NEW.usuario, Value = NEW.ip WHERE  Attribute = 'Framed-IP-Address' AND UserName = OLD.usuario;
UPDATE radreply SET UserName = NEW.usuario, Value = NEW.mascara WHERE  Attribute = 'Framed-IP-Netmask' AND UserName = OLD.usuario;
UPDATE radreply  SET UserName = NEW.usuario, Value = NEW.banda WHERE Attribute = 'Mikrotik-Rate-Limit' AND UserName = OLD.usuario;
UPDATE radcheck SET UserName = NEW.usuario, Value = NEW.senha WHERE Attribute = 'Password' AND UserName = OLD.usuario;
UPDATE radcheck SET UserName = NEW.usuario, Value = NEW.dominio WHERE Attribute = 'Mikrotik-Realm' AND UserName = OLD.usuario;
UPDATE radcheck SET UserName = NEW.usuario, Value = NEW.pop WHERE Attribute = 'Called-Station-Id' AND UserName = OLD.usuario;
UPDATE radcheck SET UserName = NEW.usuario, Value = NEW.mac WHERE Attribute = 'Calling-Station-Id' AND UserName = OLD.usuario;
UPDATE usergroup SET UserName = NEW.mac WHERE UserName = OLD.mac;
UPDATE radcheck SET UserName = NEW.mac, Value  = NEW.mac WHERE UserName = OLD.mac;
UPDATE radreply SET UserName = NEW.mac,  Value  = NEW.wpaPsk WHERE UserName = OLD.mac;
END

;;

CREATE TRIGGER deleta_cliente AFTER DELETE ON tbl_TecClientes
FOR EACH ROW BEGIN
DELETE FROM usergroup WHERE UserName = OLD.usuario;
DELETE FROM radreply WHERE UserName = OLD.usuario;
DELETE FROM radcheck WHERE UserName = OLD.usuario;
DELETE FROM usergroup WHERE UserName = OLD.mac;
DELETE FROM radreply WHERE UserName = OLD.mac;
DELETE FROM radcheck WHERE UserName = OLD.mac;
END

;;

CREATE TRIGGER insere_funcionario AFTER INSERT ON tbl_usuario
FOR EACH ROW BEGIN
INSERT INTO usergroup ( UserName, GroupName, priority ) VALUES ( NEW.login, 'funcionario', '1' );
INSERT INTO radcheck ( UserName , Attribute , op , Value ) VALUES (NEW.login , 'Password', '==', NEW.senha );
INSERT INTO radreply ( UserName , Attribute , op , Value ) VALUES ( NEW.login, 'Mikrotik-Group', '=', NEW.grupo );
END

;;

CREATE TRIGGER altera_funcionario AFTER UPDATE ON tbl_usuario
FOR EACH ROW BEGIN
UPDATE usergroup SET UserName = NEW.login WHERE UserName = OLD.login;
UPDATE radcheck SET UserName = NEW.login ,   Value =  NEW.senha WHERE UserName = OLD.login AND Attribute = 'Password';
UPDATE radreply SET UserName = NEW.login , Value =  NEW.grupo WHERE UserName = OLD.login AND Attribute = 'Mikrotik-Group';
END

;;

CREATE TRIGGER deleta_funcionario AFTER DELETE ON tbl_usuario
FOR EACH ROW BEGIN
DELETE FROM usergroup  WHERE UserName = OLD.login;
DELETE FROM  radcheck  WHERE UserName = OLD.login;
DELETE FROM  radreply WHERE UserName = OLD.login;
END

;;

DELIMITER ;


CREATE USER 'ispsafe'@'localhost' IDENTIFIED BY 'ispsafe';
GRANT USAGE ON *.* TO 'ispsafe'@'localhost' IDENTIFIED BY 'ispsafe' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;
GRANT ALL PRIVILEGES ON `ispsafe` . * TO 'ispsafe'@'localhost' WITH GRANT OPTION ;
FLUSH PRIVILEGES;


