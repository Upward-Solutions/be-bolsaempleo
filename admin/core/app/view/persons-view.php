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
            // Obtener todos los trabajos para el dropdown
            $jobs = JobData::getAll();
            
            // Configuración de paginación
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $limit = 20; // Número de solicitudes por página
            
            // Verificar si se está filtrando por trabajo
            $job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;
            
            // Obtener el total de registros para calcular el número de páginas
            if ($job_id > 0) {
                $total = PersonData::countByJobId($job_id);
                $job_name = JobData::getById($job_id)->name;
            } else {
                $total = PersonData::countAll();
                $job_name = "";
            }
            $total_pages = ceil($total / $limit);
            
            // Asegurar que la página actual es válida
            if ($page < 1) $page = 1;
            if ($page > $total_pages && $total_pages > 0) $page = $total_pages;
            
            // Obtener los registros de la página actual
            if ($job_id > 0) {
                $users = PersonData::getByJobId($job_id, $page, $limit);
            } else {
                $users = PersonData::getAllPaginated($page, $limit);
            }
            if (count($users) > 0) {
                ?>
                <!-- Formulario de filtrado por vacante -->
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-6">
                        <form action="index.php" method="get" class="form-inline">
                            <input type="hidden" name="view" value="persons">
                            <div class="form-group" style="margin-right: 10px;">
                                <label for="job_id" style="margin-right: 10px;">Filtrar por vacante:</label>
                                <select name="job_id" id="job_id" class="form-control">
                                    <option value="0">Todas las vacantes</option>
                                    <?php foreach ($jobs as $job): ?>
                                        <option value="<?php echo $job->id; ?>" <?php if($job_id == $job->id) echo "selected"; ?>>
                                            <?php echo $job->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-filter"></i> Filtrar
                            </button>
                            <?php if($job_id > 0): ?>
                                <a href="index.php?view=persons" class="btn btn-default" style="margin-left: 10px;">
                                    <i class="fa fa-times"></i> Limpiar filtro
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
                
                <div class="btn-group" style="margin-bottom: 15px;">
                    <!-- Descargar CVs de la página actual -->
                    <form action="index.php?action=downloadall" method="post" style="display:inline-block; margin-right: 10px;">
                        <?php foreach ($users as $user): ?>
                            <input hidden="hidden" name="file_ids[]" value="<?php echo htmlspecialchars($user->file); ?>">
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-download"></i> Descargar CVs de esta página
                        </button>
                    </form>
                </div>
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered table-hover datatable-nosearch">
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
                                    <td><?php echo getStatus($user) ?></td>
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
                                        <a href="index.php?action=persons&opt=del&id=<?php echo $user->id; ?>"
                                           class="btn btn-danger btn-xs">Eliminar</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        
                        <!-- Controles de paginación -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <?php if($total_pages > 1): ?>
                                    <!-- Botón anterior -->
                                    <li class="<?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                        <?php if($page > 1): ?>
                                            <a href="index.php?view=persons&page=<?php echo $page-1; ?><?php echo $job_id > 0 ? '&job_id='.$job_id : ''; ?>">&laquo;</a>
                                        <?php else: ?>
                                            <a href="#">&laquo;</a>
                                        <?php endif; ?>
                                    </li>
                                    
                                    <!-- Números de página -->
                                    <?php 
                                    $start_page = max(1, $page - 2);
                                    $end_page = min($total_pages, $page + 2);
                                    
                                    for($i = $start_page; $i <= $end_page; $i++): ?>
                                        <li class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                                            <a href="index.php?view=persons&page=<?php echo $i; ?><?php echo $job_id > 0 ? '&job_id='.$job_id : ''; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    
                                    <!-- Botón siguiente -->
                                    <li class="<?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                        <?php if($page < $total_pages): ?>
                                            <a href="index.php?view=persons&page=<?php echo $page+1; ?><?php echo $job_id > 0 ? '&job_id='.$job_id : ''; ?>">&raquo;</a>
                                        <?php else: ?>
                                            <a href="#">&raquo;</a>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            
                            <?php if ($job_id > 0): ?>
                                <div class="pull-left">
                                    <p class="text-muted">Mostrando solicitudes para la vacante: <strong><?php echo $job_name; ?></strong></p>
                                </div>
                            <?php endif; ?>
                        </div>
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