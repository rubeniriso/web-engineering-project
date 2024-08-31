<?php
include '../view/NotesView.php';
include '../model/NotesModel.php';
//coger el id de la nota con get
$note_id = $_GET['note_id'];
//verificar que los datos estan bien
if (empty($note_id)) {
	echo "ERROR, CAMPO ID VACÍO";
	//esto hay que mejorarlo: hacer un header a Exceptions/showError.php que cambie un texto de html en base al erro devuelto
} else {
	$notesItems = new NotesItemsModule();
	$notesItems->deleteNote($note_id);
	header('Location: NotesController.php');
}


	//llamas al modelo->funcion que añade nota pasandole como parametro el objeto NoteItem recien creado
