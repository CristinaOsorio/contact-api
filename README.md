# API de Gestión de Contactos - Laravel

Este repositorio contiene la API para la aplicación de gestión de contactos. Está construido con Laravel y utiliza Sail para facilitar el desarrollo y la configuración del entorno.

## Índice

- [Características](#características)
- [Tecnologías](#tecnologías)
- [Instalación](#instalación)
- [Uso](#uso)
- [Endpoints](#endpoints)

## Características

- **CRUD de Contactos**: Crear, leer, actualizar y eliminar contactos y sus detalles (teléfonos, emails y direcciones).
- **Paginación**: Listar contactos con soporte de paginación.
- **Validaciones**: Validación de datos de entrada para garantizar la integridad.

## Tecnologías

- **Laravel**: Framework para el desarrollo de aplicaciones web.
- **PHP**: Lenguaje de programación utilizado.
- **MySQL**: Sistema de gestión de bases de datos utilizado.
- **Laravel Sail**: Entorno de desarrollo basado en Docker.

## Instalación

1. **Clonar el repositorio:**

    Abre tu terminal y clona el repositorio con el siguiente comando:

    ```bash
    git clone hhttps://github.com/CristinaOsorio/contact-api
    ```

2. **Navegar al directorio del proyecto:**

    Cambia al directorio del proyecto clonado:

    ```bash
    cd contact-api
    ```

3. **Instalar las dependencias:**

    Si no tienes Composer instalado, puedes instalarlo siguiendo las [instrucciones oficiales](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

    Una vez que tengas Composer, instala las dependencias del proyecto:

    ```bash
    composer install
    ```

4. **Publicar el archivo de configuración de Sail:**

    Laravel Sail incluye un archivo de configuración que puedes publicar. Esto te permitirá personalizar la configuración de Docker si es necesario:

    ```bash
    php artisan sail:install
    ```

5. **Iniciar Sail:**

    Usa el siguiente comando para iniciar Sail y levantar los contenedores de Docker:

    ```bash
    ./vendor/bin/sail up
    ```

    Este comando también puede ejecutarse en segundo plano usando el flag `-d`:

    ```bash
    ./vendor/bin/sail up -d
    ```

6. **Acceder a la aplicación:**

    Una vez que Sail esté en funcionamiento, puedes acceder a tu aplicación en `http://localhost` o en la dirección IP del contenedor Docker que se muestra en la terminal.

7. **Configurar la base de datos:**

    Edita el archivo `.env` en la raíz de tu proyecto para configurar la conexión a la base de datos. Asegúrate de que las siguientes líneas están configuradas adecuadamente:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=sail
    DB_PASSWORD=password
    ```

8. **Ejecutar migraciones y seeders:**

    Después de configurar tu base de datos, ejecuta las migraciones y los seeders para crear las tablas y poblarlas con datos iniciales:

    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```

9. **Parar Sail:**

    Para detener los contenedores de Sail, puedes usar el siguiente comando:

    ```bash
    ./vendor/bin/sail down
    ```

    ### Recursos Adicionales

- [Documentación oficial de Laravel Sail](https://laravel.com/docs/11.x/sail#main-content): Encuentra información completa sobre la instalación, configuración y uso de Laravel Sail.

- [Guía de Docker](https://docs.docker.com/get-started/): Esta guía es ideal para quienes son nuevos en Docker y desean aprender sobre la creación y gestión de contenedores.

- [Laravel Documentation](https://laravel.com/docs/11.x): La documentación oficial de Laravel ofrece una visión detallada de todas las características y funcionalidades del framework.

## Uso

Una vez que la API esté en funcionamiento, puedes interactuar con ella utilizando herramientas como Postman o curl.

- La API estará disponible en `http://localhost`.

## Endpoints

| Método | Endpoint                        | Descripción                                               |
|--------|---------------------------------|-----------------------------------------------------------|
| GET    | /api/contacts                   | Obtener todos los contactos.                              |
| POST   | /api/contacts                   | Crear un nuevo contacto.                                  |
| GET    | /api/contacts/{id}             | Obtener un contacto específico.                           |
| PUT    | /api/contacts/{id}             | Actualizar un contacto específico.                        |
| DELETE | /api/contacts/{id}             | Eliminar un contacto específico.                          |

