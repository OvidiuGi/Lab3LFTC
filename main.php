<?php

$inputFile = fopen('file.csv','r');
$statesFile  = fopen('states.csv','w');
$transitionsFile = fopen('transitions.csv','w');
$alphabetFile = fopen('alphabet.csv', 'w');

$states = [];
$alphabet = [];
$states[] = explode(',', fgets($inputFile))[0]; //place the initial state in the array
$states[] = explode(',', fgets($inputFile))[0]; //place the final state in the array
while(!feof($inputFile)) { // while we are not at eof
    $line = trim(fgets($inputFile)); // read line by line, without white-spaces
    $words = explode(',', $line); //split into words

    if (!in_array($words[0],$states)) { //check if the state already exists in the state array
        $states[] = $words[0];
    }
    else if (!in_array($words[2],$states)) { //check if the state already exists in the state array
        $states[] = $words[2];
    }
    if(!in_array($words[1], $alphabet)) { ////check if the state already exists in the alphabet array
        $alphabet[] = $words[1];
    }

    fputcsv($transitionsFile,['( '. $words[0]. ','. $words[1]. ' ) '. ' => '.$words[2]]); //construct transitions file
}
fputcsv($alphabetFile, ['Regex: /[$]([a-zA-Z0-9])*^']);
fputcsv($alphabetFile,$alphabet); // construct alphabet file

fputcsv($statesFile, ['States: '. $states[0].' , '.$states[2]. ' , '. $states[1]]); // construct the states file
fputcsv($statesFile, ['Initial State: '. $states[0]]);
fputcsv($statesFile, ['Final State: '. $states[1]]);
