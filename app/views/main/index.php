<div class="container-fluid">
    <div class="row col-md-12 mb-4">
        <a href="/knowledge/add/" class="btn btn-sm btn-success mr-2">
            <i class="far fa-plus-square"></i>
            Добавить знание
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"><?= $title ?></h4>
        </div>

        <div class="card-body">
            <div class="row loading">
                <div class="spinner-grow" role="status">
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="message ml-1 mt-1">Подождите, идет загрузка...</div>
            </div>

            <div class="table-responsive table-wrap webmaster-table">
                <?php if (!empty($data)): ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Ключевые слова</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Ключевые слова</th>
                            <th>Действия</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($data as $row): ?>
                            <tr style="font-size:12px">
                                <td><input type="checkbox" name="multiSelect[<?= $row['id'] ?>]" class="multi" value="<?= $row['id'] ?>"> <?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['parent'] ?></td>
                                <td>
                                    <?php if (!empty($row['keywords'])):
                                        foreach ($row['keywords'] as $keyword): ?>
                                    <span class="badge badge-primary"><?=$keyword?></span>
                                    <?php endforeach;
                                    endif; ?>
                                </td>
                                <td>
                                    <a href="/admin/section/task/edit/<?= $row['id'] ?>" class="btn btn-primary btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="/admin/section/task/delete/<?= $row['id'] ?>" class="btn btn-danger btn-sm taskdelete">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-warning mb-0" role="alert">
                        Данных пока нет
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
