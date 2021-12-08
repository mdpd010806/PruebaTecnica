<?php include 'template/header.php'?>

<?php
    include_once "model/conexion.php";
    $senetencia = $bd -> query("select c.id, c.nombre, u.nombre as ciudad, t.nombre as tipo_negocio, ca2.valor_total from cliente c join ciudad u on c.ciudad = u.id join tiponegocios t on c.tipo_negocio = t.id left join (select avg(cu.valor_total) as valor_total, ca.cliente from pedidoscabecera ca join pedidoscuerpo cu on ca.valor_total = cu.id GROUP by ca.cliente) ca2 on c.id = ca2.cliente order by c.id");
    $persona = $senetencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($persona);
?>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7 mb-5">
            <!--inicio alerta-->
            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Rellena todos los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Registrado!</strong> Se agregaron los datos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Vuelve a intentar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Editado!</strong> Los datos fueron actualizados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Eliminado!</strong> Los datos fueron borrados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'pedidoRegistrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Felicidades!</strong> Has agregado un nuevo pedido.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            <?php
                }
            ?>
            
            <!--fin alerta-->
            <div class="card border border-secondary">
                <div class="card-header bg-secondary bg-gradient text-light">
                    Lista de clientes
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Tipo de Negocio</th>
                                <th scope="col">Promedio de pedidos</th>
                                <th scope="col" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $numero = 0;
                                foreach($persona as $dato){
                                $numero ++;
                            ?>

                            <tr>
                                <th scope="row"><?php echo $numero;?></th>
                                <td><?php echo $dato->nombre;?></td>
                                <td><?php echo $dato->ciudad;?></td>
                                <td><?php echo $dato->tipo_negocio;?></td>
                                <td><?php if($dato->valor_total != null){ echo "$".$dato->valor_total;}else{echo "$0";} ?></td>
                                <td><a class="text-success" href="clientes/editar.php?id=<?php echo $dato->id;?>"><i class="bi bi-pencil-square"></a></i></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar?')" class="text-danger" href="clientes/eliminar.php?id=<?php echo $dato->id;?>"><i class="bi bi-trash"></i></a></i></td>
                                <td><a class="text-success" href="pedidos/pedido.php?id=<?php echo $dato->id;?>&nombre=<?php echo $dato->nombre;?>"><i class="bi bi-bag-plus-fill"></a></i></td>
                            </tr>

                            <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card border border-secondary">
                <div class="card-header bg-secondary bg-gradient text-light">
                    Ingresar datos
                </div>
                <form class="p-4" method="POST" action="clientes/registrar.php">
                    <div class="mb-3">
                        <label class="form-label">Cliente: </label>
                        <input type="text" class="form-control" name="txtCliente" autofocus require>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ciudad: </label>
                        <select name="txtCiudad" class="form-select" aria-label="Default select example" require>
                            <option value="" selected>Seleccionar Ciudad</option>
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
                            <option value="" selected>Seleccionar Tipo de Negocio</option>
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