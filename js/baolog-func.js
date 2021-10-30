//lanzou
$(document).on('click','#button-lanzou',function () {
    var input_value = $('#input-lanzou').val();
    var input_value_reg = input_value.match("(http|ftp|https):\\/\\/[\\w\\-_]+(\\.[\\w\\-_]+)+([\\w\\-\\.,@?^=%&:/~\\+#]*[\\w\\-\\@?^=%&/~\\+#])?")
    if (input_value == ""){
        $.alert('请输入链接~', 30, {size: 'sm'});
        return false;
    }else if(!input_value_reg){
        $.alert('请输入正确的链接哦，要带http://或者https://~', 30, {size: 'sm'});
        return false;
    }
    $('#input-result').val("正在解析中...");
    $.get("https://api.vvhan.com/api/lz",{'url':input_value},function (res) {
        if (res.success){
            $('#input-result').val(res.download);
        }else{
            $.alert('解析失败啦，等修理一下吧~', 30, {size: 'sm'});
        }
    });
});
$(document).on('click','#button-lanzou-copy',function () {
    var result = $('#input-result').val()
    var ct =new copy_txt();
    if(result == ""){
        $.alert('先解析再复制吧~', 30, {size: 'sm'});
    }else{
        ct.copy(result);
        $.alert('已经复制到剪辑版啦~', 30, {size: 'sm'});
    }
});
$(document).on('click','#button-lanzou-clear',function () {
    $('#input-lanzou').val("")
    $.alert('已经清空~', 30, {size: 'sm'});
});
var copy_txt=function(){//无组件复制
    var _this =this;
    this.copy=function(txt){
        $("#input_copy_txt_to_board").val(txt);//赋值
        $("#input_copy_txt_to_board").removeClass("hide");//显示
        $("#input_copy_txt_to_board").focus();//取得焦点
        $("#input_copy_txt_to_board").select();//选择
        document.execCommand("Copy");
        $("#input_copy_txt_to_board").addClass("hide");//隐藏
    }

    //-----------
    let html ='<input type class="hide" id="input_copy_txt_to_board" value="" />';//添加一个隐藏的元素
    $("body").append(html);
};
