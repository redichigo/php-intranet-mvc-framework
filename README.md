# 📌 php-intranet-mvc-framework
![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=flat&logo=php)
![License](https://img.shields.io/badge/Licencia-MIT-green?style=flat)
![Estado](https://img.shields.io/badge/Estado-En%20desarrollo-yellow?style=flat)
![Last Commit](https://img.shields.io/github/last-commit/maurikius-dev/php-intranet-mvc-framework?style=flat)
![Repo Size](https://img.shields.io/github/repo-size/maurikius-dev/php-intranet-mvc-framework?style=flat)

Framework MVC en PHP diseñado para intranets corporativas, con una arquitectura modular, ligera y fácilmente extensible.  
Incluye gestión de sesiones, sistema de módulos, controladores, modelos, vistas fragmentadas, helpers globales y una estructura preparada para entornos de hosting compartido.

---

## 🚀 Características principales

- Arquitectura **MVC real** (Model–View–Controller)  
- Sistema de módulos totalmente desacoplado  
- Control de sesiones integrado  
- Helpers globales en PHP y JS  
- Carga automática de librerías externas  
- Enrutamiento mediante `.htaccess`  
- Integración con PDO (MySQL)  
- Estructura optimizada para intranets corporativas  
- Plantillas HTML fragmentadas para reutilización  
- Login modular con controlador, modelo y recursos propios  

---

## 🛠️ Instalación

### 1. Crear la base de datos
- Nombre recomendado: **intranet**  
- Codificación: **utf8**  
- Collation: **utf8_general_ci**

### 2. Importar la estructura inicial
Ejecuta la query ubicada en: `assets/sql/intranet.sql`

### 3. Configurar la conexión a la base de datos
Edita el archivo: `config/connections.php`

### 4. Subir el proyecto al hosting
Coloca la carpeta del framework en la raíz del dominio o subdominio: /

### 5. Configurar rutas
En `config/app.php` ajusta la constante: `define("BASE_URL", "/intranet/");`

### 6. Configurar .htaccess
Edita el archivo `.htaccess` y descomenta la línea: `#RewriteBase /`
Debe apuntar a la raíz del hosting o al subdirectorio donde esté instalada la intranet.

---

### 📂 Estructura del proyecto

- assets: Directorio para almacenar los recursos globales del proyecto.
    - css: Archivo de css global.
    - font: Fuentes descargadas.
    - img: Imágenes globales.
    - js: Archivo js global.
    - plugins: Todas las librerías del proyecto (Bootstrap, jQuery, FontAwesome...).
    - SQL: Archivos SQL (por ejemplo el global para crear los accesos y usuarios).

- config: Directorio de archivos de configuración del proyecto.
    - app.php: Definición de constantes para el funcionamiento del proyecto.
    - connections.php: Array de conexiones a diferentes BBDD, por defecto intranet.
    - Database: Clase con el método query (PDO MySQL). 
    - functions_js.php: Repositorio de funciones genéricas js.
    - functions.php: Repositorio de funciones genéricas php. 
    - libs.php: Definición de constantes con los path de las librerías de terceros.
    - Session: Clases para el control de sesiones.

- modules: Directorio para los diferentes  módulos (páginas) del proyecto.
    - Errores: Archivos php para los errores de servidor (401, 402, 403).
    - includes: Archivos para fragmentar las vistas que son comunes.
        - info_meta.php: Etiquetas meta (html) y título del proyecto.
        - menu_top: Menú superior comun en todos los módulos.
        - static_css: Etiquetas stylesheet (html) con las constantes referenciadas comunes en los  módulos.
        - static_js: Etiquetas Script (html) con las constantes referenciadas de librerías y script comunes en los  módulos.
    - login: Módulo para el login en la intranet
        - Resources: Directorio donde almacenan directorios específicos del Módulo (img, pdf, sonidos...)
        - view.php: html con la vista y los includes.
        - style.php: Estilos css de ese módulo en concreto.
        - script.php: JS del módulo en concreto (peticiones ajax, funcionalidades...).
        - Controller.php: Clase donde llegan las peticiones ajax para enlazar con el modelo.
        - Model.php: Clase donde se hacen las queries a la BBDD y retorna al controlador.


- .htaccess: Archivo para configurar y reescribir las reglas para el hosting.
- favicon: Icono que se mostrará en la pestaña del navegador.
- index.php: Archivo por donde pasan las peticiones y configuración del proyecto (Mejor no tocar).
- info.txt: Este mismo archivo.

---

### 🧩 Requisitos

- PHP 7.4+
- MySQL 5.7+
- Hosting con soporte para .htaccess
- Extensión PDO habilitada
  
---

### 🧑‍💻 Autor

Mauricio Fuentes Raposo  
Team Leader & Backend Developer — Especializado en PHP y arquitecturas MVC para entornos corporativos.
GitHub: @maurikius-dev

