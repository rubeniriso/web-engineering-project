<?php
require('View.php');

class IndexView extends View
{
    private $indexItems; //Todas mis vistas van a tener un menú
    public function __construct($indexItems)
    {
        $this->indexItems = $indexItems;
    }
    public function printFullHTML()
    {
        $content = $this->getMain();

        echo $content;
    }
    private function getMain()
    { //Este html podría también ser recuperado de plantillas en fichero .html presentes en el sistema de ficheros...
        $htmlContents = file_get_contents('../../html/index.html');
        $htmlContents .= $this->getPageHeader("");
        $htmlContents = str_replace("##pageTitle##", 'myApp', $htmlContents);
        $htmlContents = str_replace("##pageHeaderMiddleContainer##", '', $htmlContents);
        $htmlContents = str_replace("##menuGetterFunction##", $this->getPrincipalMenu(), $htmlContents);
        return $htmlContents;
    }
    private function getPrincipalMenu()
    {
        $menu = '<ul class="index-item-list">';

        foreach ($this->indexItems as $element) {
            //Añadir imagenes y otra info necesaria
            $menu .= '<li class = "index-item">
                        <div class = "index-item-container">
                            <a class="index-item" id="item' . $element->id . ' "href="' . $element->link . '"
                            >
                                <img class = "index-item" src = "../../../resources/' . $element->imageLink . '" alt = "' . $element->altText . '"/>
                            </a>
                            <div class = "index-item-h2-container">
                                <h2 class = "index-item-name">' . $element->title . '</h2>
                            </div>
                        </div>
                    </li>';
        }
        $menu .= "</ul>";
        return $menu;
    }
}
