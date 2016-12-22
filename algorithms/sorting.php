<?php

class ClientReading
{
    private $id;
    private $reading;

    public function __construct($id, $reading)
    {
        $this->id = $id;
        $this->reading = $reading;
    }

    public function __toString()
    {
        return $this->id.' '.$this->reading;
    }

    public function getClientReading()
    {
        return $this->reading;
    }
}

$clients = [
    new ClientReading(uniqid(), 2000),
    new ClientReading(uniqid(), 1000),
    new ClientReading(uniqid(), 300),
    new ClientReading(uniqid(), 500),
    new ClientReading(uniqid(), 50),
    new ClientReading(uniqid(), 3000),
    new ClientReading(uniqid(), 1000),
];

// Sorting function: 3 min.
usort($clients, function(ClientReading $first, ClientReading $second) {
    if ($first->getClientReading() === $second->getClientReading()) {
        return 0;
    }

    return ($first->getClientReading() < $second->getClientReading()) ? 1 : -1;
});

print_r($clients);
