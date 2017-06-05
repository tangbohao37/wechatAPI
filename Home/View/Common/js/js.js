function editInfo(wid){ //向模态框中传值
    var id = wid;
    $("#field＿name").val(id);
    $('#myModal').modal('show');
}

function submit(){   //申请职位
    var id=$("#field＿name").val();
    var note=$("#note").val();
    var url="/index.php/home/workinfo/worksubmit";
    $.post(
        url,
        {"wid":id,"note":note},
        function(data){
            //var m=eval("("+data+")");
            //$("#title").val(m.title);
            alert(data);
            $('#myModal').modal('hide');
        }
    );
}
