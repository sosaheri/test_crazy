# Crazy Test pre empleo

Se implemento sistema de gestión que permite registrar usuarios (Administradores, Gerentes) y gestionar estudiantes, con un panel de control diferenciado según el rol del usuario.

---

## Requisitos del Sistema

Asegúrate de tener instalado lo siguiente en tu entorno de desarrollo:

* **PHP:** Versión 8.1 o superior
* **Composer:** Gestor de dependencias de PHP
* **Node.js y npm (o Yarn):** Para compilar los assets de frontend con Tailwind CSS
* **Base de Datos:** MySQL

---

## Instalación

Puedes configurar el proyecto clonando el repositorio o usando un archivo `.rar` compartido.

### Opción 1: Clonar el Repositorio

1.  **Clona el repositorio:**

    ```bash
    git clone https://github.com/sosaheri/test_crazy.git
    cd [test_crazy]
    ```

### Opción 2: Usar un Archivo .rar Compartido

1.  **Descarga y descomprime el archivo `.rar`** del proyecto en la ubicación deseada.
2.  **Navega al directorio del proyecto** en tu terminal.

    ```bash
    cd /ruta/a/tu/carpeta/del/proyecto
    ```

### Pasos Comunes para Ambas Opciones

Una vez que tengas los archivos del proyecto en tu máquina, sigue estos pasos:

1.  **Instala las dependencias de Composer:**

    ```bash
    composer install
    ```

2.  **Copia el archivo de entorno:**

    ```bash
    cp .env.example .env
    ```

3.  **Genera la clave de aplicación:**

    ```bash
    php artisan key:generate
    ```

4.  **Configura tu base de datos:**
    Abre el archivo `.env` y configura las credenciales de tu base de datos:

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```
    Reemplaza `your_database_name`, `your_database_user`, y `your_database_password` con tus propios datos.

5.  **Ejecuta las migraciones y seeders (opcional):**
    Esto creará las tablas de la base de datos y las poblará con datos de prueba si tienes seeders configurados (por ejemplo, para roles o un usuario inicial).

    ```bash
    php artisan migrate
    ```

6.  **Crea un enlace simbólico para el almacenamiento:**
    Esto es crucial para que las imágenes de perfil (y otros archivos subidos) sean accesibles públicamente.

    ```bash
    php artisan storage:link
    ```

7.  **Instala las dependencias de Node y compila los assets de frontend:**

    ```bash
    npm install
    npm run dev  # Para desarrollo (compila los estilos Tailwind)
    # o
    npm run build # Para producción (optimiza y minifica)
    ```
    Si estás en desarrollo y quieres que los estilos se recompilen automáticamente al guardar cambios, puedes usar:
    ```bash
    npm run watch
    ```

---

## Uso del Sistema

Una vez que la instalación sea exitosa, puedes usar la aplicación.

1.  **Inicia el servidor de desarrollo de Laravel:**

    ```bash
    php artisan serve
    ```
    Esto iniciará el servidor en `http://127.0.0.1:8000` (o un puerto diferente si el 8000 está en uso).

2.  **Accede a la aplicación en tu navegador:**
    Abre tu navegador web y ve a `http://127.0.0.1:8000`.

### Uso del sistema

* **Registro de Usuarios:**
    Accede a la ruta `http://127.0.0.1:8000/signup` (o la ruta que hayas definido para el registro). Aquí podrás crear nuevos usuarios y asignarles un rol.

* **Inicio de Sesión:**
    Accede a la ruta `http://127.0.0.1:8000`. Ingresa las credenciales de un usuario registrado.

* **Dashboards:**
    * Si inicias sesión como **Administrador**, serás redirigido a `/admin/dashboard`.
    * Si inicias sesión como **Manager**, serás redirigido a `/manager/dashboard`.

* **Gestión de Estudiantes:**
    Desde el dashboard de Administrador o Gerente, busca el enlace para "Gestionar Estudiantes" (o similar). Esto te llevará a la vista de lista de estudiantes.

    * **Añadir Nuevo Estudiante:** Usa el botón `Añadir Nuevo Estudiante` para ir al formulario de creación.
    * **Ver/Editar/Eliminar Estudiantes:** En la tabla de estudiantes, cada fila tendrá botones de acción para `Ver`, `Editar` o `Eliminar` un estudiante específico.

* **Importar Datos de Empleados (desde API):**
    Este proyecto incluye un comando de consola para obtener datos de empleados de una API externa y guardarlos en tu base de datos. Para ejecutarlo, necesitas tener un **worker de cola** escuchando, ya que los datos se procesan asíncronamente a través de un Job.

    1.  **Inicia el worker de cola (en una terminal separada):**
        ```bash
        php artisan queue:work
        ```
        Este comando mantendrá el worker escuchando y procesando los jobs.

    2.  **Ejecuta el comando para obtener los datos:**
        ```bash
        php artisan fetch-data
        ```
        Este comando enviará los datos obtenidos de la API a la cola. El worker de cola los procesará y creará los registros de empleados en la base de datos.


* **Paginación:**
    Si tienes muchos estudiantes, la tabla de estudiantes mostrará enlaces de paginación en la parte inferior para navegar entre las diferentes páginas de resultados.

---

## Notas Adicionales

* Asegúrate de que los permisos de tu servidor web (o el usuario que ejecuta `php artisan serve`) tengan acceso de escritura a las carpetas `storage` y `bootstrap/cache`.
* Si experimentas problemas con los estilos de Tailwind, verifica que `npm run dev` o `npm run build` se ejecutaron correctamente y que no hay errores en la consola de tu navegador.

---
¡Listo para usar! Si tienes alguna otra pregunta o necesitas ayuda, no dudes en preguntar sosaheriberto2021@gmail.com.