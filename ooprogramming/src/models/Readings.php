<?php

namespace App\Models;

use App\Interfaces\ReadingInterface;
use App\Exceptions\EmptyReadingsException;

abstract class Readings implements ReadingInterface {

    const FRAUD_PCT = 0.5;

    private $file;
    protected $readings;

    public function __construct($file) {
        $this->file = $file;
        $this->parseFileAsReadings();
    }

    public function getFile() {
        return $this->file;
    }

    public function getReadings() {
        return $this->readings;
    }

    /**
     * Gets the median for and user and sets it in the same array of readings.
     *
     * @return bool
     * @throws EmptyReadingsException
     */
    protected function getMedian() {

        if (empty($this->readings)) {
            throw new EmptyReadingsException(EmptyReadingsException::EMPTY_READINGS);
        }

        foreach ($this->readings as $client => $clientReadings) {
            usort($clientReadings, function(ClientReading $first, ClientReading $second) {
                if ($first->getClientReading() === $second->getClientReading()) {
                    return 0;
                }

                return ($first->getClientReading() < $second->getClientReading()) ? 1 : -1;
            });

            $this->readings[$client]['median'] =  ($clientReadings[5]->getClientReading() + $clientReadings[6]->getClientReading()) / 2;

        }

        return true;
    }

    /**
     * Checks if there's ay fraud based on median and returns array with frauds
     *
     * @return array
     * @throws EmptyReadingsException
     */
    public function getPossibleFrauds() {

        if (empty($this->readings)) {
            throw new EmptyReadingsException(EmptyReadingsException::EMPTY_READINGS);
        }

        $frauds = array();

        foreach ($this->readings as $client => $clientReadings) {

            $minValue = $clientReadings['median'] * $this::FRAUD_PCT;
            $maxValue = $clientReadings['median'] * ( 1 + $this::FRAUD_PCT );
            foreach ($clientReadings as $key => $reading) {

                if ($key === 'median') {
                    continue;
                }

                if (($reading->getClientReading() >= $maxValue) || ($reading->getClientReading() <= $minValue)) {
                    $frauds[] = array(
                        'reading' => $reading,
                        'median' => $clientReadings['median']);
                }
            }
        }

        return $frauds;
    }

    abstract protected function parseFileAsReadings();
}