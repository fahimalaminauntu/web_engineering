<?php

$input = "This Is A demo Lab";
$vowels = ['a', 'e', 'i', 'o', 'u'];
$lower_input = strtolower($input);

$output = '';
$positions = [];

for ($i = 0; $i < strlen($lower_input); $i++) {
    $char = $lower_input[$i];
    if (in_array($char, $vowels)) {
        $output .= 'l';
        $positions[] = $i;
    } else {
        $output .= $char;
    }
}

echo "Original Text : \"$input\"<br><br>";
echo "Original Text Replaceing with L : \"$output\"<br>";
echo "Replaced positions : " . implode(', ', $positions) . "<br>";

?>
