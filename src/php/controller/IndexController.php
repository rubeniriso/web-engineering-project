<?php
// Soy un page controller, para una página específica
include '../view/IndexView.php';
include '../model/IndexModel.php';
$indexItems = new IndexItemsModule();
// Voy a crear mediante la VISTA un objeto especifico para visualizar productos. Le voy a proporcionar la info que he solicitado al modelo
$view = new IndexView($indexItems->getIndexItemsList());
// Le pido a este objeeto de la vista que dibuje su contenido
$view->printFullHTML();
