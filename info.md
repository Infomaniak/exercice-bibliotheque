# INTRODUCTION #

Le but de cet exercice est de réaliser une bibliothèque virtuelle.
Dans cette partie vous aurez simplement l'aspect technique de mon projet.

**[Voir] compte_rendue.pdf** 
>Pour la partie explicative de ce projet, et les informations de connexion, comme:
> * Connexion en tant qu’administrateur
> * Connexion en tant que Libraire > car je vous ai crée un compte spécial *infomaniak* avec un 				droit d'un bibliothécaire, ce pendant vous pouvez le modifier pour le mettre en simple utilisateur, 		en vous connectant dans le tableau de bord en tant qu'administrateur.

## Candidat ##

>BOINAIDI Abdourahamane
>Master1 INFORMATIQUE à l'université Savoie Mont Blanc
>Dans le cadre d'un stage scolaire qui débutera en mi-mai je postule pour le post développeur backend/frontend
>Après une réponse de votre part, je vous envoie le travaille attendu.

## Objectifs ##

-  #### Accès visiteur ####
    Un visiteur peut consulter les livres, et ainsi voir tous les avis qui ont été attribués à chacun d'entre eux.

-   <h4> Accès utilisateur </h4>
    
	 Un formulaire d’inscription disponible permettra aux utilisateur de s’inscrire au site. Cette inscription nécessite une confirmation par email et une fois effectuée, cet utilisateur pourra s’authentifier pour effectuer les actions suivantes:

	-   Emprunter un livre
	(Seuls les livres disponibles en quantité seront empruntables).
	-   Rendre un livre
	-   Laisser un avis et noter un livre
	-   Se connecter/se déconnecter
	-   Accès bibliothécaire
  
- <h4>Accès  bibliothécaire</h4>
	On aura accès aux fonctionnalités suivantes:
	
	-	 Avoir un suivi des tous les livres emprunté et rendus
	-   Ajouter des nouveaux livres
	-   Ajouter des catégories
	-   Ajouter des auteurs
-   <h4>Accès administrateur</h4>
	En tant qu’administrateur, on héritera de toutes les fonctionnalités d’un bibliothécaire en plus de la fonctionnalité suivante:

	 Gérer tous les utilisateurs inscrits: 
		- Attribution de rôles, 
		- Vous aurez aussi comment 

## Choix technologique ##
Pour la réalisation de ce projet, je me suis plutôt penché sur **Laravel**, une technologie que vous utilisez au sein de votre entreprise.

# INSTALLATION #

### Pré-requis ###
* Il faut avoir composer installer
* Avoir PHP version 7 ou +
* NodeJS v10 ou plus

### Instructions ###
Depuis la racine de ce projet, ouvrez le terminale, et écrivez les commandes ci-dessous:
```
composer install
```
>Installe tous les dépendances de Laravel.

<br/>

```
npm install
```
>Installe tous les dépendances de node.
>pour l'installation de semantic ui, vous aurez ces questions:
> * It looks like you have a semantic.json file already :  Faire **CTRL + C** pour l'échapper 

# CONFIGURATION #

* Pour faire marcher l'application, il faut créer une base de donnée **MySql**, avec le nom de **bibliorga**.
* Ouvrir le fichier .env, pour mettre à jour les informations suivantes:
	* MySQL: il faut ajouter le nom d'utilisateur et le mot de passe
	* Email: Compléter cette partie, car le système envoie un email de confirmation à chaque nouveau utilisateur inscrit, celui-ci est obligé de confirmé son compte s'il veut pouvoir faire des emprunts. Le système notifie l'utilisateur à chaque emprunt pour que celui-ci soit au courant de tous ces gestes dans l'application, dans le cas où une autre personne que lui l'aurait fait.
* Une fois que c'est fait il faut juste lancer le serveur

```
php artisan serve
```
> Options:
>  * \-\-host : pour spécifier un host, par exemple : 80.211.56.41
>  * \-\-port : pour spécifier un port, par défaut c'est le port 8000


# STRUCTURE DU PROJET #

Tous les images sont stockées dans le dossier public/images
> Dans ce dossier vous aurez les dossiers pour chaque type d'images:
> * Les images des livres sont stockés dans le dossier books
> * Les photos des auteurs dans authors
> * Les images de profil des utilisateurs 
> 
>Et vous aurez aussi tous les images utilisées dans ce projet
Pour les autres fichiers, sa reste la même structure que celui de Laravel, par défaut.