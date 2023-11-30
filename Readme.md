## Description du Projet :

Notre projet consiste à créer une plateforme de distribution d'applications développées par HighFive University, avec un accent particulier sur la formation des utilisateurs. Sur cette plateforme, les utilisateurs auront accès à un catalogue d'applications, chaque application étant accompagnée d'une description détaillée, d'une vidéo de démonstration et d'informations sur les prix des licences.

Le service client sera chargé de gérer l'octroi des licences et de fournir aux utilisateurs les formations nécessaires en fonction de leurs besoins. Une fois les licences obtenues, les utilisateurs disposeront d'un espace administratif où ils pourront accéder aux applications et aux formations qui leur ont été attribuées.

Les employés des entreprises auront la possibilité de créer des comptes liés à leur entreprise, ce qui leur permettra de suivre des formations approfondies sur les applications. Ils pourront également surveiller leur progression tout au long de ces formations grâce à des indicateurs de progression.

L'interface de la plateforme sera conviviale et intuitive pour faciliter la navigation entre le catalogue d'applications, les formations disponibles et le suivi de la progression. Des mesures de sécurité strictes seront mises en place pour protéger les données et les transactions, et les utilisateurs auront la possibilité de noter et de commenter les applications et les formations.

Ce projet répond à la demande croissante de formation sur les applications développées par HighFive University, offrant ainsi une solution complète pour les entreprises et leurs employés, tout en favorisant l'exploration et l'apprentissage pour les utilisateurs individuels.



## Voici une structure de base détaillée pour l'application de e-learning sur les applications  développées.

## I. Page d'Accueil
- Présentation de l'application
- Possibilité de recherche d'applications
- Mise en avant des applications populaires ou nouvelles
- Connexion

## II. Catalogue d'Applications
- Liste des applications disponibles
- Tri par catégorie ou fonctionnalité
- Affichage des informations clés de chaque application (nom, description brève, prix)
- Possibilité de voir plus de détails

## III. Page de Détail de l'Application
- Description détaillée de l'application
- Vidéo de démonstration
- Prix et options de licence
- Bouton d'achat ou de demande de licence
- Commentaires et évaluations des utilisateurs

## IV. Service Client
- Contactez le service client
- Demande de formation ou d'informations sur les licences
- FAQ (Foire Aux Questions)

## V. Espace Admin
- Connexion à l'espace admin
- Vue d'ensemble des applications et des formations attribuées
- Gestion des licences et des utilisateurs
- Suivi de la progression des employés

## VI. Formation des Employés
- Liste des formations disponibles
- Description détaillée de chaque formation
- Possibilité de s'inscrire à une formation
- Suivi de la progression de la formation
- Certification à la fin de la formation

## VII. Tableau de Bord de l'Utilisateur
- Vue d'ensemble des licences et des formations attribuées
- Suivi de la progression
- Notifications et messages

## VIII. Système de Notation et de Commentaires
- Possibilité pour les utilisateurs de noter et de commenter les applications et les formations
- Affichage des avis et des évaluations

## IX. Sécurité
- Mécanismes de sécurité pour les données personnelles et les transactions
- Authentification sécurisée des utilisateurs

## X. Paramètres de Compte
- Gestion du profil utilisateur
- Paramètres de confidentialité et de sécurité
- Notifications et préférences

## XI. À Propos de l'Application
- Informations sur l'entreprise HighFive University
- Politique de confidentialité
- Conditions d'utilisation

## XII. Déconnexion
Option pour se déconnecter de l'application


## Structure provisoire de la base de donnée.

## Table "Entreprises" :

- ID : Identifiant unique de l'entreprise (clé primaire)
- Nom : Nom de l'entreprise
- Email : Adresse e-mail de l'entreprise
- MotDePasse : Mot de passe de l'entreprise (peut être stocké de manière sécurisée en utilisant une fonction de hachage)
- Adresse : Adresse de l'entreprise
- Telephone : Numéro de téléphone de l'entreprise

## Table "Utilisateurs" :

- ID : Identifiant unique de l'utilisateur (clé primaire)
- ID_Entreprise : Identifiant de l'entreprise associée (clé étrangère faisant référence à la table "Entreprises")
- Nom : Nom de l'utilisateur
- Email : Adresse e-mail de l'utilisateur
- MotDePasse : Mot de passe de l'utilisateur (peut être stocké de manière sécurisée en utilisant une fonction de hachage)

## Table "Applications" :

- ID : Identifiant unique de l'application (clé primaire)
- Nom : Nom de l'application
- Description : Description courte de l'application
- CaptureEcran : Chemin vers les captures d'écran de l'application (peut être stocké sous forme de lien ou de chemin relatif)
- VideoDemo : Chemin vers la vidéo de démonstration de l'application (peut être stocké sous forme de lien ou de chemin relatif)

## Table "Formations" :

- ID : Identifiant unique de la formation (clé primaire)
- ID_Application : Identifiant de l'application associée (clé étrangère faisant référence à la table "Applications")
- Titre : Titre de la formation
- Description : Description de la formation

## Table "Module" :

- ID : Identifiant unique de la vidéo de formation (clé primaire)
- ID_Formation : Identifiant de la formation associée (clé étrangère faisant référence à la table "Formations")
- Titre : Titre de la vidéo
- URL : URL de la vidéo (peut être stocké sous forme de lien ou de chemin relatif)
- Duree : Durée de la vidéo (peut être enregistrée en secondes ou en format HH:MM:SS)


## Table "VideosFormation" :

- ID : Identifiant unique de la vidéo de formation (clé primaire)
- ID_Formation : Identifiant de la formation associée (clé étrangère faisant référence à la table "Formations")
- Titre : Titre de la vidéo
- URL : URL de la vidéo (peut être stocké sous forme de lien ou de chemin relatif)
- Duree : Durée de la vidéo (peut être enregistrée en secondes ou en format HH:MM:SS)

## Table "Licences" :

- ID : Identifiant unique de la licence (clé primaire)
- ID_Application : Identifiant de l'application associée (clé étrangère faisant référence à la table "Applications")
- ID_Entreprise : Identifiant de l'entreprise associée (clé étrangère faisant référence à la table "Entreprises")
- DateAchat : Date d'achat de la licence
- DateExpiration : Date d'expiration de la licence (si applicable)

## Table "ProgressionUtilisateur" :

- ID_Utilisateur : Identifiant de l'utilisateur associé (clé étrangère faisant référence à la table "Utilisateurs")
- ID_VideoFormation : Identifiant de la vidéo de formation associée (clé étrangère faisant référence à la table "VideosFormation")
- Progression : Indicateur de progression de l'utilisateur dans la vidéo de formation (peut être un pourcentage ou un indicateur binaire de complétion)

## Table "AvisUtilisateur" :

- ID_Utilisateur : Identifiant de l'utilisateur associé (clé étrangère faisant référence à la table "Utilisateurs")
- ID_Application : Identifiant de l'application associée (clé étrangère faisant référence à la table "Applications")
- Commentaire : Commentaire laissé par l'utilisateur sur l'application


