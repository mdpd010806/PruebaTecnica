<?php include 'template/header.php'?>

<?php
    if(!isset($_GET['id'])){
        header('Location: index.php?mensaje=error');
    }

    include_once 'model/conexion.php';
    $id = $_GET['id'];
    $sentencia = $bd -> prepare("select * from cliente where id = ?;");
    $sentencia -> execute([$id]);
    $persona = $sentencia -> fetch(PDO::FETCH_OBJ);
    //print_r($persona);
?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso.php">
                    <div class="mb-3">
                        <label class="form-label">Cliente: </label>
                        <input type="text" class="form-control" name="txtCliente" autofocus require 
                        value="<?php echo $persona->nombre;?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ciudad: </label>
                        <select name="txtCiudad" class="form-select" aria-label="Default select example" require 
                        value="<?php echo $persona->ciudad;?>">
                            <option selected>Seleccionar Ciudad</option>
                            <option value="1">Barranquilla</option>
                            <option value="2">Bogota</option>
                            <option value="3">Bucaramanga</option>
                            <option value="4">Medellin</option>
                            <option value="5">Cali</option>
                            <option value="6">Cartagena</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de Negocio: </label>
                        <select name="txtNegocio" class="form-select" aria-label="Default select example" require>
                            <option selected>Seleccionar Tipo de Negocio</option>
                            <option value="1">Empresario individual</option>
                            <option value="2">Sociedad limitada</option>
                            <option value="3">Sociedad anónima</option>
                            <option value="4">Sociedad laboral</option>
                        </select>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id" value="<?php echo $persona->id;?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

<?php include 'template/footer.php'?>