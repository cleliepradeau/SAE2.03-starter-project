Itération 5 : 

Dans l'itération 5 on nous demande de gérer les utilisateurs, pour ce faire j'ai rajouté une table Profile.

Dans cette table j'ai mis les attributs suivants :
- id : une clé unique en mode auto-incretement de type INT
- nom : de type VARCHAR(150) qui stocke le nom des profiles, j'ai mis 150 pour que les personnes avec un nom composé puissent l'écrire en entier s'ils le souhaitent
- image : de type VARCHAR(250) qui stocke le nom du fichier des images, j'ai mis 250 pour avoir la place de mettre des noms longs s'il y en a.
- date_naissance : de type DATE qui stocke la date de naissance des utilisateurs, j'ai préféré stocker la date de naissance des utilisateurs que leur age car je trouvais cela plus simple.


Itération 9 : 

Dans l'itération 9 on nous demande de pouvoir ajouter des films à une liste de favoris par profil utilisateur, pour ce faire j'ai donc rajouté une table Favoris.

Dans cette table j'ai mis les attributs suivants :
- id : une clé unique en mode auto-incretement de type INT
- id_movie : une clé secondaire de type INT qui permet de retrouver l'id du film ajouté en favoris.
- id-profile :  une clé secondaire de type INT qui permet de retouver l'id de l'utilisateur qui a ajouté le film en favoris.


Itération 11 : 

Dans l'itération 11 on nous demande d'avoir des films mis en avant, pour ce faire j'ai rajouté un attribut dans la table Movie déjà existante.

J'ai ajouté l'attribut miseenavant de type tinyint(1) qui est une valeur booléenne donc les films dans l'attribut miseenavant ont soit la valeur 0 ce qui veut dire qu'ils ne sont pas mis en avant, soit la valeur 1 ce qui veut dire qu'ils sont mis en avant.


Cardinalités : 

- entre Category en Movie : Dans une catégorie il peut y avoir au minimum O films et au maximum n film , un film peut être dans au minimum 1 catégorie et au maximum 1 catégirie.
- entre Movie et Profile : Un film peut être mis en favoris pas au minimun 0 profile et au maximun n profile, un profile peut mettre en favoris au minimun 0 films et au maximum n films.




