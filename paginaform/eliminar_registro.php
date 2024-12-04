<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'config/database.php';


if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);

   
    $sql = "DELETE FROM registros WHERE id = ?";
    
  
    if ($stmt = $conn->prepare($sql)) {
       
        $stmt->bind_param("i", $id);
        
        
        if ($stmt->execute()) {
          
            echo json_encode(['success' => true]);
        } else {
           
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        
        $stmt->close();
    } else {
       
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
   
    echo json_encode(['success' => false, 'error' => 'ID no válido']);
}


$conn->close();
?>

