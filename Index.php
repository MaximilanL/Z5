<?php
$packages = [
    "A"  => [ "name" => "A",
        "dependencies" => ["B", "C"]],

    "B"  => [ "name" => "B",
        "dependencies" => []],

    "C"  => [ "name" => "C",
        "dependencies" => ["B", "D"]],

    "D"  => [ "name" => "D",
        "dependencies" => []]
];

print_r($packages) ;