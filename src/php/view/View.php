<?php
class View
{
    protected function getPageHeader($middleContainer)
    {
        $htmlContents = file_get_contents('../../html/pageHeader.html');
        $htmlContents = str_replace("##pageHeaderMiddleContainer##", $middleContainer, $htmlContents);
        return $htmlContents;
    }
    protected function getHiddenElements()
    {
        $hiddenElements = file_get_contents('../../html/hidden.html');
        $hiddenElements = str_replace('##closeGenericPopupAltText##', 'Cerrar ver nota', $hiddenElements);
        return $hiddenElements;
    }
    protected function getGenericPopup($id)
    {
        $genericPopup = file_get_contents('../../html/genericPopup.html');
        $genericPopup = str_replace("##id##", "$id", $genericPopup);
        return $genericPopup;
    }
}
