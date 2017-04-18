<?php

class Playpit
{

    private $_individuums;

    public function addIndividuum($individuum)
    {
        $this->_individuums[] = $individuum;
    }

    public function move_all()
    {
        $strResult = '';
        foreach ($this->_individuums as $_individuum) {
            /** @var  Individuum $_individuum */
            $_src = $_individuum->getImageSource();
            $_moveClass = $_individuum->getSkillCSSId();
            $_id=$_individuum->getName();
            if ($_moveClass==null) $_moveClass='noakt';

            $title='';
            if ($_individuum  instanceof Singer) {$title=" title=\"I can sing\nSelect some moving and press Start\" ";}

            if  ($_src != null) {
                $strOut = '<img id="'.$_id. '" alt="' .$_id. '" class="' . $_moveClass . '" src="' . $_src . '" '.$title.' >'."\n";
                $strResult.=$strOut;
            }
        }
    return $strResult;
    }
}