# Ralyt

Bienvenido a **Ralyt**. Este documento contiene las instrucciones básicas para instalar y ejecutar el proyecto en un entorno local.

## 📋 Requisitos previos

Antes de comenzar, asegúrate de tener instalado un entorno de servidor local que incluya PHP y MySQL, como por ejemplo:
* [XAMPP](https://www.apachefriends.org/es/index.html)
* WAMP / MAMP / Laragon

---

## 🚀 Pasos de instalación

### 1. Configurar la base de datos
1. Inicia los servicios de **Apache** y **MySQL** desde el panel de control de tu servidor local (ej. XAMPP).
2. Abre tu navegador y ve a `http://localhost/phpmyadmin`.
3. Crea una nueva base de datos llamada exactamente **`ralyt`** (puedes usar el cotejamiento `utf8mb4_general_ci`).
4. Selecciona la base de datos recién creada, ve a la pestaña **Importar**, selecciona el archivo **`ralyt.sql`** (incluido en este repositorio) y haz clic en **Continuar** o **Importar**.

### 2. Ubicar los archivos del proyecto
1. Copia la carpeta completa del proyecto (`ralyt`).
2. Pégala dentro del directorio raíz de tu servidor local:
   * **Si usas XAMPP:** `C:\xampp\htdocs\` (en Windows) o `/Applications/XAMPP/htdocs/` (en Mac).

### 3. Ejecutar la aplicación
1. Abre tu navegador web preferido.
2. Ingresa a la siguiente dirección:
   ```text
   http://localhost/ralyt
   ```
3. Usuarios para poder entrar a la aplicacion:
---Correo: maria.h@ralyt.test Contraseña: Ralyt1234
Correo: jose.p@ralyt.test Contraseña: Ralyt1234
Correo: ana.s@ralyt.test Contraseña: Ralyt1234

## 🛠️ Notas adicionales
* Si modificaste el usuario o la contraseña de tu base de datos MySQL (por defecto en XAMPP el usuario es `root` y sin contraseña), recuerda actualizar las credenciales en el archivo de conexión del proyecto.
