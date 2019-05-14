// 24/04 //

## Hugo ##

Je viens de post le "index.php" qui sera la page principale, version modulable avec :
	- dans "/inc/connection/" ce qu'il faut pour ce qui est de la co a la BDD, et la co d'un client/photographe/admin.
	- dans "/inc/HTMLInserts/" le header qu'il faudra insérer avant chaque balise <body> + le footer pareil après le <body> (qui est pas fait lui, mais c'est que des liens)
C'est pas fini, dans le sens ou y'a pas la ptite image qui va bien en background (image bateauuuu), pas de menu après être co non plus
Faut un logo aussi pour le site (on peut juste prendre une police random blanche avec un contour et basta)
Et du css parceque c'est dégueulasse, updatez /style/style.css

Si vous voulez voir a quoi ça ressemble du javascript, y'en a dans "/inc/js/", même si très basique. Y'a aussi la bibliothèque jquery si besoin.
Si quelqu'un d'autre que moi y touche (ce dont je doute), si y'a des modifs de style dynamiques avec du js, bah ça touche pas à la feuille linkée.
A ce moment là, faut ajouter un attribut " style="monCSS" " à la balise html  et mettre ce qui sera modifié dedans (et juste ça) + un id/class.
Evitez les doublons avec ce qu'y a sur style.css qu'on s'y retrouve.

Hésitez pas à aller voir dans "/inc/connection/test_connect.php" pour connaitre les $_SESSION et $_COOKIE à utiliser pour le reste des pages, c'est pratique.

// 25/04 //

## Hugo ##

Y'a un logo maintenant, et l'encadré de connexion prend forme (il reste degueu). Image bateau insérée. Le CSS c'est nul.
Faudra ajouter le <input> pour la recherche, que ce soit dispo sur toutes les pages, et le header sera quasi fini.
Aussi, changer les options dispos dans le menu une fois connecté pour que les clients ils soient pas aussi admins (bien).

## Armand ##

Page de saisie de photo presque opérationnelle, ça insère bien les données dans la base.
Manque la verif de saisie des champs (javascript) et on passe à la suite.

