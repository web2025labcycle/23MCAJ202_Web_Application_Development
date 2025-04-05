<?php
// Step 1: Define a list of student names
$namesList = ["Aisha", "Lego", "Lio", "Mark", "Kanmani", "Mialy"];

// Step 2: Display the original list
echo "<h2>Student Name List</h2>";
echo "<strong>Original Order:</strong><br>";
foreach ($namesList as $name) {
    echo "$name <br>";
}

// Step 3: Sort in alphabetical order (A-Z)
$sortedAsc = $namesList;  // Copy the array
sort($sortedAsc);  // Sort alphabetically
echo "<h3>Alphabetical Order (A-Z)</h3>";
foreach ($sortedAsc as $name) {
    echo "$name <br>";
}

// Step 4: Sort in reverse alphabetical order (Z-A)
$sortedDesc = $namesList;
rsort($sortedDesc);  // Sort in reverse
echo "<h3>Reverse Alphabetical Order (Z-A)</h3>";
foreach ($sortedDesc as $name) {
    echo "$name <br>";
}
?>
