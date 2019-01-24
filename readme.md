Prerequis

``
Docker
Skyflow 
``

https://skyflow.io/

##Installation 

skyflow compose:up 
skyflow compose:composer:run "composer update"
skyflow compose:symfony:sh
bin/console doctrine:database:create --if-not-exists // penser a conf le .env

##Local Environment

    App URL : http://localhost:80/
    MariaDB url: http://localhost:3306/
    Db : sridar
    DATABASE_URL=mysql://sridar:sridar@<MARIA_DB CONTAINER ID/sridar

###Commande Utile

Symfony :

```

skyflow C:update

skyflow compose:symfony:sh  // Acces au container symfony 

bin/console doctrine:database:create --if-not-exists // Cree la BD

bin/console doctrine:schema:update --force // Update la BD

```

## create User + Role

```
php bin/console fos:user:create admin
bin/console fos:user:promote <votrenomutilisateur> ROLE_ADMIN
```
