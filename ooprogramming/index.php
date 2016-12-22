<?php

require_once('vendor/autoload.php');

use Symfony\Component\Console\Application;
use AppBundle\Command\ParseReadingCommand;

$application = new Application();

$application->add(new ParseReadingCommand());

$application->run();

// Write here your fraud detection Console application

// We are looking for things like:
//
//   - namespaces
//   - hexagonal architecture to handle different inputs (CSV and XML in this case, but it could be a database or even a txt file in a remote FTP! True story...)
//   - if you use a Console component, please add a composer.json file
//
// Bonus points if you use:
//
//   - PHP7 features
//   - unit tests for your domain models
//
// BTW, the expected output is....
//
// +---------------+---------+------------+---------+
// | Client        | Month   | Suspicious | Median  |
// +---------------+---------+------------+---------+
// | 583ef6329d7b9 | 2016-09 | 3564       | 42798.5 |
// | 583ef6329d89b | 2016-09 | 162078     | 59606.5 |
// | 583ef6329d89b | 2016-10 | 7759       | 59606.5 |
// | 583ef6329d916 | 2016-09 | 2479       | 40956   |
// | 583ef6329e237 | 2016-11 | 1379       | 30339   |
// | 583ef6329e271 | 2016-10 | 121208     | 21494.5 |
// | 583ef6329e3ab | 2016-11 | 6440       | 28092   |
// | 583ef6329e41b | 2016-05 | 133369     | 33226   |
// +---------------+---------+------------+---------+
//
