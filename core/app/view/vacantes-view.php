<?php
$jobs = JobData::getAllActive();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Vacantes</h1>
            <div class="panel panel-default">
                <div class="panel-heading">Lista de vacantes</div>
                <div class="panel-body">
                    <?php if (count($jobs) > 0) : ?>
                        <?php foreach ($jobs as $jb) : ?>
                            <div class="card border-secondary" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php
                                        // Verifica si la propiedad 'name' existe en el objeto $jb
                                        if (property_exists($jb, 'name')) {
                                            echo $jb->name;
                                        } else {
                                            echo 'No se ha definido un nombre para esta vacante.';
                                        }
                                        ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php
                                        if (property_exists($jb, 'category_id') && property_exists($jb, 'place_id')) {
                                            $category = CategoryData::getById($jb->category_id);
                                            $place = PlaceData::getById($jb->place_id);
                                            echo $category->name . ' - ' . $place->name;
                                        } else {
                                            echo 'Información de categoría o lugar no disponible.';
                                        }
                                        ?>
                                    </p>
                                    <a href="./?view=job&id=<?php echo $jb->id; ?>" class="btn btn-primary">Ver</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="alert alert-warning">No hay vacantes de trabajo por el momento.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
