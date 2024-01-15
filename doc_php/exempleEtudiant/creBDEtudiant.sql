-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 12 Novembre 2019 à 18:51
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  'BDETUDIANT'
--
CREATE DATABASE IF NOT EXISTS BDETUDIANT
DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE BDETUDIANT;

-- --------------------------------------------------------

--
-- Structure de la table 'etudiant'
--

CREATE TABLE IF NOT EXISTS etudiant (
  id int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(60) NOT NULL,
  prenom varchar(60) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
