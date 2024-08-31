<?php
include '../view/CalendarView.php';
include '../model/CalendarModel.php';

$date = $_GET['date'];
//verificar que los datos estan bien
if (empty($date)) {
	echo "ERROR, CAMPO VACÍO";
	//esto hay que mejorarlo: hacer un header a Exceptions/showError.php que cambie un texto de html en base al erro devuelto
} else {
	$eventsModule = new EventsListModule();
	$out = $eventsModule->getEventOnSpecificDay($date);
	return $out;
}
