Crear un nuevo proyecto:
composer create-project symfony/skeleton:"7.2.x" nombre_del_proyecto

Instalar dependencias:
composer install

Crear base de datos:
php bin/console doctrine:database:create

Crear controller:
php bin/console make:controller

Descargar security:
composer require symfony/security-bundle

Crear entidad user:
php bin/console make:user

Migrar DB:
php bin/console make:migration
php bin/console doctrine:migrations:migrate

Hacer el login:
php bin/console make:security:form-login

Hacer el register:
composer require symfonycasts/verify-email-bundle
php bin/console make:registration-form

Para redirigir el login encontré esto en las preguntas frecuentes de la documentacion:
https://symfony.com/doc/current/security/form_login.html


Para ver si el user esta logueado:
https://symfony.com/doc/current/security.html#fetching-the-user-object


Para añadir bootstrap:
php bin/console importmap:require bootstrap


Validaciones(coche):
marca->length
km->PositiveOrZero

Ordenado por:
marca->asc
km->asc

Si hay algun problema con el server, con añadir o quitar un espacio en el twig se soluciona