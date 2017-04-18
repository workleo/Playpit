<?php
/**
 * Class Individuum is a special class for a CSS animation
 */
class Individuum
{
    private $name;
    private $imageSource;
    private $skillCSSId;


    public function __construct($name, $imageSource, $skillID)
    {
        $this->name = $name;
        $this->imageSource = $imageSource;
        $this->skillCSSId = $skillID;
    }


    public function getImageSource()
    {
        return $this->imageSource;
    }


    public function setImageSource($imageSource)
    {
        $this->imageSource = $imageSource;
    }

    public function getSkillCSSId()
    {
        return $this->skillCSSId;
    }


    public function setSkillCSSId($skillCSSId)
    {
        $this->skillCSSId = $skillCSSId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


}