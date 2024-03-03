<?php
echo '<script>showLoader()</script>';
$jobs = JobData::getAllActive();
echo '<script>hideLoader()</script>';

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

function getCategory(mixed $jb): string
{
    return CategoryData::getById($jb->category_id)->name;
}


function getPlaceName(mixed $jb): string
{
    return PlaceData::getById($jb->place_id)->name;
}

?>

<div id="vacantes-container">
    <?php foreach ($jobs as $jb) : ?>
        <div class="vacante card border-secondary">
            <h2 class="card-title"><?= name($jb); ?></h2>
            <div class="job-tags-container">
                <div class="job-icon-container">
                    <i class="material-icons icon">local_offer</i>
                    <p class="job-icon-text"><?php echo getCategory($jb); ?></p>
                </div>
                <div class="job-icon-container">
                    <i class="material-icons icon">place</i>
                    <p class="job-icon-text place"><?php echo getPlaceName($jb); ?></p>
                </div>
            </div>
            <p class="card-text job-description"><?php echo $jb->description; ?></p>
            <a href="./?view=job&id=<?= $jb->id ?>" class="ver-button">
                Ver Detalle
                <i class="material-icons icon">assignment</i>
            </a>
        </div>
    <?php endforeach;
    if (isEmpty($jobs)) : ?>
        <p class="alert alert-warning">No hay ofertas de trabajo por el momento.</p>
    <?php endif; ?>
</div>

<script type="text/javascript">
    const descriptions = document.getElementsByClassName("job-description")
    for (const description of descriptions) {
        if (description.textContent.length > 100) {
            description.textContent = description.textContent.slice(0, 100) + '...'
        }
    }

    const places = document.getElementsByClassName("place")
    for (const place of places) {
        if (place.textContent.length > 20) {
            place.textContent = place.textContent.slice(0, 20) + '...'
        }
    }
</script>