<?php
// Soy un page controller, para una página específica
include '../view/WeatherView.php';
// Voy a crear mediante la VISTA un objeto especifico para visualizar productos. Le voy a proporcionar la info que he solicitado al modelo
$view = new WeatherView();
// Le pido a este objeto de la vista que dibuje su contenido
$view->printFullHTML();
