<?php
include '../view/DiaryView.php';
include '../model/DiaryModel.php';
//coger el id del evento con get
$event_id = $_GET['event_id'];
$location = $_GET['location'];
echo $event_id;
//verificar que los datos estan bien
if (empty($event_id)) {
	echo "ERROR, CAMPO ID VACÍO";
	//esto hay que mejorarlo: hacer un header a Exceptions/showError.php que cambie un texto de html en base al erro devuelto
} else {
	$eventsItems = new EventsListModule();
	$eventsItems->deleteEvent($event_id);
	header('Location: ' . $location);
}


	//llamas al modelo->funcion que añade nota pasandole como parametro el objeto NoteItem recien creado
