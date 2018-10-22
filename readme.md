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

    App URL : http://localhost:8889/
    MariaDB url: 0.0.0.0:3306
    Db : coding`
    DATABASE_URL=mysql://coding:coding@0.0.0.0:3306/coding

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
