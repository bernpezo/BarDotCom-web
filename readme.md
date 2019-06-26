## Para installar

Instalar:
composer install

Ingresar datos por defecto
php artisan migrate:refresh --seed

## Para usar

Cuenta de Administrador de sistema
Usuario: admin@bardotcom.cl
Contraseña: 123123123

## Otros usuario

Cuando el Administrador de sistema crea un Local comercial, se crea un Administrador de local y 5 usuarios de local.

El formato para de la cuenta del Administrador de local es:
Usuario: "email del Local comercial al que pertenece"
Contraseña: "nombre del Local comercial al que pertenece"

El formato para las cuentas de Usuario de local es:
Usuario: i"email del Local comercial al que pertenece"
Contraseña: "nombre del local comercial al que pertenece"
    (1) donde i es un número de 0 a 4

El usuario Cliente se crea al registrarse mediante el formulario de registro