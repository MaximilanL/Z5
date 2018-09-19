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

function validatePackageDefinitions(array $packages):void{

    foreach ($packages as $k => $v) {
        if($v["name"]===$k){
            echo "true<br>";
        }
        else{
            echo "false<br>";
        }

        if(isset($v["dependencies"])){
            echo "true<br>";
        }
        else{
            echo "false<br>";
        }

        foreach ($v["dependencies"] as $i){
            if($i=="A" or $i=="B" or $i=="C" or $i=="D" or empty($i)){
                echo "true<br>";
            }
            else{
                echo "false<br>";
            }
        }
        }


};
validatePackageDefinitions($packages);

