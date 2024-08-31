<?php
require('View.php');
class WeatherView  extends View
{
    public function printFullHTML()
    {
        $content = $this->getHead();
        $content .= parent::getPageHeader("");
        $content .= $this->getMain();

        $content .= '</html>';
        echo $content;
    }

    private function getHead()
    {
        return '<html lang="es">
                <head>
                    <meta charset="utf-8">
                    <title>myWeather</title>
                    <link rel="stylesheet" href="../../css/weather.css" />
                    <link rel="stylesheet" href="../../css/styles.css" />
                </head>';
    }
    private function getMain()
    {
        return '<body>
            <div class="weather-container">
                <h1>Tiempo para hoy</h1>
                <div class="search-bar">
                    <input alt="Introduce nombre de ciudad" type="text" 
                    class="city-name-search" placeholder="Introduce el nombre de la ciudad">
                    <div class = "search-submit-container">
                        <button class="search-submit-button" alt="Buscar" type="submit" onclick="showsResult()">
                        <img class="search-submit-button-image" src = "../../../resources/lupablanca.svg">
                        <span class="search-submit-button-span"></span>
                        </button>
                    </div>
                </div>      
                <div class="searched-weather-container" id="id_card" style="display:none">
                    <h1 class="searched-weather-header"></h1>
                    <img class = "searched-weather-image">
                    <p class = "searched-weather-text" id="temp" class="text-body"></p>
                    <p class = "searched-weather-text" id="desc" class="text-body"></p>
                </div>
            </div>
            <script type="text/javascript" src="../../js/weather.js"></script>
        </body>';
    }
}
