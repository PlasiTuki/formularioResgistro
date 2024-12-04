<?php

require_once 'config/database.php';


$sql = "SELECT * FROM registros ORDER BY fecha_registro DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro y Datos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0">Formulario de Registro</h1>
                    </div>
                    <div class="card-body">
                        <form id="registroForm" action="procesar_formulario.php" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre completo:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="edad" class="form-label">Edad:</label>
                                <input type="number" class="form-control" id="edad" name="edad" min="1" max="120" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="curso" class="form-label">Curso de interés:</label>
                                <select class="form-select" id="curso" name="curso" required>
                                    <option value="">Seleccione un curso</option>
                                    <option value="programacion">Programación</option>
                                    <option value="diseno">Diseño</option>
                                    <option value="marketing">Marketing Digital</option>
                                    <option value="idiomas">Idiomas</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label d-block">Género:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="masculino" name="genero" value="masculino" required>
                                    <label class="form-check-label" for="masculino">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="femenino" name="genero" value="femenino">
                                    <label class="form-check-label" for="femenino">Femenino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="otro" name="genero" value="otro">
                                    <label class="form-check-label" for="otro">Otro</label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label d-block">Áreas de interés:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tecnologia" name="intereses[]" value="tecnologia">
                                    <label class="form-check-label" for="tecnologia">Tecnología</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="arte" name="intereses[]" value="arte">
                                    <label class="form-check-label" for="arte">Arte</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="ciencia" name="intereses[]" value="ciencia">
                                    <label class="form-check-label" for="ciencia">Ciencia</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="deportes" name="intereses[]" value="deportes">
                                    <label class="form-check-label" for="deportes">Deportes</label>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h2 class="h4 mb-0">Registros Almacenados</h2>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Email</th>
                                        <th>Curso</th>
                                        <th>Género</th>
                                        <th>Intereses</th>
                                        <th>Fecha de Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["edad"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["curso"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["genero"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["intereses"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["fecha_registro"]) . "</td>";
                                            echo "<td><button class='btn btn-danger btn-sm delete-btn' data-id='" . $row["id"] . "'>Eliminar</button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'>No hay registros</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registroForm');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        const formData = new FormData(form);
        
        fetch('procesar_formulario.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire(
                    'Registro exitoso',
                    'El registro se ha guardado correctamente.',
                    'success'
                ).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire(
                    'Error',
                    'No se pudo registrar: ' + (data.error || 'Error desconocido'),
                    'error'
                );
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire(
                'Error',
                'Ocurrió un error al procesar la solicitud: ' + error.message,
                'error'
            );
        });
    });

    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esta acción",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('eliminar_registro.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'id=' + id
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Eliminado',
                                'El registro ha sido eliminado.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error',
                                'No se pudo eliminar el registro: ' + (data.error || 'Error desconocido'),
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error',
                            'Ocurrió un error al procesar la solicitud: ' + error.message,
                            'error'
                        );
                    });
                }
            });
        });
    });
});
</script>
</body>
</html>

<?php

$conn->close();
?>

