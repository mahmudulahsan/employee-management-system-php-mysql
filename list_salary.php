<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <?php
    $host = 'localhost';
    $username = 'root';
    $password = 'admin';
    $database = 'employee_db';
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete salary
    if (isset($_GET['delete_id'])) {
        $deleteId = $_GET['delete_id'];
        $sql = "DELETE FROM salary WHERE emp_no = '$deleteId'";
        if (mysqli_query($conn, $sql)) {
            echo "Salary record deleted successfully.";
            // Redirect to clear the query parameter
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error deleting salary record: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>

    <div class="p-24">
        <div>
            <a href="index.php" class="hover:underline italic">Back to Home</a>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Employee Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Basic Salary
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Allowance
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deduction
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Net Salary
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Salary Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $host = 'localhost';
                    $username = 'root';
                    $password = 'admin';
                    $database = 'employee_db';

                    $conn = mysqli_connect($host, $username, $password, $database);

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    // fetch data from salary table
                    $sql = "SELECT * FROM salary";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="px-6 py-4">' . $row["emp_no"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["basic"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["allowance"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["deduction"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["net_salary"] . '</td>';
                            echo '<td class="px-6 py-4">' . $row["salary_date"] . '</td>';
                            echo '<td class="px-6 py-4"><a href="?delete_id=' . $row["emp_no"] . '"> <span class="bg-red-500 p-1 text-white">Delete</span> </a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='7'>0 results</td></tr>";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>