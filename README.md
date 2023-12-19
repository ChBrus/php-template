# PHP-Builder
Este proyecto tiene como objetivo proporcionar una estructura base que sirva de apoyo en la realización de proyectos durante mis prácticas profesionales.
## Índice
- [Empezar](#Empezar)
    - [Requerimientos](#Requerimientos)
    - [Instalación](#Instalación)

## Empezar
Para comenzar a utilizar este proyecto, primero verifica si cumples con los requisitos mencionados y luego continúa con el proceso de instalación.
### Requerimientos
Asegúrate de cumplir con los siguientes requisitos antes de usar PHP-Builder:
- PHP versión 8.2
- Composer instalado como manejador de paquetes
- Node instalado
- Sass instalado (si no sabes cómo, [consulta aquí](https://getbootstrap.com/docs/5.3/customize/sass/#compiling))
- Servicios de base de datos MySQL
- Conocimientos de Programación Orientada a Objetos (POO)

### Instalación

**Paso 1: Clonar el Repositorio**
Para obtener el repositorio en tu entorno local, ejecuta el siguiente comando en tu terminal:
```bash
git clone https://github.com/ChBrus/php-builder.git
```
Después de la instalación, elimina la carpeta `.git/` con el siguiente comando:
```bash
rm -r ./php-builder/.git/
```
**Paso 2: Instalación de Dependencias**
Ejecuta el siguiente comando en la terminal para instalar todas las dependencias:
```bash
composer install
```
**Paso 3: Configuración**
Si decides convertir tu proyecto en un repositorio de GitHub, abre el archivo `.gitignore` y descomenta las siguientes líneas:
```
### Configuration to enable ###
.env
# /app/phpunit.xml
# /phpunit.xml
# /test/
```
Sin embargo, mantén comentada la línea ### Configuration to enable ###.

------------

Además, para la configuración, crea un archivo llamado .env y añade la siguiente información:
```
# Project data
ProjectName="php-builder"

# Tables
maxRows="50"

# Database connection
DBHost="localhost"
DB="table"
DBName="root"
DBPassword=""
DBCharset="utf8"
```
Este archivo almacenará la configuración específica de tu proyecto.