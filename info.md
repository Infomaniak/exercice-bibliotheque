## Informations principales

- Contexte :
    - Application développée dans le cadre d'un [exercice](https://github.com/Infomaniak/exercice-bibliotheque) proposé par Infomaniak pour une offre d'emploi.

- Technologies :
    - Frontend : 
        - Angular 7
        - Bootstrap
        - Material
    - Backend : 
        - PHP 7
    - Base de Données :
        - MySQL



## Accéder au site en ligne
- Une version live est disponible sur <https://maximetassy.fr>.

## Utilisation de l'application
### Fonctionnalitées de l'application
- Possibilité de créer un compte en cliquant sur `S'inscrire`.
- Possibilité de se connecter sur la page de connexion.
- La liste des livres est affichée sur la page d'accueil. Si l'utilisateur est connecté en tant qu'admin, il a la possibilité d'ajouter de nouveau livre depuis cette page.
- En cliquant sur le titre d'un livre sur la page d'accueil, l'utilisateur est redirigé vers la page du livre où il peut voir le détail de celui-ci. L'utilisateur peut emprunter le livre s'il est disponible. Si l'utilisateur est connecté en tant qu'admin, il peut modifier ou supprimer le livre ainsi que voir l'utilisateur qui a emprunté le livre (si le livre est emprunté).
- En cliquant sur le bouton `Compte` de la navbar, l'utilisateur est redirigé vers la page de compte qui permet de mettre à jour les informations de son compte.
- En cliquant sur le bouton `Emprunts` de la navbar, l'utilisateur est redirigé vers la page borrow qui lui affiche la liste des livres qu'il a en sa possession. L'utilisateur peut alors retourner ses livres en cliquant sur le bouton `Rendre livre`.

### Comptes prédéfinis
- Compte utilisateur de test :
    - username : user / password : userpwd
    - username : test / password : testpwd
- Compte admin de test :
    - username : admin / password : adminpwd

## Architecture du code
- Le modèle de la base de données est disponible à la racine dans le fichier BDD.sql
- Les fichiers du Backend sont disponibles dans /src/api.
    - api/books :
        - Fonctions pour gérer les livres.
    - api/users :
        - Fonctions pour gérer les utilisateurs.
    - api/config :
        - Fichiers de configuration de la base de données.
    - api/objects :
        - Classes pour gérer les livres et les utilisateurs.
    - api/shared :
        - Fonctions utilitaires pour le backend.
- Les fichiers du Frontend sont tous les autres fichiers dans /src et /src/app.
    - Utilisation du scss pour le css de l'application.
    - 10 components :
        - account : classe pour la page compte.
        - alert : classe pour l'affichage des alertes (pour le service alert).
        - book : classe pour la page livre.
        - book-dialog : classe pour la gestion de boite de dialogue de création / modification de livre.
        - borrow : classe pour la page borrow.
        - confirm-dialog : classe pour la gestion de boite de dialogue pour confirmer une action (suppression, emprunt ou retour de livre).
        - home : classe pour la page principale de l'application.
        - login : classe pour la page de connexion.
        - nav : classe pour la navbar du site.
        - register : classe pour la page d'enregistrement.
    - 4 services :
        - alert : service pour les alertes de l'application.
        - auth : service d'authentification utilisateur.
        - data : service pour la gestion des données des livres.
        - user : service pour la création / modification d'utilisateur.
    - auth.guard : Guard pour empêcher l'accès à l'application sans connexion.
    - 2 interceptors :
        - error : intercepte les erreurs 401 qui représentent une erreur sur l'identification de l'utilisateur envoyé par l'api. Cela provoque la deconnexion de l'utilisateur courant.
        - jwt : ajoute le token de l'utilisateur courant dans les requêtes http envoyées à l'api.

## Choix de conception
- Application très simple pour montrer mes compétences donc la gestion de la sécurité de l'application est très basique, de même pour les interactions utilisateurs.
- A l'origine, le backend était développé en NodeJS mais l'hebergeur ne supportant pas encore NodeJS pour ses hebergement web, il a donc été refait en PHP.
- Suite à un manque de temps dû à une periode de projets / partiels, l'application a été développée sur 4/5 jours, il peut donc y avoir des bugs et le code n'est pas homogène (commentaire et code en français / anglais, inconsistance dans le nommage des variables, etc.).