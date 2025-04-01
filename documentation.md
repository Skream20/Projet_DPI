# Documentation du site web

## Structure du site web

Le site web est organisé en plusieurs fichiers et dossiers, chacun ayant un rôle spécifique dans le fonctionnement global de l'application. Voici une description détaillée de chaque composant :

---

### Fichiers principaux

#### `index.php`
- **Description** : Page principale du site web qui gère la connexion des utilisateurs.
- **Fonctionnalités** :
    - Permet aux utilisateurs de se connecter en saisissant leur nom d'utilisateur et mot de passe.
    - Affiche des outils spécifiques en fonction du rôle de l'utilisateur (admin, comptable, gestionnaire).
    - Gère la session utilisateur et propose une option de déconnexion.
- **Dépendances** :
    - `fonction/db_connect.php` pour la connexion à la base de données.
    - `fonction/logout.php` pour la déconnexion.

#### `Gestion_frais.php`
- **Description** : Page permettant la saisie des frais au forfait.
- **Fonctionnalités** :
    - Permet de saisir les frais de repas, nuitées, étapes et kilomètres.
    - Envoie les données saisies à `fonction/remplir_id.php` pour traitement.
- **Dépendances** :
    - `css/Gestion_frais.css` pour le style.

#### `liste_visit.php`
- **Description** : Page affichant la liste des visiteurs.
- **Fonctionnalités** :
    - Affiche les informations des visiteurs (nom, prénom, date d'embauche).
    - Propose des options pour supprimer ou modifier un visiteur.
- **Dépendances** :
    - `fonction/db_connect.php` pour récupérer les données des visiteurs.
    - `fonction/supprimer_visiteur.php` pour la suppression des visiteurs.

#### `Visiteur.html`
- **Description** : Formulaire pour ajouter un nouveau visiteur.
- **Fonctionnalités** :
    - Permet de saisir les informations personnelles d'un visiteur (nom, prénom, adresse, etc.).
    - Envoie les données saisies à `fonction/formulaire_visiteur.php` pour traitement.
- **Dépendances** :
    - `css/index.css` pour le style.

#### `validation_frais.html`
- **Description** : Page permettant de valider les frais des visiteurs.
- **Fonctionnalités** :
    - Permet de sélectionner un visiteur et de visualiser ses frais au forfait.
    - Propose des options pour valider ou invalider les frais.
- **Dépendances** :
    - `css/traitement_frais.css` pour le style.
    - `fonction/validation_frais.php` pour le traitement des données.

#### `fiche_frais.html`
- **Description** : Page affichant un tableau des frais.
- **Fonctionnalités** :
    - Affiche les frais de repas, nuitées, étapes, kilomètres et leur situation.
- **Dépendances** :
    - `css/Gestion_frais.css` pour le style.

#### `visiteur_edit.php`
- **Description** : Page permettant de modifier les informations d'un visiteur.
- **Fonctionnalités** :
    - Pré-remplit les champs avec les informations actuelles du visiteur.
    - Envoie les modifications à `fonction/visiteur_update.php` pour mise à jour.
- **Dépendances** :
    - `fonction/db_connect.php` pour récupérer les données du visiteur.

---

### Dossiers

#### `css/`
- Contient les fichiers CSS pour le style des différentes pages.
    - `connexion.css` : Style pour la page de connexion.
    - `Gestion_frais.css` : Style pour la page de gestion des frais.
    - `index.css` : Style pour la page d'accueil et le formulaire visiteur.
    - `Liste_visit.css` : Style pour la liste des visiteurs.
    - `traitement_frais.css` : Style pour la validation des frais.

#### `fonction/`
- Contient les fichiers PHP pour les fonctionnalités backend.
    - `db_connect.php` : Gère la connexion à la base de données.
    - `formulaire_visiteur.php` : Traite les données du formulaire visiteur et les insère dans la base de données.
    - `logout.php` : Gère la déconnexion des utilisateurs.
    - `remplir_id.php` : Insère les frais au forfait dans la base de données.
    - `supprimer_visiteur.php` : Supprime un visiteur de la base de données.
    - `traitement_fraie.php` : Calcule et insère les frais dans la base de données.
    - `validation_frais.php` : Valide ou invalide les frais des visiteurs.
    - `visiteur_update.php` : Met à jour les informations d'un visiteur.

#### `img/`
- Contient les images utilisées sur le site.
    - `gsb.png` : Logo de l'application.

#### `remplirEtudiant/`
- Contient des fichiers liés à la base de données et des données d'exemple.
    - `creBDEtudiant.sql` : Script SQL pour créer la base de données.
    - `garcon.txt` : Liste de prénoms masculins.
    - `generateur.docx` : Document Word (contenu non spécifié).
    - `mesFonctionsGenerales.php` : Fichier PHP (contenu non spécifié).
    - `nom.txt` : Liste de noms (contenu non spécifié).

---

### Fonctionnalités principales

1. **Gestion des utilisateurs** :
     - Connexion et déconnexion.
     - Gestion des rôles (admin, comptable, gestionnaire).

2. **Gestion des visiteurs** :
     - Ajout, modification et suppression des visiteurs.
     - Affichage de la liste des visiteurs.

3. **Gestion des frais** :
     - Saisie des frais au forfait.
     - Validation des frais par visiteur.
     - Affichage des fiches de frais.

4. **Base de données** :
     - Connexion à une base de données MySQL.
     - Tables principales : `visiteur`, `fiche_frais`, `ligne_frais_forfait`, `frais_forfait`, `etat`, `USER`.

---

