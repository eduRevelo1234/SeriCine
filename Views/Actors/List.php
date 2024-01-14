<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/ActorController.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');
?>

<!-- Contenido -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center">
            <h1>LISTADO DE ACTORES</h1>
            <p>Se podra crear, actualizar o borrar/suspender un actor</p>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success" href="View.php">
                    <i class="bi bi-file-earmark-plus"></i>
                    Nuevo registro
                </a>
            </div>
            <?php
            $actorList = listActors();
            if (count($actorList) > 0) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre y Apellido</th>
                            <th>Codigo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($actorList as $actor) {
                            $status = $actor->getStatus();  
                        ?>
                            <tr>
                                <td><?php echo $actor->getId(); ?> </td>
                                <?php
                                    $personList = listPerson($actor->getIdperson());
                                ?>   
                                <td><?php if(isset($personList)) echo $personList['name']." ".$personList['lastname']; ?></td>
                                <td><?php echo $actor->getCode(); ?> </td>
                                <td><?php echo $status; ?> </td>
                                <td>
                                    <?php 
                                        if($status == 'Activa')
                                        {
                                    ?>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="View.php?id=<?php echo $actor->getId(); ?>">
                                                    Editar
                                                </a>
                                                &nbsp;&nbsp;
                                                <a class="btn btn-danger" href="Activate.php?id=<?php echo $actor->getId(); ?>">
                                                    Desactivar
                                                </a>
                                            </div>    
                                    <?php 
                                        } else
                                        {     
                                    ?>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="View.php?id=<?php echo $actor->getId(); ?>">
                                                    Editar
                                                </a>
                                                &nbsp;&nbsp;
                                                <a class="btn btn-success" href="Activate.php?id=<?php echo $actor->getId(); ?>">
                                                    Activar
                                                </a>
                                            </div>
                                    <?php 
                                        }     
                                    ?>        
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <div class="alert alert-danger" role="alert">
                    No existen registros
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Fin Contenido -->

<?php
    
    include_once(__DIR__ . '/../Templates/Footer.php');
?>