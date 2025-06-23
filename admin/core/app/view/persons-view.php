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
            // Configuración de paginación
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $limit = 20; // Número de solicitudes por página
            
            // Obtener el total de registros para calcular el número de páginas
            $total = PersonData::countAll();
            $total_pages = ceil($total / $limit);
            
            // Asegurar que la página actual es válida
            if ($page < 1) $page = 1;
            if ($page > $total_pages && $total_pages > 0) $page = $total_pages;
            
            // Obtener los registros de la página actual
            $users = PersonData::getAllPaginated($page, $limit);
            if (count($users) > 0) {
                ?>
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
                
                <script>
                function confirmDownloadAll(total) {
                    if(total > 100) {
                        if(confirm('Estás a punto de descargar ' + total + ' archivos. Esto puede tardar mucho tiempo y causar problemas de rendimiento. ¿Deseas continuar?')) {
                            window.location.href = 'index.php?action=downloadall&all=true';
                        }
                    } else {
                        window.location.href = 'index.php?action=downloadall&all=true';
                    }
                }
                </script>
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
                                            <a href="index.php?view=persons&page=<?php echo $page-1; ?>">&laquo;</a>
                                        <?php else: ?>
                                            <a href="#">&laquo;</a>
                                        <?php endif; ?>
                                    </li>
                                    
                                    <!-- Números de página -->
                                    <?php 
                                    // Mostrar un número limitado de enlaces de página
                                    $start_page = max(1, $page - 2);
                                    $end_page = min($total_pages, $page + 2);
                                    
                                    // Siempre mostrar la primera página
                                    if($start_page > 1): ?>
                                        <li><a href="index.php?view=persons&page=1">1</a></li>
                                        <?php if($start_page > 2): ?>
                                            <li class="disabled"><a href="#">...</a></li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                                        <li class="<?php echo ($page == $i) ? 'active' : ''; ?>">
                                            <a href="index.php?view=persons&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    
                                    <!-- Siempre mostrar la última página -->
                                    <?php if($end_page < $total_pages): ?>
                                        <?php if($end_page < $total_pages - 1): ?>
                                            <li class="disabled"><a href="#">...</a></li>
                                        <?php endif; ?>
                                        <li><a href="index.php?view=persons&page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a></li>
                                    <?php endif; ?>
                                    
                                    <!-- Botón siguiente -->
                                    <li class="<?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                        <?php if($page < $total_pages): ?>
                                            <a href="index.php?view=persons&page=<?php echo $page+1; ?>">&raquo;</a>
                                        <?php else: ?>
                                            <a href="#">&raquo;</a>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
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