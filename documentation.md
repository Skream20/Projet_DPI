# Documentation du Projet DPI

## Structure du Projet

Le projet est organisé en plusieurs fichiers et dossiers. Voici une vue d'ensemble de la structure du dossier `web` :

```
adresse.txt
connexion.php
db_connect.php
DPI.db
fiche_frais.html
formulaire_visiteur.php
garcon.txt
Gestion_frais.css
Gestion_frais.html
Gestion_frais.php
gsb.png
index.css
index.html
Liste_visit.css
liste_visit.php
logout.php
mesFonctionsGenerales.php
nom.txt
remplir_id.php
remplirEtudiant.php
script.js
sql_data.txt
supprimer_visiteur.php
traitement_fraie.php
traitement_frais.css
validation_frais.html
validation_frais.php
visiteur_edit.php
visiteur_update.php
Visiteur.html
```

---

## Description des Fichiers

### Fichiers PHP

- **`connexion.php`** : Gère la connexion des utilisateurs. Permet de vérifier les identifiants et de rediriger les utilisateurs en fonction de leur rôle.
- **`db_connect.php`** : Contient la fonction de connexion à la base de données MySQL.
- **`formulaire_visiteur.php`** : Permet d'ajouter un nouveau visiteur dans la base de données.
- **`liste_visit.php`** : Affiche la liste des visiteurs enregistrés et propose des options pour les modifier ou les supprimer.
- **`logout.php`** : Déconnecte l'utilisateur en détruisant la session active.
- **`remplir_id.php`** : Insère des données de frais au forfait dans la base de données.
- **`remplirEtudiant.php`** : Génère des données aléatoires pour remplir la table des visiteurs.
- **`supprimer_visiteur.php`** : Supprime un visiteur de la base de données.
- **`traitement_fraie.php`** : Gère le traitement des frais soumis par les visiteurs.
- **`validation_frais.php`** : Permet de valider ou de refuser les frais soumis par les visiteurs.
- **`visiteur_edit.php`** : Affiche un formulaire pour modifier les informations d'un visiteur.
- **`visiteur_update.php`** : Met à jour les informations d'un visiteur dans la base de données.

### Fichiers HTML

- **`index.html`** : Page d'accueil par défaut du serveur Apache.
- **`Gestion_frais.html`** : Formulaire pour la saisie des frais au forfait.
- **`fiche_frais.html`** : Affiche les détails des frais soumis.
- **`validation_frais.html`** : Formulaire pour valider les frais des visiteurs.
- **`Visiteur.html`** : Formulaire pour ajouter un nouveau visiteur.

### Fichiers CSS

- **`Gestion_frais.css`** : Styles pour la page de gestion des frais.
- **`index.css`** : Styles généraux pour le projet.
- **`Liste_visit.css`** : Styles pour la liste des visiteurs.
- **`traitement_frais.css`** : Styles pour la validation des frais.

### Fichiers de Données

- **`adresse.txt`** : Contient une liste d'adresses utilisées pour générer des données aléatoires.
- **`garcon.txt`** : Contient une liste de prénoms masculins.
- **`nom.txt`** : Contient une liste de noms de famille.
- **`sql_data.txt`** : Script SQL pour créer et remplir les tables de la base de données.

### Autres Fichiers

- **`DPI.db`** : Base de données SQLite utilisée pour le projet.
- **`gsb.png`** : Logo utilisé dans les pages HTML.
- **`script.js`** : Script JavaScript pour gérer l'affichage dynamique des liens en fonction du rôle de l'utilisateur.
- **`mesFonctionsGenerales.php`** : Contient des fonctions utilitaires pour la gestion des erreurs SQL.

---

## Fonctionnalités Principales

1. **Gestion des Visiteurs** :
    - Ajout, modification et suppression des visiteurs.
    - Affichage de la liste des visiteurs.

2. **Gestion des Frais** :
    - Saisie des frais au forfait.
    - Validation ou refus des frais soumis.
    - Calcul automatique des montants.

3. **Authentification** :
    - Connexion des utilisateurs avec des rôles spécifiques (admin, comptable, gestionnaire).
    - Déconnexion sécurisée.

4. **Base de Données** :
    - Tables pour les visiteurs, les frais, et les utilisateurs.
    - Relations entre les tables pour assurer l'intégrité des données.

---

## Instructions d'Installation

1. **Configuration du Serveur** :
    - Installer un serveur Apache avec PHP et MySQL.
    - Configurer le fichier `db_connect.php` avec les informations de connexion à la base de données.

2. **Base de Données** :
    - Importer le fichier `sql_data.txt` dans MySQL pour créer les tables nécessaires.

3. **Démarrage** :
    - Placer les fichiers dans le répertoire racine du serveur web.
    - Accéder à `index.html` pour commencer.

---

## Améliorations Futures

- Ajouter une gestion des erreurs plus robuste.
- Implémenter un système de pagination pour la liste des visiteurs.
- Ajouter des tests unitaires pour les fonctions PHP.
- Améliorer l'interface utilisateur avec des frameworks modernes comme Bootstrap.

---

## Auteurs

- **Donovan** : Création des pages HTML/CSS et intégration des formulaires.
- **Yann** : Développement des fonctionnalités PHP et gestion de la base de données.
- **Antoine** : Configuration des serveurs et documentation technique.

---  