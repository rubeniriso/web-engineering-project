<?php
require('View.php');
class NotesView extends View
{
    private $notesItems; //Mi página de listas tendrá un conjunto de todas las notas que se hayan creado hasta el momento
    public function __construct($notesItems)
    {
        $this->notesItems = $notesItems;
    }
    public function printFullHTML()
    {
        $content = $this->getHead();
        $content .= $this->getPageHeader($this->getAddNoteButton());
        $content .= $this->getMain();
        $content .= "</html>";
        echo $content;
    }
    private function getHead()
    {
        return '
        <html lang="es">
        <head>
          <title>myNotes</title>
          <script src=../../js/notes.js></script>
          <link rel="stylesheet" type="text/css" href="../../css/styles.css" />
          <link rel="stylesheet" type="text/css" href="../../css/notes.css" />
        </head>';
    }
    private function getAddNoteButton()
    {
        $html = '<div class="generic-add-button-container">
        <input name = "Añadir una nota" class="generic-add-button" id = "addnote" alt="Añadir una nota" type = "button"/>
        <label for="addnote">Añadir una nota</label>
            </div>';
        return $html;
    }
    private function getMain()
    {
        return '
                  <body onload = runScript()>
                       '. $this->getPrincipalMenu() . '
                        ' . $this->addNotePopup() . '
                        ' . $this->getHiddenElements() . '
                  </body>
                ';
    }
    private function getPrincipalMenu()
    {
        $menu = '<ul class="notes-container">';
        foreach ($this->notesItems as $element) {
            $menu .=
                '<li class = "note" id = l' . $element->note_id . '>
                    <div class="note-header">
                        <span class = "note-title" id = "s' . $element->note_id . '"> ' . $element->title . '</span>
                        <script></script>
                        <a class = "note-delete" href="../controller/noteDeleteController.php?note_id=' . $element->note_id . '">
                            <img class="note-delete" alt="Borrar nota" src = "../../../resources/cross2.svg"/>
                        </a>
                    </div>
                    <div class="note-content">
                        <p class = "note-description">' . $element->description . '</p>
                    </div>
                </li>';
        }
        return $menu;
    }

    private function addNotePopup()
    {
        return
            '<div class="generic-popup" id="div-add-note-popup">
                <h1 class="add-note">AGREGAR NOTA</h1> 
                <div class="add-note-form-container">
                    <form class = "form-add-event" action="../controller/noteAddController.php" method="post" id="form-id">   
                    <div class="form-container-input">              
                        <label for="title" class="form-input-label">Título</label><br>
                        <input required class = "form-add-event-input-title" type="text" id="id_title" name="title"><br>
                    </div>
                    <div class= "form-container-input">
                        <label class="form-input-label" for="description">Descripción</label><br>
                        <textarea form="form-id" class="form-add-event-input-description" name="description"></textarea>
                    </div>
                        <input class="form-add-event-submit-button" type="submit" value="AGREGAR NOTA">
                    </form>
                </div>
            </div>
            ';
    }
}
