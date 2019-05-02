# Marc Dubois Library Exercice Infomaniak

Library Exercice Infomaniak!


## Utilisation

Vous pouvez accéder à l'application [ici](https://www.library-exercise.ml/)

Pour utiliser l'application vous serez amener a crée un compte, pour cela il faut utiliser un email valide car un mail de confirmation vous sera envoyez.

Volontairement j'ai ajouté un bouton Bibliothécaires au formulaire, pour que vous puissiez effectuer des tests sens problèmes. Dans la réalité ce bouton ne se trouverait pas ici.

En tant qu'utilisateur, on peut :
* Voir tous les livres
* Emprunter un livre

En tant qu'administrateur, on peut en plus :
* Ajouter un livre
* Supprimer un livre
* Modifier un livre
* Voir les utilisateurs inscrits
* Voir les livres empruntés par chaque utilisateur


## Informations

Durant mon stage de DUT R&T, j'ai réalisé en entreprise, une application de supervision avec ReactJS, j'ai donc réutilisé ces connaissances, en les complétants grâce en autodidacte.

Je me suis donc basé sur cette bibliothèque JS pour réaliser mon application.

Pour la construction de l'application (le build) j'utilise react-script, celui-ci utilise Webpack et babel.



### Front-End

Le rendu du front-end est donc géré entièrement par le frameworks ReactJS. J'ai ensuite ajouté Redux. Cette bibliothèque permet de gérer les états dans toute l'application, je l'utilise par exemple pour le rôle bibliothécaire.

J'ai aussi utilisé differentes autre bibliothèque pour le rendu:
[react-burger-menu](https://github.com/negomi/react-burger-menu) Gère le menu latéral, ainsi que son animation.

[react-router-dom](https://github.com/negomi/react-burger-menu) Permet de gérer les routes de l'application, car c'est une [single page apps](https://fr.wikipedia.org/wiki/Application_web_monopage).


### Back-End

Pour le Back-End, je n'utilise pas de Back-End sur mon propre serveur. Google nous permet aujourd'hui de gérer les comptes ainsi qu'une base de données en temps réel. Cette bibliothèque se nomme [Firebase](https://firebase.google.com/). Firebase comporte beaucoup d'avantages: la notion de temps réel, cela permet de notifier à mon application s'il y a un changement dans ma Base de données. Pour actualiser mon application en temps réel, sans avoir besoin de réactualiser la page. Je peux utiliser cette bibliothèque directement dans mon Front-End avec ReactJS.
 
