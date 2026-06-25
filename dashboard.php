<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeoClima Multi-API</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/auth.css">
    <script src="js/app2.js?v=7" defer></script>
</head>
<body>
<header class="header">
    <div class="header-container dashboard-header">
        <span class="header-logo">⛅ GeoClima Multi-API</span>
        <div class="user-area">
            <span>Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
            <a href="logout.php" class="logout-button">Cerrar sesión</a>
        </div>
    </div>
</header>

<main class="main-content">
    <section class="search-section">
        <h1 class="main-title">Clima e información de ciudades</h1>
        <p class="subtitle">
            Consulta datos combinados de clima, sol, Wikipedia, hora local y calidad del aire.
        </p>

        <form id="formulario-clima" class="search-form">
            <div class="input-group">
                <label for="buscar-ciudad" class="sr-only">Ciudad</label>
                <input id="buscar-ciudad" placeholder="Ej. Guayaquil, Madrid, Quito" autocomplete="off" required>
            </div>
            <button id="btn-buscar">Buscar</button>
        </form>
    </section>

    <div id="indicador-carga" class="loader-container hidden">
        <div class="spinner"></div>
        <p>Consultando APIs externas...</p>
    </div>

    <div id="mensaje-error" class="error-container hidden" role="alert"></div>

    <article id="contenedor-clima" class="weather-container hidden">
        <section class="main-card">
            <div class="main-card-header">
                <div>
                    <h2 id="clima-ciudad" class="city-name"></h2>
                    <p id="clima-pais" class="country-name"></p>
                </div>
                <span id="clima-icono" class="weather-icon"></span>
            </div>

            <div class="main-card-body">
                <div class="temp-principal">
                    <span id="clima-temp"></span><span class="u-temp">°C</span>
                </div>
                <p id="clima-descripcion" class="weather-description"></p>
            </div>

            <div class="main-card-footer">
                Consulta: <span id="clima-fecha"></span>
            </div>
        </section>

        <section class="details-grid">
            <div class="detail-card"><h3>Sensación</h3><p class="detail-value" id="detalle-termica"></p></div>
            <div class="detail-card"><h3>Máxima</h3><p class="detail-value" id="detalle-max"></p></div>
            <div class="detail-card"><h3>Mínima</h3><p class="detail-value" id="detalle-min"></p></div>
            <div class="detail-card"><h3>Humedad</h3><p class="detail-value" id="detalle-humedad"></p></div>
            <div class="detail-card"><h3>Viento</h3><p class="detail-value" id="detalle-viento"></p></div>
            <div class="detail-card"><h3>Amanecer</h3><p class="detail-value" id="sol-amanecer"></p></div>
            <div class="detail-card"><h3>Atardecer</h3><p class="detail-value" id="sol-atardecer"></p></div>
            <div class="detail-card"><h3>Latitud</h3><p class="detail-value" id="dato-latitud"></p></div>
            <div class="detail-card"><h3>Longitud</h3><p class="detail-value" id="dato-longitud"></p></div>
            <div class="detail-card"><h3>Zona horaria</h3><p class="detail-value" id="dato-zona"></p></div>
            <div class="detail-card"><h3>Hora local</h3><p class="detail-value" id="hora-local"></p></div>
            <div class="detail-card"><h3>Fecha local</h3><p class="detail-value" id="fecha-local"></p></div>
            <div class="detail-card"><h3>PM2.5</h3><p class="detail-value" id="pm25"></p></div>
            <div class="detail-card"><h3>PM10</h3><p class="detail-value" id="pm10"></p></div>
            <div class="detail-card"><h3>Ozono</h3><p class="detail-value" id="ozono"></p></div>
            <div class="detail-card"><h3>Índice UV</h3><p class="detail-value" id="uv"></p></div>
        </section>

        <section class="main-card">
            <h3>Información de Wikipedia</h3>
            <p id="wiki-resumen" style="margin-top:1rem;line-height:1.7"></p>
            <a id="wiki-link" href="#" target="_blank" rel="noopener" style="display:inline-block;margin-top:1rem;font-weight:700">
                Ver más en Wikipedia
            </a>
        </section>

        <section class="main-card">
            <h3>APIs utilizadas</h3>
            <p style="margin-top:1rem;line-height:1.7">
                API 1: Open-Meteo Weather para clima, ubicación, temperatura, humedad y viento. <br>
                API 2: Sunrise-Sunset para amanecer y atardecer. <br>
                API 3: Wikipedia para información descriptiva de la ciudad. <br>
                API 4: TimeAPI.io para mostrar la hora y fecha local de la ciudad. <br>
                API 5: Open-Meteo Air Quality para mostrar calidad del aire, PM2.5, PM10, ozono e índice UV.
            </p>
        </section>
    </article>
</main>

<footer class="footer">Open-Meteo Weather · Sunrise-Sunset · Wikipedia · TimeAPI.io · Open-Meteo Air Quality</footer>
</body>
</html>
