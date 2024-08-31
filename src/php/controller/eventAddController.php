<?php
	include '../model/DiaryModel.php';
	//coger los datos con post
	$title = $_POST['title'];
	$description = $_POST['description'];
	$date = $_POST['date'];
	$priority = $_POST['priority'];
	switch ($priority){
		case "Alta":
			$priority = "1";
			break;
		case "Media":
			$priority = "2";
			break;
		case "Baja":
			$priority = "3";
			break;
	}
	//Verificar que los datos estan bien
	if(empty($title) or empty($description) or empty($date) or empty($priority)){
		echo "ERROR, NO PUEDES DEJAR CAMPOS VACÍOS";
		//esto hay que mejorarlo: hacer un header a Exceptions/showError.php que cambie un texto de html en base al erro devuelto
	}
	else{ 
		$event = new AddEventsItem($title,$description,$date,$priority);
		$eventsItems = new EventsListModule();
		$eventsItems->addEvent($event);
		header('Location: DiaryController.php');
	}
	//llamas al modelo->funcion que añade nota pasandole como parametro el objeto NoteItem recien creado
