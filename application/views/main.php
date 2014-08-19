<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Управление кампаниями Яндекс директ</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="/media/components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/media/css/jquery-ui.css">
    <link rel="stylesheet" href="/media/css/main.css">
    <script src="/media/components/html5-boilerplate/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ЯД</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="javascript: void(0);" data-toggle="modal" data-target="#help">Описание</a></li>
        </ul>

        <p class="navbar-text navbar-right">Максим Кутырев <a href="https://github.com/homaxweb" target="_blank"><img src="/media/images/github.png" width="24" height="24" alt="Github homaxweb"/></a> <a href="http://spb.hh.ru/resume/2cf85ea2ff020adb720039ed1f56496f51786d" target="_blank"><img src="/media/images/hh.png" width="24" height="24" alt="HeadHunter Максим Кутырев"/></a></p>


        <!-- Collect the nav links, forms, and other content for toggling -->

    </div><!-- /.container-fluid -->
</nav>
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<?= $content; ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/media/components/jquery/dist/jquery.min.js"><\/script>')</script>
<script src="/media/components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/media/js/jquery-ui.min.js"></script>
<script src="/media/js/datepicker.ru.js"></script>
<script src="/media/js/main.js"></script>

<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2>Описание</h2>
            </div>
            <div class="modal-body">
                <p>При запуске приложения и по нажатию кнопки "Статистика" загружается статистика по всем капаниям, либо по выбранной в фильтре.</p>
                <p>Анализ кампаний на основе данных, предоставленных условиями задачи, идет по полю "клики", которое подсвечивается желтым или красным цветом фона. При клике на кнопке "Алгоритм" система определяет, в каких кампаниях не выполняются поставленные по определенным параметрам цели. В частности, если действительных кликов было меньше, чем ожидаемых(указано в скобках, и в этом случае эта ячейка имеет красный фон), то такая кампания будет автоматически остановлена.</p>
                <p>По кнопке активация будут запущены все остановленные кампании.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
 