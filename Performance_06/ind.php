<?php

$books = [
    "Auntu" => 24,
    "Raihyan" => 30,
    "Erfan"  => 12
];

function gcd($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

$authors = array_keys($books);
$gcdPairs = [];

for ($i = 0; $i < count($authors); $i++) {
    for ($j = $i + 1; $j < count($authors); $j++) {
        $author1 = $authors[$i];
        $author2 = $authors[$j];
        $gcdVal = gcd($books[$author1], $books[$author2]);

        $gcdPairs[] = [
            'authors' => [$author1, $author2],
            'gcd'     => $gcdVal
        ];
    }
}

$allGcdValues = array_column($gcdPairs, 'gcd');
$uniqueGcds = array_unique($allGcdValues);
rsort($uniqueGcds);

if (count($uniqueGcds) >= 2) {
    $secondLargestGcd = $uniqueGcds[1];

    foreach ($gcdPairs as $pair) {
        if ($pair['gcd'] === $secondLargestGcd) {
            echo "2nd Largest GCD: {$pair['gcd']} between authors: " .
                implode(" and ", $pair['authors']) ;
            break;
        }
    }
} else {
    echo "Not enough unique GCDs to find the 2nd largest." ;
}

?>