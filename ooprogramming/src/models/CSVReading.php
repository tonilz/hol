<?php

namespace App\Models;

use App\Exceptions\CannotOpenFileException;
use App\Exceptions\EmptyReadingsException;

class CSVReading extends Readings {

    /**
     * Parses a CSV file as an array of ClientReading objects.
     *
     * @return bool
     * @throws CannotOpenFileException
     * @throws EmptyReadingsException
     */
    protected function parseFileAsReadings() {

        if (($handle = fopen($this->getFile(), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if (!is_numeric($data[2])) {
                    continue;
                }

                $this->readings[$data[0]][] = new ClientReading($data[0], $data[1], $data[2]);
            }
        }

        else {
            throw new CannotOpenFileException(CannotOpenFileException::CANNOT_OPEN_FILE);
        }

        fclose($handle);

        if (empty($this->readings)) {
            throw new EmptyReadingsException(EmptyReadingsException::EMPTY_READINGS);
        }

        $this->getMedian();

        return true;
    }
}