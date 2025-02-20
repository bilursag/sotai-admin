# Proyecto Laravel - Administración de Usuarios

Este es un proyecto basado en Laravel que permite la administración de usuarios con roles y permisos utilizando `spatie/laravel-permission`.

## 🚀 Instalación y Configuración

Sigue estos pasos para instalar y configurar el proyecto correctamente.

### 📥 1. Clonar el repositorio
```bash
git clone <URL_DEL_REPOSITORIO>
cd <NOMBRE_DEL_REPOSITORIO>
```

### 📌 2. Instalar dependencias
```bash
composer install
```

### 📂 3. Configurar entorno
```bash
cp .env.example .env
```
Luego, edita el archivo `.env` y configura los datos de la base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 🔑 4. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 💾 5. Ejecutar migraciones y seeders
```bash
php artisan project:setup
```
Esto ejecutará:
- Migraciones de la base de datos.
- Seeders personalizados (`RoleAndPermissionSeeder` y `AdminUserSeeder`).
- Limpieza de caché.

### 🏃 6. Iniciar el servidor
```bash
php artisan serve
```

El proyecto estará disponible en `http://127.0.0.1:8000`.

## 🔐 Acceso Administrador
Después de ejecutar los seeders, puedes iniciar sesión con el usuario administrador generado automáticamente:

- **Correo:** `admin@example.com`
- **Contraseña:** `password`

## 📜 Comandos Útiles

- Limpiar caché:
  ```bash
  php artisan cache:clear
  php artisan config:clear
  php artisan route:clear
  ```

- Ejecutar solo migraciones:
  ```bash
  php artisan migrate
  ```

- Ejecutar solo seeders:
  ```bash
  php artisan db:seed --class=AdminUserSeeder
  php artisan db:seed --class=RoleAndPermissionSeeder
  ```

## 📄 Licencia
Este proyecto está bajo la licencia MIT.

