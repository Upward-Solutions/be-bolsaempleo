<?php
$jobs = JobData::getAllActive();

function place($job): string
{
    if (property_exists($job, 'place_id')) {
        $place = PlaceData::getById($job->place_id);
        return $place->name;
    } else {
        return 'Lugar no disponible';
    }
}

function category($job): string
{
    if (property_exists($job, 'category_id')) {
        $category = CategoryData::getById($job->category_id);
        return $category->name;
    } else {
        return 'Categoría no disponible';
    }
}

function name($job): string
{
    return $job->name ?? 'Sin nombre';
}

function isEmpty(array $jobs): bool
{
    return count($jobs) == 0;
}

function description($jb): string
{
    return category($jb) . ' - ' . place($jb);
}

?>

<div class="container">
    <h1 id="vacantes-title">Vacantes</h1>
    <div id="vacantes-container">
        <?php foreach ($jobs as $jb) : ?>
            <div class="vacante card border-secondary">
                <div class="card-body">
                    <h5 class="card-title"><?= name($jb); ?></h5>
                    <p class="card-text"><?= description($jb); ?></p>
                    <a href="./?view=job&id=<?= $jb->id ?>" class="btn btn-primary">Ver</a>
                </div>
            </div>
        <?php endforeach;
        if (isEmpty($jobs)) : ?>
            <p class="alert alert-warning">No hay vacantes de trabajo por el momento.</p>
        <?php endif; ?>
    </div>
</div>
