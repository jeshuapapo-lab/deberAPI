# ⛅ GeoClima Multi-API

GeoClima Multi-API es una aplicación web desarrollada como práctica de integración de APIs. El sitio permite consultar información de una ciudad ingresada por el usuario y mostrar datos combinados de clima, amanecer, atardecer, descripción informativa, hora local y calidad del aire.

El proyecto cuenta con inicio de sesión, registro de usuarios y una interfaz sencilla para buscar ciudades desde un navegador web.

## 🌐 Sitio publicado

El proyecto se encuentra publicado en Hostinger:

https://slategrey-gnat-716336.hostingersite.com/

## 📌 Objetivo del proyecto

El objetivo principal de GeoClima Multi-API es demostrar el consumo de varias APIs públicas dentro de una aplicación web funcional. Al escribir el nombre de una ciudad, el sistema obtiene datos reales desde diferentes servicios externos y los presenta en una sola pantalla de forma ordenada.

## 🧩 APIs utilizadas

### 1. Open-Meteo Weather

Se utiliza para obtener información del clima actual y datos de ubicación de la ciudad buscada.

Datos utilizados:

- Temperatura actual.
- Sensación térmica.
- Humedad.
- Velocidad del viento.
- Temperatura máxima.
- Temperatura mínima.
- Latitud.
- Longitud.
- Zona horaria.

### 2. Sunrise-Sunset

Se utiliza para obtener los horarios solares según la latitud y longitud de la ciudad.

Datos utilizados:

- Hora del amanecer.
- Hora del atardecer.

### 3. Wikipedia API

Se utiliza para mostrar una breve descripción informativa de la ciudad consultada.

Datos utilizados:

- Resumen de la ciudad.
- Enlace para ver más información en Wikipedia.

### 4. TimeAPI.io

Se utiliza para obtener la hora y fecha local de la ciudad según su zona horaria.

Datos utilizados:

- Hora local.
- Fecha local.

### 5. Open-Meteo Air Quality

Se utiliza para consultar información relacionada con la calidad del aire de la ciudad.

Datos utilizados:

- PM2.5.
- PM10.
- Ozono.
- Índice UV.

## 🛠️ Tecnologías utilizadas

- HTML5.
- CSS3.
- JavaScript.
- PHP.
- MySQL.
- Hostinger.
- phpMyAdmin.
- GitHub.

## 🔐 Funcionalidades principales

- Registro de usuarios.
- Inicio de sesión.
- Cierre de sesión.
- Búsqueda de ciudades.
- Consulta de clima actual.
- Consulta de amanecer y atardecer.
- Consulta de hora y fecha local.
- Consulta de calidad del aire.
- Descripción informativa de la ciudad mediante Wikipedia.
- Visualización de varias APIs en una sola interfaz.

## 📁 Estructura del proyecto

```text
public_html/
│
├── index.php
├── registro.php
├── login.php
├── logout.php
├── dashboard.php
├── conexion.php
├── api.php
├── database.sql
├── README.md
│
├── css/
│   ├── styles.css
│   └── auth.css
│
└── js/
    ├── app.js
    └── app2.js
```

## 🗄️ Base de datos

El proyecto utiliza una base de datos MySQL para guardar los usuarios registrados.

Tabla principal:

```sql
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(120) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## ⚙️ Funcionamiento general

1. El usuario entra al sitio web.
2. Se registra o inicia sesión.
3. Ingresa el nombre de una ciudad.
4. JavaScript consulta las APIs externas.
5. La información recibida se muestra en tarjetas dentro del panel principal.
6. El usuario puede cerrar sesión cuando termine.

## 🧠 Explicación técnica

La aplicación combina datos de diferentes APIs usando solicitudes `fetch()` desde JavaScript. Primero se consulta Open-Meteo para obtener la ubicación de la ciudad, incluyendo latitud, longitud y zona horaria. Con esos datos se realizan las demás consultas a Sunrise-Sunset, TimeAPI.io y Open-Meteo Air Quality.

Wikipedia API se utiliza para agregar una descripción general de la ciudad buscada, haciendo que el sitio no solo muestre datos climáticos, sino también información contextual.

## 🚀 Cómo ejecutar el proyecto

Para ejecutar el proyecto se necesita un servidor con soporte para PHP y MySQL, como XAMPP o un hosting web.

Pasos básicos:

1. Copiar los archivos del proyecto en la carpeta del servidor.
2. Crear una base de datos MySQL.
3. Importar el archivo `database.sql`.
4. Configurar los datos de conexión en `conexion.php`.
5. Abrir el sitio desde el navegador.
6. Registrar un usuario e iniciar sesión.

## 📍 Ejemplos de búsqueda

Algunas ciudades que se pueden probar:

- Guayaquil.
- Quito.
- Madrid.
- Tokio.
- Buenos Aires.
- Nueva York.

## 👨‍🎓 Autor

Proyecto realizado por:

**Jeshua Alejandro Sánchez Alcívar**

## 📚 Conclusión

GeoClima Multi-API demuestra cómo una aplicación web puede integrar varios servicios externos para entregar información útil al usuario. El proyecto combina frontend, backend, base de datos, autenticación y consumo de APIs públicas en un sitio publicado en internet.
