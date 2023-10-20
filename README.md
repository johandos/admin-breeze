# Configuración de Laravel Sail con Tailwind, Breeze y Livewire

Este README proporciona los pasos necesarios para configurar un entorno de desarrollo local utilizando Laravel Sail con las herramientas de desarrollo Tailwind CSS, Laravel Breeze y Livewire.

## Acerca de Sail con Tailwind, Breeze y Livewire

- **Sail**: Laravel Sail es una herramienta que simplifica la configuración de Docker para entornos de desarrollo de Laravel. Proporciona una forma rápida y eficiente de ejecutar aplicaciones Laravel en contenedores Docker.

- **Tailwind CSS**: Tailwind CSS es un framework de CSS altamente personalizable y utilizable mediante clases predefinidas. Facilita la creación de interfaces de usuario modernas y receptivas sin escribir CSS personalizado.

- **Laravel Breeze**: Laravel Breeze es un paquete de Laravel que proporciona una configuración de autenticación mínima y esencial. Es una excelente opción para proyectos pequeños y medianos que requieren autenticación de usuario.

- **Livewire**: Livewire es una biblioteca de Laravel que facilita la creación de componentes interactivos en tiempo real en tu aplicación web sin necesidad de escribir JavaScript. Puedes obtener más información en la [documentación de Livewire](https://laravel-livewire.com/docs).

## Requisitos previos

*Asegúrate de tener Docker instalado en tu sistema y sigue estos pasos para configurar Laravel Sail:*

1. **Instalación de Docker**: Si no tienes Docker instalado, puedes seguir las instrucciones de instalación para tu sistema en la [documentación oficial de Docker](https://docs.docker.com/get-docker/).

2. **Instalación de Laravel Sail**: Laravel Sail es un paquete de Laravel que se puede instalar mediante Composer. Abre una terminal en la raíz de tu proyecto y ejecuta el siguiente comando:

    ```bash
    composer require laravel/sail --dev
    ```

3. **Configuración de Docker**: Asegúrate de tener Docker configurado y funcionando correctamente en tu sistema. Puedes verificarlo ejecutando:

    ```bash
    docker --version
    ```

4. **Publicación de los archivos de Sail**: Después de instalar Sail, publica sus archivos de configuración ejecutando el siguiente comando:

    ```bash
    php artisan sail:install
    ```

## Pasos de configuración

1. **Configuración enviroment inicial**: Copia el archivo de configuración de ejemplo `.env.example` y renómbralo como `.env`. El archivo `.env.example` fue utilizado en local como prueba, así que copia el archivo de configuración adecuado.

    ```bash
    cp .env.example .env
    ```

2. **Configuración inicial de Composer**: Si no tienes configurado Composer en la carpeta `vendor`, puedes realizarlo de la siguiente forma:

    ```bash
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
    ```

3. **Configurar Sail para Docker y entornos**: Laravel Sail es una herramienta que simplifica la configuración de entornos de desarrollo local con Docker. Puedes configurar los servicios que necesitas en el archivo `docker-compose.yml` y la configuración de entorno en el archivo `.env`.

   Consulta la documentación oficial de [Laravel Sail](https://laravel.com/docs/8.x/sail) para obtener más detalles sobre la configuración.

4. **Iniciar el entorno Docker**: Ejecuta el siguiente comando para iniciar el entorno Docker en modo daemon (background):

    ```bash
    sail up -d
    ```

5. **Verificación de la existencia de la base de datos**: Antes de realizar las migraciones de la base de datos, asegúrate de que la base de datos exista. Puedes verificarlo ejecutando:

    ```bash
    sail artisan db:monitor
    ```

   Si la base de datos no existe, puedes crearla ejecutando:

    ```bash
    sail artisan db:create
    ```

6. **Realizar migraciones de la base de datos**: Ejecuta las migraciones de la base de datos para crear las tablas necesarias:

    ```bash
    sail php artisan migrate
    ```

7. **Alimentar la base de datos con datos de prueba (Opcional)**: Si deseas agregar datos de prueba a tu base de datos, puedes ejecutar:

    ```bash
    sail php artisan db:seed
    ```
   
    - El seed DatabaseSeeder contiene el usuario y contraseña de seguridad 
    ```
        User::factory()->create([
            'name' => 'seguridad web',
            'email' => 'seguridadweb@campusviu.es',
            'password' => bcrypt('S3gur1d4d?W3b'),
        ]);  
    ```

8. **Compilar assets con Yarn (Opcional)**: En la compilacion de achivos se utiliza vite y se trabaja con los estilos de tailwindcss, para compilarlos deforma correcta se utiliza:

    ```bash
    sail yarn build
    ```
