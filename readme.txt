// 24/04 //

## Hugo ##

Je viens de post le "index.php" qui sera la page principale, version modulable avec :
	- dans "/inc/connection/" ce qu'il faut pour ce qui est de la co a la BDD, et la co d'un client/photographe/admin.
	- dans "/inc/HTMLInserts/" le header qu'il faudra ins�rer avant chaque balise <body> + le footer pareil apr�s le <body> (qui est pas fait lui, mais c'est que des liens)
C'est pas fini, dans le sens ou y'a pas la ptite image qui va bien en background (image bateauuuu), pas de menu apr�s �tre co non plus
Faut un logo aussi pour le site (on peut juste prendre une police random blanche avec un contour et basta)
Et du css parceque c'est d�gueulasse, updatez /style/style.css

Si vous voulez voir a quoi �a ressemble du javascript, y'en a dans "/inc/js/", m�me si tr�s basique. Y'a aussi la biblioth�que jquery si besoin.
Si quelqu'un d'autre que moi y touche (ce dont je doute), si y'a des modifs de style dynamiques avec du js, bah �a touche pas � la feuille link�e.
A ce moment l�, faut ajouter un attribut " style="monCSS" " � la balise html  et mettre ce qui sera modifi� dedans (et juste �a) + un id/class.
Evitez les doublons avec ce qu'y a sur style.css qu'on s'y retrouve.

H�sitez pas � aller voir dans "/inc/connection/test_connect.php" pour connaitre les $_SESSION et $_COOKIE � utiliser pour le reste des pages, c'est pratique.

// 25/04 //

## Hugo ##

Y'a un logo maintenant, et l'encadr� de connexion prend forme (il reste degueu). Image bateau ins�r�e. Le CSS c'est nul.
Faudra ajouter le <input> pour la recherche, que ce soit dispo sur toutes les pages, et le header sera quasi fini.
Aussi, changer les options dispos dans le menu une fois connect� pour que les clients ils soient pas aussi admins (bien).

## Armand ##

Page de saisie de photo presque op�rationnelle, �a ins�re bien les donn�es dans la base.
Manque la verif de saisie des champs (javascript) et on passe � la suite.

// 16/05 //

## Armand ##

Nouvelle page inscriptionPhotographe liée à ajoutPhotographe :
- Civilité des usagers (clients/photographes) stockée dans la BD?
	Si oui à rajouter dans l'insert,
	Sinon à enlever de la page.

- RIB entreprise stocké dans la BD?
	Si oui à rajouter dans l'insert,
	Sinon à enlever de la page.

/!\ Manque le mdp dans l'insert car base perso pas à jour.
