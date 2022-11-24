<?php

$inputFile = fopen('file.csv','r');
$statesFile  = fopen('states.csv','w');
$transitionsFile = fopen('transitions.csv','w');
$alphabetFile = fopen('alphabet.csv', 'w');

$states = [];
$alphabet = [];
$states[] = explode(',', fgets($inputFile))[0];
$states[] = explode(',', fgets($inputFile))[0];
while(!feof($inputFile)) {
    $line = trim(fgets($inputFile));
    $words = explode(',', $line);

    if (!in_array($words[0],$states)) {
        $states[] = $words[0];
    }
    else if (!in_array($words[2],$states)) {
        $states[] = $words[2];
    }
    if(!in_array($words[1], $alphabet)) {
        $alphabet[] = $words[1];
    }

    fputcsv($transitionsFile,['( '. $words[0]. ','. $words[1]. ' ) '. ' => '.$words[2]]);
}
fputcsv($alphabetFile, ['Regex: /[$]([a-zA-Z0-9])*^']);
fputcsv($alphabetFile,$alphabet);

fputcsv($statesFile, ['States: '. $states[0].' , '.$states[2]. ' , '. $states[1]]);
fputcsv($statesFile, ['Initial State: '. $states[0]]);
fputcsv($statesFile, ['Final State: '. $states[1]]);
