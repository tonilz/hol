Hi :D

To execute this app you just need to execute:

    composer install

To get all dependencies and the autoloader.

After that you need to execute:

    php index.php parse-reading FILE

Where FILE is you CSV or XML file (e.g: 2016-readings.xml)

For this test you should use:

    php index.php parse-reading 2016-readings.csv
    php index.php parse-reading 2016-readings.xml