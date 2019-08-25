# Library

### Informations générales

Cette application a été réalisée dans le cadre d'un test technique proposé par Infomaniak.

### Technologies

L'application a été développée en HTML/CSS/PHP à l'aide des frameworks Bootstrap et Laravel et fonctionne à l'aide d'une base de données MySQL.

## Accès en ligne

L'application n'est pas encore hébergée en ligne.

## Fonctionnalités

- Un utilisateur non-inscrit peut :
	- Créer un compte (`Connexion`>`S'inscrire`);
	- Voir les livres disponibles ;
	- Rechercher des livres par titre ou nom d'auteur ;
	- Voir un livre en détail (en cliquant sur celui-ci) ;
	- Retourner à l'accueil (en cliquant sur le logo `Library`).

- Un utilisateur inscrit peut :
	- Voir les livres disponibles ;
	- Rechercher des livres par titre ou nom d'auteur ;
	- Voir un livre en détail (en cliquant sur celui-ci) ;
	- Emprunter un livre (`Emprunter` sur la page d'un livre) ;
	- Retourner à l'accueil (en cliquant sur le logo `Library`) ;
	- Voir les livres qu'il a empruntés (`Mes livres` dans le menu) ;
	- Rendre un livre emprunté (`Rendre` sur la page d'un livre emprunté).

- Un libraire peut :
	- Voir les livres disponibles ;
	- Voir tous les livres empruntés ;
	- Voir un livre en détail (en cliquant sur celui-ci) ;
	- Voir l'utilisateur ayant emprunté un livre (sur la page de celui-ci) ;
	- Retourner à l'accueil (en cliquant sur le logo `Library`) ;
	- Ajouter un nouveau livre (`Ajouter un livre` dans le menu) ;
	- Modifier un livre existant (`Modifier` sur la page d'un livre) ;
	- Supprimer un livre (`Supprimer` sur la page d'édition d'un livre).

### Compte prédéfini

Un libraire ne pouvant être créé depuis le site, il faudra utiliser le compte suivant pour se connecter à l'aide d'un compte libraire :
- E-mail : admin@admin.com
- Mot de passe : adminadmin

Pour tout autre utilisateur, il faudra créer un compte à l'aide du bouton `S'inscrire` en bas du formulaire de connexion accessible depuis la barre de navigation via le bouton `Connexion`.

## Conception

- L'application a été développée en 4 jours, incluant l'apprentissage du Framework PHP Laravel pour une meilleure gestion des données ainsi que de l'authentification.

- Toutes les fonctionnalités sont disponibles depuis un ordinateur, une tablette ou un smartphone.

- Pour limiter les temps de chargement, 8 livres sont affichés par page. Le défilement de page est disponible à l'aide des boutons `Précédent` et `Suivant` au bas de la page. 