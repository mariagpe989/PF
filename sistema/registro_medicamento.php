<?php
include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['medicamento']) || empty($_POST['tipo'])  || empty($_POST['caducidad'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                        Todo los campos son obligatorios
                    </div>';
    } else {
        $medicamento = $_POST['medicamento'];
        $tipo = $_POST['tipo'];
        $caducidad = $_POST['caducidad'];
        $usuario_id = $_SESSION['idUser'];
        $query = mysqli_query($conexion, "SELECT * FROM medicamento where tipo = '$tipo'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        El Ruc ya esta registrado
                    </div>';
        }else{
        

        $query_insert = mysqli_query($conexion, "INSERT INTO medicamento(medicamento,tipo,caducidad,usuario_id) values ('$medicamento', '$tipo', '$caducidad','$usuario_id')");
        if ($query_insert) {
            $alert = '<div class="alert alert-primary" role="alert">
                        Medicamento Registrado
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                       Error al registrar medicamento
                    </div>';
        }
        }
    }
}
mysqli_close($conexion);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                Registro de Medicamento
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="nombre">Medicamento</label>
                        <input type="text" placeholder="Ingrese nombre del medicamento" name="medicamento" id="medicamento" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" placeholder="Ingrese tipo de medicamento" name="tipo" id="tipo" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="caducidad">Caducidad</label>
                        <input type="text" placeholder="Ingrese Caducidad" name="caducidad" id="caducidad" class="form-control">
                    </div>
                    <input type="submit" value="Guardar Medicamento" class="btn btn-primary">
                    <a href="lista_medicamento.php" class="btn btn-danger">Regresar</a>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>