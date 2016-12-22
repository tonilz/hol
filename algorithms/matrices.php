<?php

// Around 4 mins while fixing a bug... doing max($matrix) instead max($row)...
function getMatrixMax($matrix)
{
    $maxRowNumbers = array();

    foreach ($matrix as $key => $row) {
        $maxRowNumbers[] = max($row);
    }

    return max($maxRowNumbers);
}

$matrixPositive = [
    [10, 100, 3],
    [12, 200, 154],
    [3, 30, 2],
];

$matrixMixed = [
    [-10, 100, 3],
    [12, -200, 154],
    [3, 30, -2],
];

$matrixNegative = [
    [-10, -100, -3],
    [-12, -200, -154],
    [-3, -30, -2],
];

echo getMatrixMax($matrixPositive).PHP_EOL; // Should return 200
echo getMatrixMax($matrixMixed).PHP_EOL; // Should return 154
echo getMatrixMax($matrixNegative).PHP_EOL; // Should return -2
