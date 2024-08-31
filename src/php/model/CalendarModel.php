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

    
}
