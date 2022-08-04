<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-md-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary"><?= $title ?></h5>
                </div>

                <div class="card-body">
                    <form id="ajaxForm" class="ajax-form" action="/knowledge/edit/<?=$data['id']?>" method="post">
                        <div class="form-group">
                            <label for="title">Название области знания</label>
                            <input type="text" class="form-control" name="knowledge" placeholder="Укажите название области" value="<?=$data['name']?>">
                        </div>

                        <div class="form-group">
                            <label for="description">Выберите ключевые слова</label>
                            <div class="tags">
                                <?php
                                if (!empty($keywords)):
                                    foreach($data['keywords'] as $keyword): ?>
                                        <input id="key<?=$keyword['id']?>" type="checkbox" name="keywords[]" value="<?=$keyword['id']?>">
                                        <label for="key<?=$keyword['id']?>" class="badge badge-primary tag-item"><?=$keyword['name']?></label>
                                    <?php endforeach;
                                endif; ?>
                            </div>
                            <div class="tags">
                                <?php foreach($data['keywords'] as $keyword): ?>
                                    <input id="key<?=$keyword['id']?>" type="checkbox" name="keywords[]" value="<?=$keyword['id']?>"<?= (isset($data['keywordsSelected'][$keyword['id']]) ? ' checked' : '')?>>
                                    <label for="key<?=$keyword['id']?>" class="badge badge-primary tag-item"><?=$keyword['name']?></label>
                                <?php endforeach; ?>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-save"></i>
                            Сохранить
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>