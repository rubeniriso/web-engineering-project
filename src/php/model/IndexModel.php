<?php
class IndexModel
{
    public function __construct()
    {
        require_once '../database/DBConnectionSingleton.php';
    }
}
class IndexItem
{
    public $id;
    public $link;
    public $title;
    public $imageLink;
    public $altText;
    public function __construct($id, $link, $title, $imageLink, $altText)
    {
        $this->id = $id;
        $this->link = $link;
        $this->title = $title;
        $this->imageLink = $imageLink;
        $this->altText = $altText;
    }
}
class IndexItemsModule extends IndexModel
{
    public function getIndexItemsList()
    {
        // obtengo mi conexión singleton
        $conn = DBConnectionSingleton::getConn();
        // Inicializo mi lista de elementos del MenuPrincipal
        $indexItemList = array();
        // preparo la query 
        $query = "SELECT * FROM indexItemsModel ORDER BY id ASC";
        //lanzo la query y devuelvo su resultado
        if ($res = $conn->query($query)) {
            while ($row = $res->fetch_assoc()) {
                array_push($indexItemList, new IndexItem($row["id"], $row["link"], $row["title"], $row["imageLink"], $row["altText"]));
            }
            $res->free();
            return $indexItemList;
        } else {
            echo "Error al traer elementos de la base de datos.";
        }
    }
}
