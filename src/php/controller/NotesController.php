<?php
// Soy un page controller, para una página específica
include '../view/NotesView.php';
include '../model/NotesModel.php';
$notesItems = new NotesItemsModule();
// Voy a crear mediante la VISTA un objeto especifico para visualizar productos. Le voy a proporcionar la info que he solicitado al modelo
$view = new NotesView($notesItems->getNotesItemsList());
// Le pido a este objeto de la vista que dibuje su contenido
$view->printFullHTML();
