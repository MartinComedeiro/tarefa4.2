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


php bin/console make:security:form-login

composer require symfonycasts/verify-email-bundle
php bin/console make:registration-form


Para redirigir el login encontré esto en las preguntas frecuentes de la documentacion:
https://symfony.com/doc/current/security/form_login.html