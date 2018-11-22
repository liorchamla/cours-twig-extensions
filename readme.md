# Tutoriel : comment créer une extension Twig !

Ici on apprend comment créer ses propres filtres Twig !

# Installation

```
# On clone le dépot
git clone https://github.com/liorchamla/cours-twig-extensions.git

# On va dans le dossier
cd cours-twig-extensions

# On télécharge les dépendances
composer install

# On ouvre dans son éditeur préféré
code .

# On modifie le .env
# On créé la base de données
php bin/console doctrine:database:create

# On créé les tables
php bin/console doctrine:migrations:migrate

# On charge les données
php bin/console doctrine:fixtures:load --no-interaction

# On lance le serveur !
php bin/console server:run

```
