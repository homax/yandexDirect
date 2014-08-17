<div class="container-fluid main-container">
    <div class="row">
        <div class="form col-md-4">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="selectCampaign" class="col-sm-4 control-label">Выбор кампании</label>
                    <div class="col-sm-8">
                        <select id="selectCampaign" class="form-control">
                            <option value="0">Все</option>
                            <?php foreach($ids as $key=>$id) : ?>
                                <option value="<?= $key; ?>"><?= $id . " (" . $key . ")"; ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateStart" class="col-sm-4 control-label">Дата от</label>
                    <div class="col-sm-8">
                        <input type="text" id="dateStart" class="form-control" placeholder="дата от">
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateEnd" class="col-sm-4 control-label">Дата до</label>
                    <div class="col-sm-8">
                        <input type="text" id="dateEnd" class="form-control" placeholder="дата до">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button id="getStat" class="btn btn-info" title="Обновить статистику по кампаниям">Cтатистика</button>
                        <button id="analyze" class="btn btn-primary" title="Запустить алгоритм анализа статистики">Алгоритм</button>
                        <button <?php echo ($hasNoActive) ? "": "disabled" ?> id="startCamp" class="btn btn-default" title="Запустить неактивные компании">Активация</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="result" class="form col-md-12"></div>
    </div>
</div>