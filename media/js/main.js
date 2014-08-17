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

    /*$.post("/index/stat/", {'id' : $('#selectCampaign').val(), 'dateFrom' : $('#dateStart').val(), 'dateTo' : $('#dateEnd').val()},
        function(data){
            res.html(data);
        });

    $('#getStat').on('click', function() {
        $.post("/index/stat/", {'id' : $('#selectCampaign').val(), 'dateFrom' : $('#dateStart').val(), 'dateTo' : $('#dateEnd').val()},
            function(data){
                res.html(data);
            });
    });*/

    $('#analyze').on('click', function() {
        $.post("/index/analyze/", {},
            function(data){
                res.html(data);
            });
    });

    $('#startCamp').on('click', function() {
        $.post("/index/start/", {},
            function(data){
                res.html(data);
            });
    });

});