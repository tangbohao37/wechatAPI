function link(str){
    $('#right').load('Admin/Right/'+str);
}
function editInfo(wid){
    var id = wid;
    var url="/index.php/Admin/Right/alterIssue";
    //向模态框中传值
    $.post(
        url,
        {"wid":id},
        function(data){
            var m=eval("("+data+")");
            $("#title").val(m.title);
            $("#workinfo").val(m.workinfo);
            $("#salary").val(m.salary);
            $("#workstartdate").val(m.workstartdate);
            $("#workstopdate").val(m.workstopdate);
            $("#phone").val(m.phone);
            $("#contact").val(m.contectperson);
            $("#request").val(m.request);
            $("#number").val(m.num);
            $("#workplace").val(m.address);
            $("#wid").val(m.id);
            $("#isdalysalary").val(m.isdalysalary);
        }
    );
    $('#myModal').modal('show');
}