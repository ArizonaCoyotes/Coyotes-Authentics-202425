```php
<?php
$serverName = "your_server_name"; // e.g., "localhost"
$connectionOptions = array(
   "Database" => "your_database_name",
   "Uid" => "your_username",
   "PWD" => "your_password"
);
$conn = sqlsrv_connect($serverName, $connectionOptions);
if (!$conn) {
   die("Connection failed: " . sqlsrv_errors());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $query = $_POST["query"];
   $result = sqlsrv_query($conn, $query);
   if ($result === false) {
       die("Query failed: " . sqlsrv_errors());
   }
   echo "<table border='1'>";
   while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
       echo "<tr>";
       foreach ($row as $field) {
           echo "<td>" . $field . "</td>";
       }
       echo "</tr>";
   }
   echo "</table>";
   sqlsrv_free_stmt($result);
   sqlsrv_close($conn);
}
?>
<!DOCTYPE html>
<html>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<textarea name="query" rows="4" cols="50"></textarea><br>
<input type="submit" value="Submit">
</form>
</body>
</html>
