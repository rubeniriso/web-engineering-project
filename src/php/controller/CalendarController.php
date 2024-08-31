<?php
// Soy un page controller, para una página específica
include '../view/CalendarView.php';
include '../model/CalendarModel.php';
$eventsList = new EventsListModule();
// Voy a crear mediante la VISTA un objeto especifico para visualizar productos. Le voy a proporcionar la info que he solicitado al modelo
$view = new CalendarView($eventsList->getEventsList());
// Le pido a este objeeto de la vista que dibuje su contenido
$html = $view->printFullHTML();
echo $html;
