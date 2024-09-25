<?php
Class TaskView{
    
public function showTasks($tasks) {
    require './templates/header.php';
    require './templates/form_alta.php';

    ?>

    <ul class="list-group">
    <?php foreach($tasks as $task) { ?>
        <li class="list-group-item item-task <?php if ($task->finalizada) echo 'finished'; ?>">
            <div class="label">
                <b><?= $task->titulo ?></b> | (Prioridad <?= $task->prioridad ?>)
                <a class="btn btn-sm" href="verMas/<?= $task->id ?>">Ver mas</a>
            </div>
            <div class="actions">
                <?php if(!$task->finalizada) { ?> <a href="finalizar/<?= $task->id ?>" class='btn btn-sm btn-success ml-auto'>FINALIZAR</a> <?php } ?>
                <a class="btn btn-sm btn-primary " href="modificar/<?= $task->id ?>">MODIFICAR</a>
                <a class="btn btn-sm btn-danger" href="eliminar/<?= $task->id ?>">ELIMINAR</a>
            </div>
        </li>
        <!--<li class="list-group-item item-task">
        </li>-->
    <?php }

    require './templates/footer.php';
}

public function showTask($task){

    require './templates/header.php';
    ?>
    <form action="modificar/<?= $task->id ?>"  method="POST" class="my-4">
    <div class="row">
        <div class="col-9">
            <div class="form-group">
                <label>Título</label>
                <input name="title" type="text" class="form-control" value="<?= $task->titulo ?>">
               
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label>Prioridad</label>
                <select required name="priority" class="form-control">
        <option value="1" <?= $task->prioridad == 1 ? 'selected' : '' ?>>1</option>
        <option value="2" <?= $task->prioridad == 2 ? 'selected' : '' ?>>2</option>
        <option value="3" <?= $task->prioridad == 3 ? 'selected' : '' ?>>3</option>
        <option value="4" <?= $task->prioridad == 4 ? 'selected' : '' ?>>4</option>
        <option value="5" <?= $task->prioridad == 5 ? 'selected' : '' ?>>5</option>
    </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Descripcion</label>
        <textarea name="description" class="form-control" rows="3"><?= $task->descripcion ?></textarea>
        </div>

    <button type="submit" class="btn btn-primary mt-2">Guardar</button>
    <a href="listar" id="volver">VOLVER</a>
</form>

<?php
require './templates/footer.php';
}

public function showDescription($task){
    require './templates/header.php';
    ?>
    <div class="form-group">
        <label>Descripcion</label>
        <textarea name="description" class="form-control" rows="3"><?= $task->descripcion ?></textarea>
        </div>
        <a href="listar" id="volver">VOLVER</a>
<?php
    require './templates/footer.php';
}

public function showError($error){
     echo ($error);
     return;
}
}
