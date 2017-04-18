<?php

class Singer extends Individuum
{
    private $song;


    public function getSong()
    {
        return $this->song;
    }

    public function setSong($song)
    {
        $this->song = $song;
    }

    public function sing()
    {
        if ($this->song != null) {
            $audio =
                '<audio  autoplay="autoplay" loop="loop"  >' .  // autoplay="autoplay" loop="loop" controls="controls"
                '<source src = "' . $this->song . '"  type = "audio/ogg" /></audio>';//hidden = "hidden" LOOP="loop"
            echo $audio;

        }
    }
}