<?php

// This is just a dummy PHP file to show how we generated the csv and xml file!
// This might help with csv and xml parsing as it is the opposite exercise!

$fd = fopen('2016-readings.csv', 'w');
fputcsv($fd, ["client", "period", "reading"]);
for ($i = 0; $i < 10; $i++) {
	$clientID = uniqid();
	$median = rand(10000, 30000);

    for ($j = 0; $j < 12; $j++) {
        $period = "2016-" . str_pad($j + 1, 2, '0', STR_PAD_LEFT);
        $reading = $median + rand($median * 0.9, $median * 1.1);

        fputcsv($fd, [$clientID, $period, $reading]);
    }
}

fclose($fd);

$xml = new SimpleXMLElement("<readings></readings>");

for ($i = 0; $i < 10; $i++) {
	$clientID = uniqid();
	$median = rand(10000, 30000);

    for ($j = 0; $j < 12; $j++) {
        $period = "2016-" . str_pad($j + 1, 2, '0', STR_PAD_LEFT);
        $reading = $median + rand($median * 0.9, $median * 1.1);

        $r = $xml->addChild('reading', $reading);
		$r->addAttribute('clientID', $clientID);
		$r->addAttribute('period', $period);
    }
}

header('Content-type: text/xml');
$xml->asXML('2016-readings.xml');