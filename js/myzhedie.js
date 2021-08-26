(function() {
    tinymce.create('tinymce.plugins.myzhedie', { //注意这里有个 myadvert
        init : function(ed, url) {
            ed.addButton('myzhedie', { //注意这一行有一个 myadvert
                title : '折叠面板',
                image : url+'/google.png', //注意图片的路径 url是当前js的路径
                onclick : function() {
                    ed.selection.setContent('[myzhedie]'+ed.selection.getContent()+'[/myzhedie]'); //这里是你要插入到编辑器的内容，你可以直接写上广告代码

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('myzhedie', tinymce.plugins.myzhedie); //注意这里有两个 myadvert
})();