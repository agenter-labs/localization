<?php

$row = 0;
$config = [];
if (($handle = fopen($argv[1], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $row++;
        
        if ($row == 1) {
            continue;
        }

        $config[$data[0]] = [
            'code3' => $data[1],
            'ccc' => $data[2],
            'name' => $data[3],
            'currency' => $data[4]
        ];
    }
    fclose($handle);
}

$a = var_export($config, true);

file_put_contents(__DIR__ . '/../config/country.php', "<?php \n return $a ;");