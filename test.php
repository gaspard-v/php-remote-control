<?php

$oof = ["oui" => "loo"];
try {
    echo $oof["fefe"];
} catch (Error $e) {
    echo "kefke";
}

echo "oui";
