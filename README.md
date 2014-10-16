Staque.fr | Brief
Contexte
Stackoverflow déchire dans le monde, et pourtant, toujours pas de version française à l’horizon. À nous de jouer alors, si on nous laisse le champs libre...
Objectif
Recréer, en version light et francophone, Stackoverflow. 
Public cible
Les geeks / développeurs fracophones.
Moyens
Équipe de 2 ou 3, ou seul pour les Rambo.
5-6 jours.
0€ de rémunération. Eau fournie.
Technique
Apache / PHP / MySQL / JavaScript / HTML5 / CSS3 évidemment. 
On utilise Git. Même seul. GitHub ou Bitbucket pour les repos. 




Concept
Utilisateurs connectés
Le site permet aux utilisateurs connectés de : 
Poser des questions de développement
Répondre aux questions
Commenter les questions
Commenter les réponses
Voter pour les meilleures réponses
Utilisateurs non-connectés
Les utilisateurs non-connectés peuvent uniquement consulter les questions et les réponses. 
Poser une question
L’utilisateur doit lui indiquer un titre clair et un contenu (peut être long, et contenir du code). 
Il lui attibue des tags (minimum 1, maximum 5) du genre PHP, jQuery, Wordpress, etc… au moment de sa création. Une autocomplétion en ajax permet d’éviter les doublons de tags. 

Il est également responsable de choisir LA bonne réponse, celle qui a réglé son problème.
Voir les questions
Tous les utilisateurs peuvent consulter la liste des dernières questions, paginées, de la plus récente à la plus ancienne.
En cliquant sur une question, on est amené à la page de détails de celle-ci.
Il doit être possible de n’afficher que les questions correspondants à un tag. 
Voir une question en détail
Sur la page de détail de la question, s’affiche son titre, ses tags, son contenu, son auteur, le score de l’auteur et les réponses. 

Au bas de la page, un formulaire permet à l’utilisateur connecté d’ajouter une réponse.

Auprès de chaque réponse se trouve 2 boutons, permettant de voter pour la réponse, ou contre elle. Ces boutons fonctionnent en AJAX.
Sous chaque réponse se trouve la liste des commentaires, et un petit formulaire permettant d’en ajouter un nouveau. Il fonctionne en AJAX.


Accueil
Présentation brève du site.
Invitation claire à s’inscrire.
Invitation discrète à se connecter.
Les 3 dernières questions.
Profil public
Partout où est écrit le pseudo d’un utilisateur, celui-ci doit être cliquable et mener vers son profil. Sur celui-ci, s’affiche toutes les infos publiques disponibles sur l’utilisateur, notamment son score, et l’historique récent de celui-ci
Éditer son profil
L’utilisateur doit avoir accès à un formulaire permettant de modifier son profil, qui contient les infos classiques : 
Nom réel
Pseudo
Email (non visible)
Pays
Langues
Métier
Photo ou image de profil
Liens externes
etc. 
Score
Un score est attribué à chaque utilisateur. Il commence à 5 à l’inscription. 
Voici comment celui-ci est modifié : 
+2 points : poser une question
+4 points : répondre à une question
+20 points : être choisi comme la meilleure réponse
+5 points : avoir une réponse votée favorablement
-5 points : avoir une réponse votée défavorablement
-1 point : voter défavorablement une réponse
Le score d’un utilisateur lui procure des droits :
À suivre...


