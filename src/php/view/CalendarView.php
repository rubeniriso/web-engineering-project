<?php
require('View.php');
class CalendarView extends View
{
  private $eventsList; //Todas mis vistas van a tener un menú
  public function __construct($eventsList)
  {
    $this->eventsList = $eventsList;
  }
  public function printFullHTML()
  {
    $content = $this->getHead();
    $content .= $this->getPageHeader($this->getYearNavigationMenu());
    $content .= $this->getMain();
    $content .= "</html>";
    echo $content;
  }
  private function getHead()
  {
    return '<html lang="es">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <head>
              <meta charset="utf-8" />
              <title>myCalendar</title>
              <script type="text/javascript" src="../../js/calendar.js"></script> 

              <link rel="stylesheet" href="../../css/styles.css" />
              <link rel="stylesheet" href="../../css/calendar.css" />

            </head>
            ';
  }
  private function getYearNavigationMenu()
  {
    return ' <div class="button-year-button">
          <input
            type="button"
            class="yearChangeButton"
            id="backward"
            onclick="yearBack(document.querySelector(`p.current-year-text`).innerHTML)"
            alt="Adelantar un año"
          />
          <div class="current-year">
            <h2 class="current-year-header">Año actual:</h2>
            <p class="current-year-text">2022</p>
          </div>

          <input
            type="button"
            class="yearChangeButton"
            onclick="yearForward(document.querySelector(`p.current-year-text`).innerHTML)"
            id="forward"
            alt="Adelantar un año"
          />
        </div>';
  }

  private function getMain()
  {
    return '<body onload="startPage()">      
        <div class="background-opacity" hidden></div>

        <div class="select-events">
          <h1 class="select-events-date"></h1>
        </div>
        <input
          type="button"
          class="close-event-button"
          alt="Cerrar inspección del día"
          hidden
        />
      </body>
      ';
  }
}
