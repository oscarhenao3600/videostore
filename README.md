Video Store



Acerca del proyecto

dararrollo en framework Laravel de php y base de datos con MySQL.


-- Ejecución

1. Abrir xampp

Una vez abierto el XAMPP, buscamos el archivo php.ini, luego dentro del archivo buscamos la extensión gd (extension=gd) que esta comentada, la vamos a descomentar quitando el ;. Luego se inicia el servicio de MySQL. 

2. Descarga proyecto repositorio y de dependencias

Abrir la consola "git bash" y nos dirigimos la ruta donde se quiere guardar el proyecto, una vez en la ruta copiamos y pegamos la siguiente línea en la consola de git:

```sh
$ git clone https://github.com/oscarhenao3600/videostore.git
```

Una vez clonado entramos en la carpeta del protecto.

```sh
$ cd videostore
```

Una vez en la carpeta raíz del proyecto se ejecuta el comando

```sh
$ Composer update
```

3. Crear base de datos y exportar

La exportación de la base de datos se puede realizar con herramientas que gestionen gráficamente la base de datos como lo son phpmyadmin, MySQL workbench etc. 

4. Ejecutar el proyecto

Una vez el servicio de MySQL se este ejecutando, levantamos el servicio de laravel, para ello en la carpeta raíz del proyecto ejecutamos el siguiente comando en la terminal.

```sh
$ php artisan serve
```
