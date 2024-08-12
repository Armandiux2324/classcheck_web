<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/php/conn_db.php';
$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Error al conectarse a la DB: " . $conn->connect_error);
}

if(isset($_POST['submit'])){
    // Verificar si se ha enviado un archivo y si se seleccionó un maestro
    if (isset($_FILES['uploadPDF']) && isset($_POST['selectMaestro'])) {
        $maestroId = $_POST['selectMaestro'];
        $file = $_FILES['uploadPDF'];

        // Verificar si el archivo fue subido sin errores
        if ($file['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileSize = $file['size'];
            $fileType = $file['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Definir el nombre del archivo y la ubicación de destino
            $uploadFileDir = $_SERVER['DOCUMENT_ROOT'] . '/classcheck_github/archivos/horarios/';
            $dest_path = $uploadFileDir . $fileName;

            // Mover el archivo al directorio de destino
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Actualizar la ruta del archivo en la base de datos
                $updateQuery = "UPDATE maestro SET horario = ? WHERE id_maestro = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("si", $dest_path, $maestroId);

                if ($stmt->execute()) {
                    echo "<script>
                            alert('El horario se ha subido con éxito.');
                        </script>";
                } else {
                    echo "Error al actualizar el horario en la base de datos: " . $conn->error;
                }
            } else {
                echo "Error al mover el archivo al directorio de destino.";
            }
        } else {
            echo "Error al subir el archivo. Código de error: " . $file['error'];
        }
    } else {
        echo "No se ha enviado un archivo o no se ha seleccionado un maestro.";
    }
    $conn->close();
}

?>