<?php
$packages = [
    "A" => ["name" => "A",
        "dependencies" => ["B", "C"]],

    "B" => ["name" => "B",
        "dependencies" => []],

    "C" => ["name" => "C",
        "dependencies" => ["B", "D"]],

    "D" => ["name" => "D",
        "dependencies" => []]
];

function validatePackageDefinitions(array $packages): void
{
    global $sv;
    $sv = 0;
    foreach ($packages as $k => $v) {
        if ($v["name"] === $k) {
        } else {
            echo "Массив не соответсвует по 1 пункту: ключ массива не совпадает с именем указанным под ключем 'name'<br>";
        }

        if (isset($v["dependencies"])) {
        } else {
            echo "Массив не соответсвует по 2 пункту: не существует элемент с ключем 'dependencies'<br>";
            exit("");
        }

        foreach ($v["dependencies"] as $i) {
            if ($i == "A" or $i == "B" or $i == "C" or $i == "D" or empty($i)) {
            } else {
                echo "Массив не соответсвует по 3 пункту: в 'dependencies' указаны не только описанные зависимости<br>";
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

    if (in_array($packageName, $result)) {
        echo "Массив не соответсвует по 4 пункту: Есть циклические зависимости<br>";
    }
    return $result;
}


validatePackageDefinitions($packages);
getAllPackageDependencies($packages, "A");

