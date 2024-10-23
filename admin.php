<?php
// Include database configuration
include 'config.php';

// Fetch all table names from the database
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}

// Store table names in an array
$tables = [];
while ($row = mysqli_fetch_array($result)) {
    $tables[] = $row[0]; // Assuming the table name is in the first column
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Admin Dashboard</h1>

        <!-- Loop through each table and display its data -->
        <?php foreach ($tables as $table): ?>
            <h2 class="mt-4">Data from table: <?php echo htmlspecialchars($table); ?></h2>

            <?php
            // Fetch all data from the current table
            $data_query = "SELECT * FROM `$table`";
            $data_result = mysqli_query($conn, $data_query);

            if (!$data_result) {
                echo "<p>Could not fetch data from $table: " . mysqli_error($conn) . "</p>";
                continue;
            }

            // Fetch table column names
            $column_query = "SHOW COLUMNS FROM `$table`";
            $column_result = mysqli_query($conn, $column_query);
            $columns = [];
            while ($column = mysqli_fetch_assoc($column_result)) {
                $columns[] = $column['Field'];
            }
            ?>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <?php foreach ($columns as $column): ?>
                            <th><?php echo htmlspecialchars($column); ?></th>
                        <?php endforeach; ?>
                        <?php if ($table === 'applications'): // Adjust the table name if needed ?>
                            <th>Actions</th> <!-- Column for actions -->
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($data_result)): ?>
                        <tr>
                            <?php foreach ($columns as $column): ?>
                                <td><?php echo htmlspecialchars($row[$column]); ?></td>
                            <?php endforeach; ?>

                            <?php if ($table === 'applications'): // Adjust the table name if needed ?>
                                <td>
                                    <a href="<?php echo htmlspecialchars($row['resume']); ?>" class="btn btn-success btn-sm" download>Download Resume</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
