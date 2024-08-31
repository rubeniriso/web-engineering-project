<?php

include '../database/DBConnectionSingleton.php';

class Event
{
    public $event_id;
    public $date;
    public $title;
    public $description;
    public $priority;
    public function __construct($event_id, $date, $title, $description, $priority)
    {
        $this->event_id = $event_id;
        $this->date = $date;
        $this->title = $title;
        $this->description = $description;
        $this->priority = $priority;
        require_once '../database/DBConnectionSingleton.php';
    }
}
class AddEventsItem
{
    public $event_id;
    public $date;
    public $title;
    public $description;
    public $priority;

    public function __construct($title, $description, $date, $priority) //esta alternativa es necesaria para instanciar objetos sin meterle el id y que se cree con el A_I
    {
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
        $this->priority = $priority;
    }
}
class EventsListModule
{
    public function getEventsList()
    {
        // obtengo mi conexión singleton
        $conn = DBConnectionSingleton::getConn();
        // Inicializo mi lista de elementos del MenuPrincipal
        $eventsList = array();
        // preparo la query 
        $query = "SELECT * FROM calendar";
        //lanzo la query y devuelvo su resultado
        if ($res = $conn->query($query)) {
            while ($row = $res->fetch_assoc()) {
                array_push($eventsList, new Event($row["event_id"], $row["date"], $row["title"], $row["description"], $row["priority"]));
            }
            $res->free();
            return $eventsList;
        } else {
            echo "La consulta fué mal";
        }
    }

    public function getEventOnSpecificDay($date)
    {
        // obtengo mi conexión singleton
        $conn = DBConnectionSingleton::getConn();
        $data = array();

        // preparo la query 
        $query = "SELECT * from calendar where `date` ='$date'";

        if ($res = $conn->query($query)) {
            while ($row = $res->fetch_assoc()) {
                $event = array(
                    'event_id' => $row["event_id"],
                    'title' => $row["title"],
                    'description' => $row["description"],
                    'priority' => $row["priority"]
                );
                $eventsOnThatDay[] = $event;
            }
            echo json_encode($eventsOnThatDay);
            $res->free();
        } else {
            echo "La consulta fué mal";
        }
    }

    public function addEvent(AddEventsItem $event)
    {
        // obtengo mi conexión singleton
        $conn = DBConnectionSingleton::getConn();
        //obtengo los parámetros del objeto necesarios para la query
        $title = $event->title;
        $description = $event->description;
        $date = $event->date;
        $priority = $event->priority;
        // preparo la query 
        $query = "INSERT INTO calendar(title,description,date,priority) values ('$title', '$description','$date','$priority')";
        //lanzo la query y devuelvo su resultado
        if ($res = $conn->query($query)) {
            echo "Event created correctly";
        } else {
            echo "Event could not be created";
        }
    }

    public function deleteEvent($event_id)
    {
        // obtengo mi conexión singleton
        $conn = DBConnectionSingleton::getConn();
        // preparo la query 
        $query = "DELETE FROM calendar WHERE event_id=$event_id";
        //lanzo la query y devuelvo su resultado
        if ($res = $conn->query($query)) {
            echo "Event correctly deleted";
        } else {
            echo "Error while deleting event";
        }
    }
}
