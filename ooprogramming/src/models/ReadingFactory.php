<?php

namespace App\Models;

use App\Exceptions\FileNotFoundException;
use App\Exceptions\InvalidFileException;

class ReadingFactory {

    public static function create($file) {

        if (!file_exists($file)) {
            throw new FileNotFoundException(FileNotFoundException::FILE_NOT_FOUND."({$file})");
        }

        $fileExt = pathinfo($file, PATHINFO_EXTENSION);

        switch ($fileExt) {
            case 'csv':
                return new CSVReading($file);
                break;

            case 'xml':
                return new XMLReading($file);
                break;

            default:
                throw new InvalidFileException(InvalidFileException::INVALID_FILE."\n File types allowed: csv|xml");
        }
    }
}