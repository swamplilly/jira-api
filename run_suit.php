<?php

if (count($argv) != 2)
{
    exit("ERROR: Please input tag.");
}

$tag = '"' . $argv[1] . '"';
$command = '~/behat/vendor/bin/behat --config ~/behat/behat.yml --out="log.txt" --no-colors --tags=' . $tag;

//print $command . "\n";

exec($command);

?>
