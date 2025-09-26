# Trabajo Final BD1 - Feline Zen

Este proyecto es una aplicación web para la gestión de clientes, cupones y servicios, desarrollada como trabajo final para la materia Bases de Datos I en la Universidad Nacional de Colombia, sede Medellín.

## Requisitos

- PHP >= 7.x
- MySQL/MariaDB
- Servidor web local (XAMPP, WAMP, MAMP, Laragon, etc.)
- Navegador web moderno

## Instalación

1. **Clona o descarga este repositorio**

   Descarga el proyecto y descomprímelo en la carpeta pública de tu servidor web local (por ejemplo, `htdocs` en XAMPP).

2. **Configura la base de datos**

   - Abre [dbEjemplo.txt](dbEjemplo.txt) y copia todo su contenido.
   - Ingresa a [phpMyAdmin](http://localhost/phpmyadmin) o usa la terminal de MySQL.
   - Crea una base de datos llamada `feline zen` (puedes cambiar el nombre, pero asegúrate de actualizarlo en [`config/conexion.php`](config/conexion.php)).
   - Ejecuta el SQL de `dbEjemplo.txt` para crear las tablas necesarias.

3. **Configura la conexión a la base de datos**

   - Abre [`config/conexion.php`](config/conexion.php).
   - Verifica que los datos de conexión (`$host`, `$user`, `$pass`, `$db`) coincidan con tu entorno local.

4. **Inicia el servidor web**

   - Asegúrate de que Apache y MySQL estén corriendo (por ejemplo, desde el panel de XAMPP).

5. **Accede a la aplicación**

   - Abre tu navegador y ve a [http://localhost/TrabajoFinalBD/index.php](http://localhost/TrabajoFinalBD/index.php) (ajusta la ruta según el nombre de la carpeta donde pusiste el proyecto).

## Estructura del proyecto

- `index.php`: Página principal con enlaces a las entidades y consultas.
- `cliente/`: CRUD para clientes.
- `cupon/`: CRUD para cupones.
- `servicio/`: CRUD para servicios.
- `consultas/`: Consultas SQL especiales.
- `busqueda/`: Búsquedas avanzadas.
- `config/conexion.php`: Configuración de la conexión a la base de datos.
- `includes/`: Archivos comunes (header y footer).
- `dbEjemplo.txt`: Script SQL para crear la base de datos y tablas.

## Créditos

- **Materia:** Bases de Datos I
- **Profesor:** Francisco Javier Moreno Arboleda
- **Institución:** Universidad Nacional de Colombia, sede Medellín
- **Semestre:** 2024-2

**Integrantes:**
- Juan David Trejos Gamboa
- María Manuela Salamanca Murcia
- Carolina Jaramillo Gomez

---

¡Listo! Ahora puedes usar y modificar el sistema según tus necesidades.