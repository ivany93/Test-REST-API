<?php

/* @var $this yii\web\View */

$this->title = 'REST API';
?>
<html>
<head>
    <title>Application</title>
    <meta charset="utf-8">
    <script src="//code.jquery.com/jquery.min.js"></script>

</head>
<body>
<div class="container">
    <div class="row">

        <div class="col-lg-3">
            <button class="btn-success" id="createButton"> Создать</button>
            <div id="resultCreate" style="visibility: hidden">
                <br>
                <div class="form-group">
                    <label>Хост</label>
                    <input type="text" onclick="listener()"  onmouseout="listener()" onmousemove="listener()" class="form-control" id="host" placeholder="Введите хост">
                </div>
                <div class="form-group">
                    <label>Код</label>
                    <input type="number" onclick="listener()"   onmouseout="listener()" onmousemove="listener()"  class="form-control" id="code" placeholder="Введите код">
                </div>
                <div class="form-group">
                    <label>Сообщение</label>
                    <input type="text" onclick="listener()" onmouseout="listener()" onmousemove="listener()" class="form-control"  id="message" placeholder="Введите сообщение">
                </div>
                <button class="btn btn-success" id="buttonAdd"  style="visibility: hidden"> Добавить</button>
            </div>
            <div id="responseMessages">


            </div>


        </div>
        <div class="col-lg-6" align="center">
            <button class="btn-info" id="buttonReview"> Показать</button>
            <br>
            <br>
            <div class="col-lg-12" id="twoBlockHidden" style="visibility: hidden">
                <table width="100%">
                    <tr>
                        <th width="5%">id</th>
                        <th width="20%">Код</th>
                        <th width="20%">Хост</th>
                        <th width="45%">Сообщение</th>
                        <th width="5%"> </th>
                        <th width="5%"> </th>
                    </tr>
                </table>
                <br>
            </div>
            <div class="col-lg-12"  id="resultView"  >
            </div>
        </div>
        <div class="col-lg-3">
            <input id="searchId" type="number" name="searchId" placeholder="Найти по Id">
            <button id="buttonIdSearch" class="btn-warning"> Поиск</button>
            <br><br>
            <div id="resultSearch"></div>
        </div>
    </div>
</div>



<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1"
     role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="container">
                <div class="col-lg-12">
                    <input type="number" id="idUpdate" value="" style="visibility: hidden">
            <div class="form-group">

                <label>Код</label><br>
            <input type="number" id="codeUpdane" value="">
            </div>
            <div class="form-group">
                <label>Хост</label><br>
                <input type="text" id="hostUpdane" value="">
            </div>
            <div class="form-group">
                <label>Сообщение</label><br>
                <input type="text" id="messageUpdane" value="">
            </div>
                    <button class="btn btn-success"  id="buttonUpdateOk">Обновить</button>
                    <button class="btn btn-danger"  id="buttonUpdateCancel">Отмена</button>

            </div>
                <br>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function listener(){
//        console.log($('#host').val() + ' = '+$('#code').val()+' = ' + $('#message').val() )
        if($('#host').val().length > 0 && $('#code').val().length > 0 && $('#message').val().length > 0){
            $('#buttonAdd').css({'visibility':'visible'});
        }
    }

    function functSuccess(data){
        $('#responseMessages').text('Сообщение отправлено!');
    }


    function functSuccessReview(data){
        report = JSON.stringify(data);
        var row='';
        for (var i in data) {
            row +=
                '<table width="100%">' +
                '<tr><td width="5%">'+data[i].id+ '</td>' +
                '<td width="20%">'+data[i].host+'</td>' +
                '<td width="20%">'+data[i].code+'</td>' +
                '<td width="45%">'+data[i].message+'</td>' +
                '<td width="5%"> <span style="cursor: pointer" onclick="openModal(id)" ' +
                'class="glyphicon glyphicon-pencil" data-toggle="modal" data-target=".bs-example-modal-sm" id="'+data[i].id+'"></span></td>' +
                '<td width="5%"><span style="cursor: pointer" onclick="deleteReport(id)"' +
                ' class="glyphicon glyphicon-remove"  id="'+data[i].id+'"></span></td>' +
                '</tr></table><br>';
            $('#resultView').html(row);

        }

    }

    function deleteReport(id){
        $.ajax({
            url:"../reports/"+id,
            type:"DELETE",
            data:({}),
            dataType:"json",
            success:function(){
                alert("Удаленно елемент с id="+id);
                location.reload();
            }
        });

    }

    function openModal(id){
        $.ajax({
            url:"../reports/"+id,
            type:"GET",
            data:({}),
            dataType:"json",
            success: updateReport
        });
    }

    function updateReport(data){

        report = JSON.stringify(data);
        console.log(''+report);
        $('#codeUpdane').val(data.code);
        $('#hostUpdane').val(data.host);
        $('#messageUpdane').val(data.message);
        $('#idUpdate').val(data.id);
    }

    function functSuccessFindOne(data){
        report = JSON.stringify(data);
        console.log(''+report);
        var row='';
        row +=
            '<table width="100%">' +
            '<tr><td width="5%">'+data.id+ '</td>' +
            '<td width="20%">'+data.host+'</td>' +
            '<td width="20%">'+data.code+'</td>' +
            '<td width="45%">'+data.message+'</td>' +
            '<td width="5%"> <span style="cursor: pointer" onclick="openModal(id)" class="glyphicon glyphicon-pencil"' +
            ' data-toggle="modal" data-target=".bs-example-modal-sm" id="'+data.id+'"></span></td>' +
            '<td width="5%"><span style="cursor: pointer" onclick="deleteReport(id)" ' +
            'class="glyphicon glyphicon-remove" id="'+data.id+'"></span></td>' +
            '</tr></table><br>';
        $('#resultSearch').html(row);
    }
    $(document).ready(function(){
        $('#createButton').bind('click',function(){
            $('#resultCreate').css({'visibility': 'visible'});
        });

        $('#buttonAdd').bind('click', function(){
            $.ajax({
                url: "../reports",
                type: "POST",
                data:({host: $('#host').val(), code:$('#code').val(), message: $('#message').val()}),
                dataType: "json",
                success: functSuccess
            });

            $('#host').val('');
            $('#code').val('');
            $('#message').val('');
            $('#buttonAdd').css({'visibility':'hidden'});
            $('#resultCreate').css({'visibility': 'hidden'});
        });

        $('#buttonReview').bind('click',function(){
            $('#twoBlockHidden').css({'visibility':'visible'});
            $.ajax({
                url:"../reports",
                type:"GET",
                data:({}),
                dataType:"json",
                success:functSuccessReview
            });
        });

        $('#buttonIdSearch').bind('click',function(){
            $.ajax({
                url:"../reports/"+$('#searchId').val(),
                type:"GET",
                data:({}),
                dataType:"json",
                success:functSuccessFindOne
            });
        });

        $('#buttonUpdateCancel').bind('click',function(){
            $('#myModal').modal('hide')
        });

        $('#buttonUpdateOk').bind('click',function(){
            $.ajax({
                url: "../reports/" +$('#idUpdate').val(),
                type: "PUT",
                data:({host: $('#hostUpdane').val(), code:$('#codeUpdane').val(), message: $('#messageUpdane').val()}),
                dataType: "json"

             });
            $('#myModal').modal('hide');
            location.reload();
        });
    });
</script>

</body>
</html>