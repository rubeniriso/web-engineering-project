<?php
// Soy un page controller, para una página específica
include '../view/DiaryView.php';
include '../model/DiaryModel.php';
$eventsList = new EventsListModule();
// Voy a crear mediante la VISTA un objeto especifico para visualizar productos. Le voy a proporcionar la info que he solicitado al modelo
$view = new DiaryView($eventsList->getEventsList());
// Le pido a este objeeto de la vista que dibuje su contenido
$view->printFullHTML();
