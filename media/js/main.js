$(document).ready(function() {

    $(function() {
        $( "#dateStart" ).datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            maxDate: "now",
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                $( "#dateEnd" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#dateEnd" ).datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            numberOfMonths: 1,
            maxDate: "now",
            onClose: function( selectedDate ) {
                $( "#dateStart" ).datepicker( "option", "maxDate", "now" );
            }
        });
    });

    var res = $('#result');

    $.post("/index/stat/", {'id' : $('#selectCampaign').val(), 'dateFrom' : $('#dateStart').val(), 'dateTo' : $('#dateEnd').val()},
        function(data){
            res.html(data);
        });

    $('#getStat').on('click', function() {
        var button = $(this);
        var buttonInner = button.html();
        $(this).html('Загрузка...');
        $.post("/index/stat/", {'id' : $('#selectCampaign').val(), 'dateFrom' : $('#dateStart').val(), 'dateTo' : $('#dateEnd').val()},
            function(data){
                res.html(data);
                button.html(buttonInner);
            });
    });

    $('#analyze').on('click', function() {
        var button = $(this);
        var buttonInner = button.html();
        $(this).html('Расчет...');
        $.post("/index/analyze/", {'id' : $('#selectCampaign').val()},
            function(data){
                res.append(data);
                button.html(buttonInner);
            });
    });

    $('#startCamp').on('click', function() {
        var button = $(this);
        var buttonInner = button.html();
        $(this).html('Запускаем...');
        $.post("/index/start/", {},
            function(data){
                res.append(data);
                button.html(buttonInner);
            });
    });

    //Подсказки на значках помощи
    $('.question').tooltip();

});