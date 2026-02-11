<?php
$page_title = "Server Information";
include_once 'includes/header.php';
?>

<h1>Server Information</h1>
<p>This page displays all the server variables available in the $_SERVER superglobal array.</p>

<table border="1">
    <thead>
        <tr>
            <th>Variable Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through the $_SERVER array
        foreach ($_SERVER as $key => $value) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($key) . "</td>";
            
            // Handle array values (some $_SERVER values can be arrays)
            if (is_array($value)) {
                echo "<td>";
                foreach ($value as $subKey => $subValue) {
                    echo htmlspecialchars($subKey) . " => " . htmlspecialchars($subValue) . "<br>";
                }
                echo "</td>";
            } else {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
include_once 'footer.php';
?>