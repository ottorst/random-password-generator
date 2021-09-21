<?php

$password = "";
$charCount = readline("How many characters should the password be : ");
$capitalChars = readline("How many capital characters : ");
$specialChars = readline("How many special characters : ");
$numericChars = readline("How many numeric characters : ");

function validateInput($input){
    $input == '0'? $input = -1 : $input = intval($input); 

    if($input == 0){
        echo 'ERROR: input error, all entries must be numbers.';
        die();
    }
    return $input;
}

$charCount = validateInput($charCount);
$capitalChars = validateInput($capitalChars);
$specialChars = validateInput($specialChars);
$numericChars = validateInput($numericChars);

if($charCount < ($specialChars + $capitalChars + $numericChars)){
    echo 'ERROR: input error, the sum of all the types of characters, must be less than the total character count';
    die();
}

function generatePassword($chars, $charType){
    $password = "";
    $charList = array(
        'regular'=>array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"),
        'capital' =>array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"),
        'numeric' => array('1','2','3','4','5','6','7','8'.'9'.'0'),
        'special' => array("!", "?", ".")
    );
    
    $randomNumbers = array_rand($charList[$charType], $chars);
    if(gettype($randomNumbers) == 'array'){
    foreach ($randomNumbers as $randomNumber => $value) {
    $password .= $charList[$charType][$value];
    }
    }
    else{
        $password .= $charList[$charType][$randomNumbers];
    }
    return $password;
}
if($capitalChars > 0)
    $password .= generatePassword($capitalChars, 'capital', $password);

if($specialChars > 0)
    $password .= generatePassword($specialChars, 'special', $password);

if($numericChars > 0)
    $password .= generatePassword($numericChars, 'numeric', $password);
$regularChars = $charCount - ($specialChars + $capitalChars + $numericChars);
if($regularChars > 0)
    $password .= generatePassword($regularChars, 'regular', $password);

$password = str_shuffle($password);
echo 'Your password is : '. $password;