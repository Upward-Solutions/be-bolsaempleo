<?php
$jb = JobData::getById($_GET["id"]);

function getName(mixed $jb): void
{
    echo PlaceData::getById($jb->place_id)->name;
}

function getCategory(mixed $jb): void
{
    echo CategoryData::getById($jb->category_id)->name;
}

?>

<div class="job-container">
    <h1><?php echo $jb->name; ?></h1>
    <div class="job-tags-container">
        <div class="job-icon-container">
            <i class="material-icons icon">place</i>
            <p class="job-icon-text"><?php getName($jb); ?></p>
        </div>
        <div class="job-icon-container">
            <i class="material-icons icon">local_offer</i>
            <p class="job-icon-text"><?php getCategory($jb); ?></p>
        </div>
        <div class="job-icon-container">
            <i class="material-icons icon">date_range</i>
            <p class="job-icon-text">Disponible hasta: <?php echo $jb->limit_at; ?></p>
        </div>
    </div>
    <div class="job-description-container">
        <h4 class="job-subtitle">Descripcion</h4>
        <p class="job-description-text"><?php echo $jb->description; ?></p>
        <h4 class="job-subtitle">Requerimientos</h4>
        <p class="job-description-text"><?php echo $jb->requirements; ?></p>
    </div>
    <button class="job-apply-button">POSTULARME</button>
    <?php /*
            <div class="panel panel-default">
                <div class="panel-heading">Enviar informacion</div>
                <div class="panel-body">
                    <form method="post" action="./?action=send" enctype="multipart/form-data">
                        <input type="hidden" name="job_id" value="<?php echo $jb->id; ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                   placeholder="Nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Apellidos</label>
                            <input type="text" name="lastname" class="form-control" id="exampleInputEmail1"
                                   placeholder="Apellidos" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telefono</label>
                            <input type="text" name="phone" required class="form-control" id="exampleInputEmail1"
                                   placeholder="Telefono">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo electronico</label>
                            <input type="email" name="email" required class="form-control" id="exampleInputEmail1"
                                   placeholder="Correo electronico">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Adjuntar CV en PDF</label>
                            <input type="file" name="file" id="exampleInputFile" required>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="accept" required> Acepto los terminos y condiciones
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Enviar datos</button>
                    </form>
                </div>
            </div>
        */ ?>
</div>
