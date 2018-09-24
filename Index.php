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

    foreach ($packages as $package => $packageCharacteristics){
        if ($packageCharacteristics["name"] === $package) {
        } else {
            echo "The array does not match 1 point: the array key does not match the name specified under the 'name'<br>";
        }

        if (isset($packageCharacteristics["dependencies"])){
        } else {
            echo "The array does not correspond to 2 points: there is no element with the key 'dependencies'<br>";
            exit("");
        }

        foreach ($packageCharacteristics["dependencies"] as $dependence) {
            if ($dependence === "A" or $dependence === "B" or $dependence === "C" or $dependence === "D" or empty($dependence)){
            } else {
                echo "The array does not correspond to 3 points: in 'dependencies' there are specified not only the described dependencies<br>";
            }
        }
    }

    if ($GLOBALS['cyclicalDependencies']===true){
        echo "The array does not correspond to 4 points: There are cyclical dependencies<br>";
    }


}

function getAllPackageDependencies(array $packages, string $packageName): array
{
    global $cyclicalDependencies;
    $dependencies = [];
    foreach ($packages as $package => $packageCharacteristics){
        if ($package === $packageName){
            $dependencies += $packageCharacteristics["dependencies"];
            continue;
        }

        if (in_array($dependencies[0], $packageCharacteristics["dependencies"]) or in_array($dependencies[1], $packageCharacteristics["dependencies"]) or in_array($packageName, $packageCharacteristics["dependencies"])){
            $dependencies = array_merge($dependencies, $packageCharacteristics["dependencies"]);
        }
    }

    $result = array_values(array_unique($dependencies));

    if (in_array($packageName, $result)){
        $cyclicalDependencies=true;
    }

    return $result;
}


getAllPackageDependencies($packages, "A");
validatePackageDefinitions($packages);
