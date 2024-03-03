<?php
function getStatus($user): string
{
    return match ($user->status) {
        "1" => "Pendiente",
        "2" => "Aceptado",
        "0" => "Rechazado",
        default => "Estado desconocido",
    };
}
?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <h1>Solicitudes de Trabajo</h1>
            <br>
            <?php
            $users = PersonData::getAll();
            if (count($users) > 0) {
                ?>
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered table-hover datatable">
                            <thead>
                            <th>ID</th>
                            <th>Nombre completo</th>
                            <th>Email</th>
                            <th>Vacante</th>
                            <th>Categoria</th>
                            <th>Lugar</th>
                            <th>Status</th>
                            <th>Creacion</th>
                            <th></th>
                            </thead>
                            <?php
                            foreach ($users as $user) {
                                $job = JobData::getById($user->job_id);
                                ?>
                                <tr>
                                    <td><?php echo $user->id ?></td>
                                    <td><?php echo $user->name . " " . $user->lastname; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $job->name; ?></td>
                                    <td><?php echo CategoryData::getById($job->category_id)->name; ?></td>
                                    <td><?php echo PlaceData::getById($job->place_id)->name; ?></td>
                                    <td><?php echo getStatus($user)?></td>
                                    <td><?php echo $user->created_at; ?></td>
                                    <td>
                                        <a
                                                href="index.php?action=download&file_id=<?php echo $user->file; ?>"
                                                class="btn btn-primary btn-xs"
                                                target="_blank"
                                        >
                                            Ver CV
                                        </a>
                                        </span>
                                        <?php if ($user->status == 1): ?>
                                            <a href="index.php?action=persons&opt=accept&id=<?php echo $user->id; ?>"
                                               class="btn btn-success btn-xs">Aceptar</a>
                                            <a href="index.php?action=persons&opt=denied&id=<?php echo $user->id; ?>"
                                               class="btn btn-warning btn-xs">Rechazar</a>
                                        <?php endif; ?>

                                        <a href="index.php?action=persons&opt=del&id=<?php echo $user->id; ?>"
                                           class="btn btn-danger btn-xs">Eliminar</a></td>
                                </tr>
                                <?php

                            }

                            ?>
                        </table>
                    </div>
                </div>
                <?php


            } else {
                echo "<p class='alert alert-danger'>No hay Solicitudes de Trabajo</p>";
            }


            ?>


        </div>
    </div>

</section>