# Gestión de Tareas API

Este proyecto es una API en PHP que permite hacer distintas consultas mediante endpoints.

## Requisitos

- PHP 7.4 o superior
- Composer
- MySQL
- Servidor web (Apache recomendado)

## Instalación

Sigue estos pasos para configurar y ejecutar el proyecto en tu entorno local:

1. **Clonar el repositorio**

   Clona el repositorio desde GitHub utilizando el siguiente comando:

   ```bash
   git clone https://github.com/emanuel2398/gestion_tareas_api.git
   
2. **Instalar dependencias**

Ejecuta Composer en la consola para instalar las dependencias:

```bash composer install ```

3.**Configurar el archivo .env**

Copia el archivo de ejemplo .env.example a un nuevo archivo .env:
```cp .env.example .env ```

4. Editar el archivo .env para configurar las credenciales de la base de datos y otros parámetros necesarios:
   
DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=nombre_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
