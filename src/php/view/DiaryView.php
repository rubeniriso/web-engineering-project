<?php
require('View.php');

class DiaryView extends View
{
    private $eventsList; //Todas mis vistas van a tener un menú
    public function __construct($eventsList)
    {
        $this->eventsList = $eventsList;
    }
    public function printFullHTML()
    {
        $content = $this->getHead();
        $content .= $this->getPageHeader($this->getAddEventButton());
        $content .= $this->getMain();
        $content .= '</html>';
        echo $content;
    }
    private function getAddEventButton()
    {
        $html = '<div class="generic-add-button-container">
        <input name = "Añadir un evento" class="generic-add-button" id = "addevent" alt="Añadir un evento" type = "button"/>
        <label for="addevent">Añadir un evento</label>
            </div>';
        return $html;
    }
    private function getHead()
    {
        return '<html lang="es">
                  <head>
                    <title>myDiary</title>
                    <link rel="stylesheet" href="../../css/styles.css" />
                    <link rel="stylesheet" href="../../css/diary.css" />
                  </head>
                ';
    }
    private function getMain()
    {
        return '
            <body>
                ' . $this->getHiddenElements() . '
                <div class = "general-container">
                    <div class="event-container" class="split right">
                            ' . $this->getPrincipalMenu() . '
                    </div> 
                   ' . $this->getFilledGenericPopups() . '
                    ' . $this->getScripts() . '
                </div>
            </body>';
    }
    private function getPrincipalMenu()
    {
        $menu = '<ul class= "event-list">';
        foreach ($this->eventsList as $element) {
            $menu .=
                '<li class="event-list-element">
                <div class="event-list-element-container">
                    
                    <button name="Desplegar evento" class="event-list-element-button" id="btn' . $element->event_id . '">
                        <span class="event-list-element-button-priority-background" id="' . $element->priority . '">&nbsp;</span> 
                        <p class ="event-list-element-button-text">' . $element->date . '  -  ' . $element->title . '</p>
                        
                    </button>
                    <a  class="event-list-element-button-delete-button" id = "' . $element->event_id . '">
                        <img alt="Eliminar evento" class="event-list-element-button-delete-button-image" src="../../../resources/cross4.svg">
                    </a>
                
                    <div class="event-list-element-text-container" id="card' . $element->event_id . '" >
                        <p class = "event-list-element-text">
                            ' . $element->description . '    
                        </p>
                    </div>     
                </div>           
            </li>';
        }
        $menu .= "</ul>";
        return $menu;
    }

    private function getFilledGenericPopups()
    {
        $addEventPopup = $this->getGenericPopup("add-event");

        $addEventPopupGuts = '
        <div class="generic-popup-guts">
            <form class="form-add-event" id="form-add-event" action="../controller/eventAddController.php" method="post">

                <input type="text" class="form-add-event-input-title" name="title" placeholder="Título">

                <textarea form="form-add-event" class="form-add-event-input-description" name="description" placeholder="Descripción"></textarea>

                <input type="date" class="form-add-event-input-date" name="date" placeholder="Date">
                <div class="form-select-priority-container">
                    <p class="form-select-priority-text">Prioridad </p>
                    <select alt="Prioridad" class="form-select-priority" name="priority" placeholder="Prioridad">
                        <option value="1">Alta</option>            
                        <option value="2">Media</option>
                        <option value="3">Baja</option>
                    </select>
                </div>
                <input class="form-add-event-submit-button" type="submit" value="Añadir">
            </form>
        </div>
        ';

        $addEventPopup = str_replace("##genericPopupHeader##", "Añadir evento", $addEventPopup);
        $addEventPopup = str_replace("##genericPopupGuts##", $addEventPopupGuts, $addEventPopup);

        return $addEventPopup;
    }
    private function getScripts()
    {
        return '
            <script type="text/javascript" src = "../../js/diary.js"></script>
        ';
    }
}
