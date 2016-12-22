<?php

namespace App\Models;

class ClientReading
{
    private $id;
    private $period;
    private $reading;

    public function __construct($id, $period, $reading)
    {
        $this->id = $id;
        $this->period = $period;
        $this->reading = $reading;
    }

    public function __toString()
    {
        return $this->id.' '.$this->period.' '.$this->reading;
    }

    public function getClientReading()
    {
        return $this->reading;
    }

    public function getId() {
        return $this->id;
    }

    public function getPeriod() {
        return $this->period;
    }
}