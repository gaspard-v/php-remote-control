<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . "remote-control-server" . DIRECTORY_SEPARATOR . "autoloader.php");
$command = new Commands\LsCommand();
$result = $command->execute(["directory" => "."]);
print_r($result);
