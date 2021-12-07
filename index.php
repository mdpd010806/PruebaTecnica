<?php include 'template/header.php'?>

<?php
    include_once "model/conexion.php";
    $senetencia = $bd -> query("select c.id, c.nombre, u.nombre as ciudad, t.nombre as tipo_negocio from cliente c join ciudad u on c.ciudad = u.id join tiponegocios t on c.tipo_negocio = t.id");
    $persona = $senetencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($persona);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <!--inicio alerta-->
            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Rellena todos los campos.
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Registrado!</strong> Se agregaron los datos.
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Vuelve a intentar.
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Editado!</strong> Los datos fueron actualizados.
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Eliminado!</strong> Los datos fueron borrados.
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>
            
            <!--fin alerta-->
            <div class="card">
                <div class="card-header">
                    Lista de personas
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Tipo de Negocio</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                foreach($persona as $dato){
                            ?>

                            <tr>
                                <th scope="row"><?php echo $dato->id;?></th>
                                <th><?php echo $dato->nombre;?></th>
                                <th><?php echo $dato->ciudad;?></th>
                                <th><?php echo $dato->tipo_negocio;?></th>
                                <th><a class="text-success" href="editar.php?id=<?php echo $dato->id;?>"><i class="bi bi-pencil-square"></a></i></th>
                                <th><a onclick="return confirm('Estas seguro de eliminar?')" class="text-danger" href="eliminar.php?id=<?php echo $dato->id;?>"><i class="bi bi-trash"></i></a></i></th>
                            </tr>

                            <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos:
                </div>
                <form class="p-4" method="POST" action="registrar.php">
                    <div class="mb-3">
                        <label class="form-label">Cliente: </label>
                        <input type="text" class="form-control" name="txtCliente" autofocus require>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ciudad: </label>
                        <select name="txtCiudad" class="form-select" aria-label="Default select example" require>
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
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php'?>