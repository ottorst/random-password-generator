<?php
function validateInput($input)
{
	if (!is_numeric($input) || $input <= 0) {
		echo 'ERROR: input error, all entries must be numbers.';
		die();
	}
	return (int)$input;
}

function generatePassword($chars, $charType)
{
	$charList = [
		'capital' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		'special' => '!?.',
		'numeric' => '0123456789',
		'regular' => 'abcdefghijklmnopqrstuvwxyz',
	];

	$password = '';
	for ($i = 0; $i < $chars; $i++) {
		$randomIndex = rand(0, strlen($charList[$charType]) - 1);
		$password .= $charList[$charType][$randomIndex];
	}
	return $password;
}

$charCount = validateInput(readline("How many characters should the password be : "));
$capitalChars = validateInput(readline("How many capital characters : "));
$specialChars = validateInput(readline("How many special characters : "));
$numericChars = validateInput(readline("How many numeric characters : "));

if ($charCount < ($specialChars + $capitalChars + $numericChars)) {
	echo 'ERROR: input error, the sum of all the types of characters, must be less than the total character count';
	die();
}

$password = '';
for ($i = 0; $i < $charCount; $i++) {
	if ($capitalChars > 0) {
		$password .= generatePassword(1, 'capital');
		$capitalChars--;
	} elseif ($specialChars > 0) {
		$password .= generatePassword(1, 'special');
		$specialChars--;
	} elseif ($numericChars > 0) {
		$password .= generatePassword(1, 'numeric');
		$numericChars--;
	} else {
		$password .= generatePassword(1, 'regular');
	}
}

$password = str_shuffle($password);
echo 'Your password is : ' . $password;
