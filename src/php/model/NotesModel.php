<?php
class NotesModel
{
    public function __construct()
    {
        require_once '../database/DBConnectionSingleton.php';
    }
}
class NotesItem
{
    public $note_id;
    public $title;
    public $description;
    public function __construct($note_id, $title, $description)
    {
        $this->note_id = $note_id;
        $this->title = $title;
        $this->description = $description;
    }
}
class AddNotesItem
{
    public $note_id;
    public $title;
    public $description;

    public function __construct($title, $description) //esta alternativa es necesaria para instanciar objetos sin meterle el id y que se cree con el A_I
    {
        $this->title = $title;
        $this->description = $description;
    }
}
class NotesItemsModule extends NotesModel
{
    public function getNotesItemsList()
    {
        // obtengo mi conexión singleton
        $conn = DBConnectionSingleton::getConn();
        // Inicializo mi lista de elementos del MenuPrincipal
        $notesItemList = array();
        // preparo la query 
        $query = "SELECT * FROM notes ORDER BY note_id ASC";
        //lanzo la query y devuelvo su resultado
        if ($res = $conn->query($query)) {
            while ($row = $res->fetch_assoc()) {
                array_push($notesItemList, new NotesItem($row["note_id"], $row["title"], $row["description"]));
            }
            $res->free();
            return $notesItemList;
        } else {
            echo "algo ha ido mal";
        }
    }

    public function addNoteItem(AddNotesItem $note)
    {
        // obtengo mi conexión singleton
        $conn = DBConnectionSingleton::getConn();
        //obtengo los parámetros del objeto necesarios para la query
        $title = $note->title;
        $description = $note->description;
        // preparo la query 
        $query = "INSERT INTO notes(title,description) values ('$title', '$description')";
        //lanzo la query y devuelvo su resultado
        if ($res = $conn->query($query)) {
            echo "Nota añadida correctamente";
        } else {
            echo "No se ha podido añadir la nota";
        }
    }

    public function deleteNote($note_id)
    {
        // obtengo mi conexión singleton
        $conn = DBConnectionSingleton::getConn();
        // preparo la query 
        $query = "DELETE FROM notes WHERE note_id=$note_id";
        //lanzo la query y devuelvo su resultado
        if ($res = $conn->query($query)) {
            echo "Nota borrada correctamente";
        } else {
            echo "No se ha podido eliminar la nota";
        }
    }
}
