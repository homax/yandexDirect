<div class="container-fluid main-container">
    <div class="row">
        <div class="form">
                <div class="form-group col-md-3">
                    <label for="selectCampaign" class="control-label">Выбор кампании</label>
                    <div class="">
                        <select id="selectCampaign" class="form-control">
                            <option value="0">Все</option>
                            <?php foreach($ids as $key=>$id) : ?>
                                <option value="<?= $key; ?>"><?= $id . " (" . $key . ")"; ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="dateStart" class="control-label">Дата от</label>
                    <div class="">
                        <input type="text" id="dateStart" class="form-control" placeholder="дата от">
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="dateEnd" class="control-label">Дата до</label>
                    <div class="">
                        <input type="text" id="dateEnd" class="form-control" placeholder="дата до">
                    </div>
                </div>

        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-4">
                <button id="getStat" class="btn btn-info">Cтатистика <i class="question glyphicon glyphicon-question-sign" title="Обновить статистику по кампаниям" data-toggle="tooltip" data-placement="top"></i></button>
                <button id="analyze" class="btn btn-primary">Алгоритм <i class="question glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Запустить алгоритм анализа статистики"></i></button>
                <button <?php echo ($hasNoActive) ? "": "disabled" ?> id="startCamp" class="btn btn-default">Активация <i class="question glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Запустить неактивные компании"></i></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="result" class="form col-md-12"></div>
    </div>
</div>