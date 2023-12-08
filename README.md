# PHP-Builder
Este proyecto fue hecho con la finalidad de tener una estructura base con la que apoyarme al hacer mis proyectos en mis prácticas profesionales.
## Índice
- [Empezar](#Empezar)
 - [Requerimientos](#1. Requerimientos)
 - [Instalación](#2. Instalación)

## Empezar
Para comenzar a usar este proyecto, primero tienes que ver si cumples con los requerimientos y luego ya puedes seguir con el proceso de instalación.
### 1. Requerimientos
Como ya leíste, usted necesita cumplir con los siguientes requerimientos para usar PHP-Builder:
- PHP en su versión 8.2
- Tener instalado el manejador de paquetes Composer
- Tener instalado Node
- Tener instalado Sass, si usted no sabe como, [haga click aquí](https://getbootstrap.com/docs/5.3/customize/sass/#compiling "haga click aquí")
- Usar servicios de base de datos MySQL
- Tener conocimiento de POO

### 2. Instalación
El primer paso para comenzar a usar PHP-Builder, es obtener el repositorio en tu local. Como ya sabemos, primero tienes que ir a tu terminal de confianza, y obviamente con git instalado, y vas a insertar el siguiente comando:
```bash
git clone https://github.com/ChBrus/php-builder.git
```
Después de haber instalado el repositorio en tu carpeta, tienes que eliminar la carpeta `.git/` ejecutando el siguiente comando en tu terminal abierta, la cual espero estés usando `bashshell`.
```bash
rm -r ./php-builder/.git/
```
Ya ejecutado el comando, si es de tu agrado, puedes cambiar el nombre de la carpeta, **OJO AL DATO**, si cambias el nombre de la carpeta del proyecto, tendrás que ir al archivo `.env` de `php-builder` y cambiar el valor de la variable `ProjectName` al nombre de carpeta que hayas puesto.

------------

Ya dicho lo anterior, ahora toca hacer la instalación de todas las dependencias, ve a la terminal y ejecuta el siguiente comando.
```bash
composer install
```
#### Extra
Si es de tu agrado hacer un repositorio de GitHub tu proyecto, tienes que ir al archivo `.gitignore` hasta las últimas líneas y buscar el siguiente texto:
```
### Configuration to enable ###
# .env
# /app/phpunit.xml
# /phpunit.xml
# /test/
```
Usted va a descomentar esas líneas, a excepción de la línea que dice `### Configuration to enable ###`