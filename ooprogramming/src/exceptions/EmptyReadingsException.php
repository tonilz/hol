<?php

namespace App\Exceptions;

class EmptyReadingsException extends \Exception {

    const EMPTY_READINGS = 'No readings available.';
}