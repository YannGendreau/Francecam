# Francecam
Repo du site Francecam



Command for database: 
- php bin/console doctrine:database:drop --force
- php bin/console doctrine:database:create
For import fresh: 
-  php bin/console doctrine:migrations:migrate
For import with data:
- php bin/console doctrine:database:import bin/dump.sql
  