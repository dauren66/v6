// x1, y1, x2, y2 - Координаты для обрезки изображения
// crop - Папка для обрезанных изображений
var x1, y1, x2, y2, crop = 'crop/';
var jcrop_api;



jQuery(function ($) {

    $('#target').Jcrop({
	boxWidth: 600,
        boxHeight: 600,
        onChange: showCoords,
        onSelect: showCoords

    }, function () {
        jcrop_api = this;
        $("#otions_area").show();
    });

    // Снять выделение
    $('#release').click(function (e) {
        release();
    });

    $('#format').change(function (e) {
        var ar = $("#format").val();

        switch (ar) {
            case "10-15":
                jcrop_api.setOptions({aspectRatio: 10 / 15});
                jcrop_api.focus();
                console.log("10x15");
                break
            case "15-10":
                jcrop_api.setOptions({aspectRatio: 15 / 10});
                jcrop_api.focus();
                console.log("15x10");
                break
            case "15-20":
                jcrop_api.setOptions({aspectRatio: 15 / 20});
                jcrop_api.focus();
                console.log("15x20");
                break
            case "20-15":
                jcrop_api.setOptions({aspectRatio: 20 / 15});
                jcrop_api.focus();
                console.log("20x15");

                break
            case "15-23":
                jcrop_api.setOptions({aspectRatio: 15 / 23});
                jcrop_api.focus();
                break
            case "23-15":
                jcrop_api.setOptions({aspectRatio: 23 / 15});
                jcrop_api.focus();
                break
            case "20-27":
                jcrop_api.setOptions({aspectRatio: 20 / 27});
                jcrop_api.focus();
                break
            case "27-20":
                jcrop_api.setOptions({aspectRatio: 27 / 20});
                jcrop_api.focus();
                break
            case "20-30":
                jcrop_api.setOptions({aspectRatio: 20 / 30});
                jcrop_api.focus();
                break
            case "30-20":
                jcrop_api.setOptions({aspectRatio: 30 / 20});
                jcrop_api.focus();
                break
            default:
                jcrop_api.setOptions({aspectRatio: 0});
                jcrop_api.focus();

        }

    });
    // Установка минимальной/максимальной ширины и высоты
    $('#sepia').change(function (e) {
        console.log("Sepia cick!");
        jcrop_api.focus();
    });
    // Изменение координат
    function showCoords(c) {
        x1 = c.x;
        $('#x1').val(c.x);
        y1 = c.y;
        $('#y1').val(c.y);
        x2 = c.x2;
        $('#x2').val(c.x2);
        y2 = c.y2;
        $('#y2').val(c.y2);

        $('#w').val(c.w);
        $('#h').val(c.h);

        if (c.w > 0 && c.h > 0) {
            $('#crop').show();
        } else {
            $('#crop').hide();
        }
    }
});

function release() {
    jcrop_api.release();
    $('#crop').hide();

}
// Обрезка изображение и вывод результата
jQuery(function ($) {
    $('#crop').click(function (e) {
        var img = $('#target').attr('src');
        var sepia = 0;
        if ($('#sepia').is(':checked')) {
            sepia = 1;
        }
        $.post('action.php', {'x1': x1, 'x2': x2, 'y1': y1, 'y2': y2, 'img': img, 'crop': crop, 'sepia': sepia}, function (file) {
            showfilebox
            $('#cropresult').append('<img src="' + crop + file + '" class="mini">');
            release();
        });
        $('#showfilebox').hide();
        $('#otions_area').hide();
        $("#cropresult").show();
    });
});
