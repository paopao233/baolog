//----------------------page function
//lanzou
$(document).on('click','#button-lanzou',function () {
    var input_value = $('#input-lanzou').val();
    var input_value_reg = input_value.match("(http|ftp|https):\\/\\/[\\w\\-_]+(\\.[\\w\\-_]+)+([\\w\\-\\.,@?^=%&:/~\\+#]*[\\w\\-\\@?^=%&/~\\+#])?")
    if (input_value == ""){
        $.alert('请输入链接~', 30, {size: 'sm'});
        return false;
    }else if(!input_value_reg){
        $.alert('请输入正确的链接哦，要带http://或者https://', 30, {size: 'sm'});
        return false;
    }
    $('#input-result').val("正在解析中...");
    $.get("https://api.vvhan.com/api/lz",{'url':input_value},function (res) {
        if (res.success){
            $('#input-result').val(res.download);
            var info = res.info;
            $('#input-lanzou-type').val(info.type);
            $('#input-lanzou-name').val(info.name);
            $('#input-lanzou-size').val(info.size);
            $('#input-lanzou-time').val(info.time);
            $.alert('OK~', 30, {size: 'sm'});
        }else{
            $('#input-result').val("解析失败啦，喊管理员修理一下它吧~");
            $.alert(res.message, 30, {size: 'sm'});
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
    let html ='<input type class="hide" id="input_copy_txt_to_board" value="" />';//添加一个隐藏的元素
    $("body").append(html);
};



// douyin
$(document).on('click','#button-douyin-clear',function () {
    $('#input-douyin').val("")
});

$(document).on('click','#button-douyin-cover',function () {
    window.open($("#input-result-cover").val());
});
$(document).on('click','#button-douyin-url',function () {
    window.open($("#input-result-url").val());
});

$(document).on('click','#button-douyin-copy',function () {
    var result = $('#input-result-title').val()
    var ct =new copy_txt();
    if(result == ""){
        $.alert('先解析再复制吧~', 30, {size: 'sm'});
    }else{
        ct.copy(result);
        $.alert('已经复制到剪辑版啦~', 30, {size: 'sm'});
    }
});
$(document).on('click','#button-douyin',function () {
    var input_value = $('#input-douyin').val();
    var input_value_reg = input_value.match("(http|ftp|https):\\/\\/[\\w\\-_]+(\\.[\\w\\-_]+)+([\\w\\-\\.,@?^=%&:/~\\+#]*[\\w\\-\\@?^=%&/~\\+#])?")
    if (input_value == ""){
        $.alert('请输入链接~', 30, {size: 'sm'});
        return false;
    }else if(!input_value_reg){
        $.alert('请输入正确的链接哦，要带http://或者https://', 30, {size: 'sm'});
        return false;
    }
    $('#input-result').val("正在解析中...");
    $.get("https://www.devtool.top/api/douyin/parse",{'url':input_value},function (res) {
        if (res.code == 200){
            var data = res.data;
            var video = data.video;
            $('#input-result-title').val(data.title);
            $('#input-result-cover').val(video.cover);
            $('#input-result-url').val(video.url);
            $.alert('OK~', 30, {size: 'sm'});
        }else{
            $('#input-result-title').val("解析失败啦，喊管理员修理一下它吧~");
            $.alert('解析失败啦，喊管理员修理一下它吧~', 30, {size: 'sm'});
        }
    });
});