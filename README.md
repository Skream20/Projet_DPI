# Projet_DPI

## Langages utilisés

- **PHP**
- **HTML / CSS**
- **SQL**

## Objectif

// À indiquer plus tard //

---

## Chronologie du projet

### Jour 1

**Donovan :**

- Création des pages HTML :
  - [Visiteur](https://github.com/Skream20/Projet_DPI/blob/main/page_web/web/Visiteur.html)
  - [Validation de frais](https://github.com/Skream20/Projet_DPI/blob/main/page_web/web/validation_frais.html)
- Création du CSS :
  - [Index CSS](https://github.com/Skream20/Projet_DPI/blob/main/page_web/web/index.css)

**Yann :**

- Liaison des fichiers PHP aux formulaires.
- Création des fichiers de traitement des données :
  - Récupération des données des formulaires et envoi dans la base de données.
  - Traitement des données des formulaires :
    - [Traitement des frais](https://github.com/Skream20/Projet_DPI/blob/main/page_web/web/traitement_fraie.php)
    - [Traitement des visiteurs](https://github.com/Skream20/Projet_DPI/blob/main/page_web/web/formulaire_visiteur.php)

**Antoine :**

- Installation de micro-serveurs sur les postes.
- Flash d'une clé bootable en Legacy avec Windows Server 2022.
- Installation de Windows Server 2022 :
  - Installation des services AD DS, Hyper-V pour les VMs et DNS.
  - Création d'un dossier et d'un document SISR : [Lien vers le document](https://estran.sharepoint.com/:w:/r/sites/DigitalPulseInnovation/_layouts/15/doc2.aspx?action=edit&sourcedoc=%7B40aa7ea0-d7e7-40cf-9547-585a7328d33d%7D&wdOrigin=TEAMS-WEB.teamsSdk.openFilePreview&wdExp=TEAMS-CONTROL&web=1)

---

### Jour 2

**Antoine :**

- Installation des serveurs Front-end et Back-end (Debian).
- Installation des mises à jour.

**Donovan :**

- Création et modification des pages HTML/CSS.

**Yann :**

- Développement en PHP.
- Résolution d'un problème lié à `VIS_ID` dans le code PHP.

---

### Jour 3

**Yann / Donovan :**

- Résolution du problème dans le code PHP :
  - [Formulaire visiteur](https://github.com/Skream20/Projet_DPI/blob/main/page_web/web/formulaire_visiteur.php)
  - [Remplir étudiant](https://github.com/Skream20/Projet_DPI/blob/main/page_web/web/remplirEtudiant.php)

**Antoine :**

- Documentation des installations des OS.
- Installation de MariaDB.
- Création de IIS.

---

### Jour 4

**Yann / Donovan :**

- Début de la programmation de `traitement_fraie.php`.

**Noan :**

- Refonte de la clé étrangère `FFR_ID` pour la table `ligne_frais_forfait`.
- Finalisation de la table `frais_forfait` (données déjà insérées).
- Planification des prochaines étapes :
  - Création de la table `fiche_frais`.
  - Finalisation des pages HTML/CSS pour une meilleure mise en page.
  - Finalisation du PHP pour rediriger les formulaires validés vers une nouvelle page.

---

### Jour 5

**Yann / Donovan :**

- Correction des bugs liés à `FFR_ID` :
  - Création de `remplir_id`.
  - [Continuer la programmation de remplir_id.php](https://github.com/Skream20/Projet_DPI/blob/main/page_web/web/remplir_id.php).
  - [Continuer la programmation de traitement_fraie.php](https://github.com/Skream20/Projet_DPI/blob/main/page_web/web/traitement_fraie.php).

---

### Jour 6

**Donovan :**

- Résolution des problèmes d'encodage UTF-8 dans les fichiers HTML.
- Correction de la clé étrangère `FFR_ID`.
- Mise à jour de la base de données avec une valeur par défaut `1` pour `FFR_ID`.

**Yann :**

- Poursuite du développement PHP pour la gestion des fiches de frais.

**Noan :**

- Création de la page HTML pour les fiches de frais.

---

### Jour 7

**Donovan / Yann :**

- Résolution des problèmes dans `validation_frais.php` :
  - Correction de l'affichage de la liste des utilisateurs.
- Migration des fichiers et de la base de données vers le serveur SISR.
- Finalisation de la partie visiteur.

**Noah :**

- Création de la page HTML pour les fiches de frais.

---

## Dernières modifications

- **Modification du fichier `validation_frais.php`** : Correction de l'affichage de la liste des utilisateurs.
- **Mise à jour de la base de données** : Ajout de la valeur par défaut `1` pour la clé étrangère `FFR_ID`.
- **Correction dans `traitement_fraie.php`** : Résolution de bugs liés à la gestion des frais.
- **Création du fichier `remplir_id.php`** : Ajout de la logique pour gérer les identifiants liés à `FFR_ID`.
- **Migration des fichiers et de la base de données** : Transfert complet vers le serveur SISR.
- **Amélioration de la mise en page HTML/CSS** : Ajustements pour une meilleure présentation des formulaires.
- **Ajout de la documentation** : Mise à jour des étapes d'installation et des configurations des serveurs.
- **Finalisation de la partie visiteur** : Complétion des fonctionnalités liées aux visiteurs.
- **Création du fichier `fiche_frais.html`** : Ajout d'une nouvelle page pour la gestion des fiches de frais.
- **Correction des problèmes d'encodage UTF-8** : Résolution des erreurs d'affichage dans les fichiers HTML.
- **Mise à jour des relations dans la base de données** : Refonte des clés étrangères pour assurer l'intégrité des données.