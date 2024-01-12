# PHP-Builder
Este proyecto tiene como objetivo proporcionar una estructura base que sirva de apoyo en la realización de proyectos durante mis prácticas profesionales.
## Índice
- [Empezar](#Empezar)
    - [Requerimientos](#Requerimientos)
    - [Instalación](#Instalación)
- [Estructura](#Estructura)
	- [App](#App)

## Empezar
Para comenzar a utilizar este proyecto, primero verifica si cumples con los requisitos mencionados y luego continúa con el proceso de instalación.
### Requerimientos
Asegúrate de cumplir con los siguientes requisitos antes de usar PHP-Builder:
- PHP versión 8.2
- Composer
- Node
- Sass
- Base de datos MySQL

### Instalación

**Paso 1: Clonar el Repositorio**
Para obtener el repositorio en tu entorno local, ejecuta el siguiente comando en tu terminal:
```bash
git clone https://github.com/ChBrus/php-template.git [nombre-carpeta]
```
Dónde `[nombre-carpeta]` va a ser el nombre del proyecto que harás con PHP-Template. Después de la instalación, elimina la carpeta `.git/` con el siguiente comando:
```bash
rm -r ./[nombre-carpeta]/.git/
```
No olvides que tienes que poner el nombre de la carpeta que pusiste anteriormente.
**Paso 1.5: Moverse a la carpeta del proyecto**
Esto es necesario para continuar con el siguiente paso, así que para poder moverte a la carpeta del proyecto desde la terminal recuerda que es así:
```bash
cd ./[nombre-carpeta]
```
**Paso 2: Instalación de Dependencias**
Ejecuta el siguiente comando en la terminal para instalar todas las dependencias:
```bash
composer install
```
**Paso 3: Configuración**
Para comenzar con la configuración, tienes que tener en cuenta que hay 3 archivos a abrir para poder configurar tu proyecto.

**.gitignore**
Aquí vas a necesitar moverte hasta las últimas líneas del archivo y buscar las líneas a continuación para luego quitar los comentarios con un `Ctrl + }` o quitando `# ` incluyendo el espacio de por medio.
```
### Configuration to enable ###
.env
# /app/phpunit.xml
# /phpunit.xml
# /test/
```
Sin embargo, mantén comentada la línea `### Configuration to enable ###` para que no sucedan errores

**.env**
El archivo de entorno o también conocido como `.env` es aquel dónde necesitarás poner información base para el proyecto. A continuación información base para el archivo:
```
# Project data
ProjectName="php-template"
ProjectIsRoot=0

# Tables
maxRows="50"

# Database connection
DBHost="localhost"
DB="database"
DBName="root"
DBPassword=""
DBCharset="utf8"
```
Y un poquito de contexto acerca de cada valor a las variables anteriormente vistas.

| Variable | Descripción |
| ------------ | ------------ |
| ProjectName | El nombre de la carpeta del proyecto. |
| ProjectIsRoot | Si la carpeta del proyecto es la carpeta principal del host, el valor debe de ser 1, si no es la carpeta principal 0. Por ejemplo, en xampp tenemos `htdocs/carpeta/` en este caso, el valor de la variable debe de ser 0. |
| maxRows | La cantidad máxima de filas que podemos pedir a una tabla de la base de datos. Este valor es por default, pero dinámicamente se puede cambiar el valor cuando la tabla está en ejecución. |
| DBHost | La `IP` o `URL` dónde se ubica la base de datos |
| DB | El nombre de la base de datos |
| DBName | El nombre de usuario con el que nos conectaremos a la base de datos |
| DBPassword | La contraseña del usuario |
| DBCharset | Este por defecto está en `utf8`, si es de tú agrado, puedes usar otra colección |

## Estructura
El proyecto se compone de 2 carpetas principales que hacen que tu aplicación funcione. Las cuales son: `app/` y `vendor/`. Dónde también hay que tener en cuenta una carpeta *extra* llamada `test`. Veamos de que se componen estas 3 carpetas.

### App
**En construcción...**