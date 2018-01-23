<?php
// Database connect file
include 'connect.php';

$fileName = 'DBBackup/restore' . date('d-m-y-H:m:s') . '.sql';
$databaseName = 'NAME';

try {
    $query = exec("mysqldump -u $username -p $password -h $hostname $databaseName > $fileName");
    $stmt = $pdo->prepare($query);
    $stmt->execute();
} catch(PDOException $e) {
    echo $e->getMessage;
}

