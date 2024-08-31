<?php
include '../view/NotesView.php';
include '../model/NotesModel.php';
//coger los datos con post
$title = $_POST['title'];
$description = $_POST['description'];
//verificar que los datos estan bien
if (empty($title) or empty($description)) {
	echo "ERROR, NO PUEDES DEJAR CAMPOS VACÍOS";
	//esto hay que mejorarlo: hacer un header a Exceptions/showError.php que cambie un texto de html en base al erro devuelto
} else {
	$note = new AddNotesItem($title, $description);
	$notesItems = new NotesItemsModule();
	$notesItems->addNoteItem($note);
	header('Location: NotesController.php');
}


	//llamas al modelo->funcion que añade nota pasandole como parametro el objeto NoteItem recien creado
