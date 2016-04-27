<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

        <title>Загрузка фотографий для печати</title>

        <script type="text/javascript" src="js/plupload.js"></script>
        <script type="text/javascript" src="js/plupload.html4.js"></script>
        <script type="text/javascript" src="js/plupload.html5.js"></script>

        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.Jcrop.min.js"></script>
        <script src="js/crop.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <style type="text/css">
          #crop{ display:none;}
          #cropresult{ border:2px solid #ddd;}
          .mini{ margin:5px; }
          .panel-heading{ height: 57px;}
          #uploader{ width: 200px; float:left }
          #release{float: left; margin-right: 20px;}
          #format{width: 120px; float: left;}
          #sepiabox {float: left; margin-top: 7px; margin-left: 16px; margin-right:35px;}
          #sepia{margin-right: 7px;}
          #crop{float: left; width: 150px;}
          #showfilebox{margin-top: 30px; margin-left: 10px;}
        </style>

    </head>
    <body>
        <h1>Загрузка, кроп и фильтрация изображений.</h1>
        <div id="container">
            <div class="panel panel-default">
                <div class="panel-heading" >
                    <div id="filelist"  >
                        <div id="uploader" >
                            <button id="pickfiles" type="button" class="btn btn-primary" >Выберите файл</button>
                        </div>
                        <div id="otions_area" style="display:none">

                            <button id="release" type="button" class="btn btn-danger"  >Убрать выделение</button>
                            <div class="optlist offset" style="float: left;">

                                <select  class="form-control" id="format" name="ar" >
                                    <option value="0">Формат</option>
                                    <option value="10-15">10х15</option>
                                    <option value="15-10">15х10</option>
                                    <option value="15-20">15х20</option>
                                    <option value="20-15">20х15</option>
                                    <option value="15-23">15х23</option>
                                    <option value="23-15">23х15</option>
                                    <option value="20-27">20х27</option>
                                    <option value="27-20">27х20</option>
                                    <option value="20-30">20х30</option>
                                    <option value="30-20">30х20</option>
                                </select>
                                <div id="sepiabox" >  <label><input type="checkbox" id="sepia" />Сепия</label> </div>
                            </div>
                            <button id="crop" type="button" class="btn btn-success" >Сохранить</button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="showfilebox"  >
                        <? if(isset($_GET['img'])) {
                        echo '<img src="uploads/'.$_GET['img'].'" id="target"  />';
                        } ?>
                    </div>
                </div>

                <div id="cropresult" style="display:none"></div>

                <script type="text/javascript">
                  function $(id) {
                      return document.getElementById(id);
                  }

                      var uploader = new plupload.Uploader({
                      runtimes: 'gears,html5,flash,silverlight,browserplus',
                      browse_button: 'pickfiles',
                      autostart: true,
                      container: 'container',
                      max_file_size: '10mb',
                      multi_selection: false,
                 //   	resize : { width : 640, height : 480, quality : 100 },
                      url: 'upload.php',
                      filters: [{title: "Image files", extensions: "jpg,gif,png"}
                      ]
                  });
                  uploader.bind('Init', function (up, params) {
                  });

                  uploader.bind('FilesAdded', function (up, files) {
                      for (var i in files) {
                          $('filelist').innerHTML += '<div id="' + files[i].id + '">' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <b>*</b></div>';
                      }
                  });

                  uploader.bind('UploadProgress', function (up, file) {
                      $(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                  });
                  uploader.init();

                  uploader.bind('FilesAdded', function (up, files) {
                      uploader.start();
                  });

                  uploader.bind('FileUploaded', function (up, file, res) {
                  window.location = "index.php?img=" + file.name;
                  });

                </script>
                </body>
                </html>

