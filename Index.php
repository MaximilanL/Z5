<?php
$packages = [
    "A" => ["name" => "A",
        "dependencies" => ["B", "C"]],

    "B" => ["name" => "B",
        "dependencies" => []],

    "C" => ["name" => "C",
        "dependencies" => ["B", "D"]],

    "D" => ["name" => "D",
        "dependencies" => ["A"]]
];

function validatePackageDefinitions(array $packages): void
{

    foreach ($packages as $k => $v) {
        if ($v["name"] === $k) {
            echo "true<br>";
        } else {
            echo "false<br>";
        }

        if (isset($v["dependencies"])) {
            echo "true<br>";
        } else {
            echo "false<br>";
        }

        foreach ($v["dependencies"] as $i) {
            if ($i == "A" or $i == "B" or $i == "C" or $i == "D" or empty($i)) {
                echo "true<br>";
            } else {
                echo "false<br>";
            }
        }
    }


}

function getAllPackageDependencies(array $packages, string $packageName): array
{
    $zav = [];
    foreach ($packages as $x => $z) {
        if ($x === $packageName) {
            $zav += $z["dependencies"];
            continue;
        }

        if (in_array($zav[0], $z["dependencies"]) or in_array($zav[1], $z["dependencies"]) or in_array($packageName, $z["dependencies"])) {
            $zav = array_merge($zav, $z["dependencies"]);
        }


    }


    $result = array_values(array_unique($zav));
    print_r($result);


    if (in_array($packageName, $result)){
        echo 'Есть циклические зависимости';
    }
    return $result;
}

getAllPackageDependencies($packages, "A");
validatePackageDefinitions($packages);

