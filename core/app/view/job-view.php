<?php
echo '<script>showLoader()</script>';
$jb = JobData::getById($_GET["id"]);
echo '<script>hideLoader()</script>';

function isNullOrEmptyString($str): bool
{
    return ($str === null || trim($str) === '');
}

function getPlaceName(mixed $jb): string
{
    return PlaceData::getById($jb->place_id)->name;
}

function getCategory(mixed $jb): string
{
    return CategoryData::getById($jb->category_id)->name;
}

?>

<div class="job-container">
    <h1 class="job-title"><?php echo $jb->name; ?></h1>
    <div class="job-tags-container detail">
        <?php if (!isNullOrEmptyString(getPlaceName($jb))) { ?>
            <div class="job-icon-container">
                <i class="material-icons icon">place</i>
                <p class="job-icon-text"><?php echo getPlaceName($jb); ?></p>
            </div>
        <?php } ?>
        <?php if (!isNullOrEmptyString(getCategory($jb))) { ?>
            <div class="job-icon-container">
                <i class="material-icons icon">local_offer</i>
                <p class="job-icon-text"><?php echo getCategory($jb); ?></p>
            </div>
        <?php } ?>
        <?php if (!isNullOrEmptyString($jb->limit_at)) { ?>
            <div class="job-icon-container">
                <i class="material-icons icon">date_range</i>
                <p class="job-icon-text">Fecha límite: <?php echo date("d/m/Y", strtotime($jb->limit_at)); ?></p>
            </div>
        <?php } ?>
    </div>
    <div class="job-description-container">
        <h4 class="job-subtitle">Descripci&oacute;n</h4>
        <p class="job-description-text"><?php echo $jb->description; ?></p>
        <h4 class="job-subtitle">Requerimientos</h4>
        <p class="job-description-text"><?php echo $jb->requirements; ?></p>
    </div>
    <button class="job-apply-button" id="postularme-open-button">POSTULARME</button>
    <dialog id="postularme-modal">
        <i class="material-icons" id="close-modal-button">close</i>
        <div class="panel panel-default">
            <h2 class="job-title">Enviar informaci&oacute;n</h2>
            <form method="post" action="./?action=send" enctype="multipart/form-data">
                <input type="hidden" name="job_id" value="<?php echo $jb->id; ?>">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Nombre" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Apellidos</label>
                    <input type="text" name="lastname" id="last-name" placeholder="Apellidos" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="text" name="phone" required id="phone" placeholder="Telefono">
                </div>
                <div class="form-group">
                    <label for="email">Correo electronico</label>
                    <input type="email" name="email" required id="email" placeholder="Correo electronico">
                </div>
                <div class="form-group">
                    <label for="cv">Adjuntar CV en PDF</label>
                    <input type="file" name="file" id="cv" required>
                </div>
                <button type="submit" class="job-apply-button" id="postularme-open-button">ENVIAR</button>
            </form>
        </div>
    </dialog>
    <script type="text/javascript">
        const modal = document.getElementById('postularme-modal')
        const openButton = document.getElementById('postularme-open-button')
        const closeButton = document.getElementById('close-modal-button')
        openButton.addEventListener('click', function () {
            modal.showModal()
        })
        closeButton.addEventListener('click', function () {
            modal.close()
        })

        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.close()
            }
        });
    </script>
</div>
