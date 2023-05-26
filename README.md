# PronAutocross

Voici mon premier projet complet réalisé en PHP natif avec une architecture **MVC**.

Débuté le *03-03-2023* et mis en ligne le *31-03-23*.

Au *03-05-2023*, **905** utilisateurs sont inscrits sur le site et plus de ***2400*** participations ont été enregistré après seulement 4 courses.

### Qu'est-ce que c'est ?

***www.pronautocross.fr*** est une site pour parier sur les résultats des championnats et coupes de France d'Autocross et de Sprint Car (Sport Automobile).

### Comment fonctionne le site ?

#### Partie publique

En pages "publiques", sans inscription, on peut avoir accès :
* à la page d'accueil
* aux règles du jeu
* au formulaire d'inscription
* au classement général
* au classement de chaque épreuve

#### Utilisateurs inscrits

Chaque joueur peut s'inscrire et avoir son propre espace personnel.
A l'intérieur de celui-ci, il a accès à :
* ses infos personnelles (pseudo, prénom, nom, adresse mail)
* son classement général
* ses résultats sur chaque épreuve
* ses fiches récap de ses votes sur chaque épreuve
* ses amis et leur classement général

Il peut aussi voter sur chaque épreuve en sélectionnant un pilote par catégorie.

Dans les classements, lorsque le joueur est connecté, la ligne correspondant à son classement apparait automatiquement d'une couleur différente et c'est également le cas pour les lignes des amis qu'il a choisi de suivre.

##### Backoffice

Le backoffice est certainement la partie la plus importante, le ***"coeur"*** du jeu.

A l'intérieur de celui-ci, l'administrateur peut notamment :
* Ajouter/éditer une fiche pilote
* Ajouter/éditer une catégorie
* Ajouter/éditer une course
* Générer une liste des engagés
* Générer un questionnaire
* Générer une vérification
* Mettre à jour les cotes des pilotes
* Visualiser les utilisateurs et le nombre de participations sur chaque épreuve
* Visualiser la répartition des votes et les favoris

### Le fonctionnement des cotes

Chaque pilote a une cote personnelle calculée automatiquement (de 1.01 pour un ultra favori à 14.5 pour un outsider).
Le calcul se base sur le nombre de votes reçus pour ce pilote sur les deux dernières courses et sur sa place actuelle au championnat (s'il est dans le top 10).

### Pourquoi créer ce site ?

Plusieurs raisons principales :
* Pratiquant moi-même ce sport en compétition, cela me permet de lier mes passions et de travailler sur un sujet que je maitrise et affectionne.
* Il permet à tous les utilisateurs de vivre les week-ends de course différement, en défiant leurs amis et en espérant que leurs pronostics soient bons.
* Réaliser ce projet en parallèle de ma formation O'Clock (01/23 => 06/23) est ultra formateur, il me permet de mettre en application dans un cadre réel certains process appris et il me permet surtout d'être confronté à d'autres problématiques et de devoir les résoudre moi-même.
* Faire tester le site à des connaissances et recueillir leurs impressions, s'adapter à leur demande, créer de nouvelles fonctionnalités qu'ils souhaitent est très enrichissant et permet de se plonger dans un exercice semblable à la vraie vie professionnelle.
* Ce fut une première expérience franchement enrichissante que de créer "from scratch" un premier projet complet sans utiliser de framework.
* Même s'il est maintenant en ligne, il reste un formidable "bac à sable" pour tester, améliorer et créer de nouvelles fonctionnalités.





