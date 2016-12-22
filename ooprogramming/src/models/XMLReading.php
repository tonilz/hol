<?php

namespace App\Models;

use App\Exceptions\CannotOpenFileException;
use App\Exceptions\EmptyReadingsException;

class XMLReading extends Readings {

    /**
     * Parses a XML file as an array of ClientReading objects.
     *
     * @return bool
     * @throws CannotOpenFileException
     * @throws EmptyReadingsException
     */
    protected function parseFileAsReadings() {

        $xml = simplexml_load_file($this->getFile());

        if ($xml === false) {
            throw new CannotOpenFileException(CannotOpenFileException::CANNOT_OPEN_FILE);
        }

        foreach ($xml->reading as $row) {

            $data = array(
                'reading' => $row->__toString()
            );

            foreach ($row->attributes() as $name => $value) {
                if ($name === 'period') {
                    $data['period'] = $value->__toString();
                }

                if ($name === 'clientID') {
                    $data['id'] = $value->__toString();
                }
            }

            $this->readings[$data['id']][] = new ClientReading($data['id'], $data['period'], $data['reading']);
        }

        if (empty($this->readings)) {
            throw new EmptyReadingsException(EmptyReadingsException::EMPTY_READINGS);
        }

        $this->getMedian();

        true;
    }
}