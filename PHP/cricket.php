<?php
// Step 1: Create an array of Indian cricket players
$players = array("Sachin Tendulkar", "Rohit Sharma", "MS Dhoni", "Virat Kohili", "Sourav Ganguly", "Kapil Dev", "Yuvraj Singh", "Rahul Dravid");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Indian Cricket Players</title>
    <style>
        body { font-family: Arial, sans-serif; background-color:rgb(248, 229, 229); }
        .container { width: 50%; margin: 50px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px gray;background-color:rgb(248, 200, 200) }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid black; text-align: left; background-color:rgb(226, 145, 145); }
        
    </style>
</head>
<body>

<div class="container">
    <h2>Indian Cricket Players</h2>
    <table>
        <tr>
            <th>Sl. No.</th>
            <th>Player Name</th>
        </tr>
        
        <?php
        // Step 2: Use a loop to display players in a table
        $count = 1;
        foreach ($players as $player) {
            echo "<tr>";
            echo "<td>" . $count . "</td>";
            echo "<td>" . $player . "</td>";
            echo "</tr>";
            $count++;
        }
        ?>
        
    </table>
</div>

</body>
</html>
