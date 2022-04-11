(function () {
    tinymce.PluginManager.add('wd_mce_button', function (editor, url) {
        editor.addButton('wd_mce_button', {
            title: '插入短代码',
            //text: '插入excel',
            icon: false,
            //type: 'menubutton',
            image: url + "/info.svg",
            type: 'menubutton',
            menu: [
                {
                    text: '==面板类==',
                },
                {
                    text: '红色警告面板',
                    onclick: function () {
                        editor.insertContent('[danger-callout]在这里输入内容[/danger-callout]');
                    }
                },
                {
                    text: '蓝色信息面板',
                    onclick: function () {
                        editor.insertContent('[info-callout]在这里输入内容[/info-callout]');
                    }
                },
                {
                    text: '黄色警告面板',
                    onclick: function () {
                        editor.insertContent('[warning-callout]在这里输入内容[/warning-callout]');
                    }
                },
                {
                    text: '折叠面板',
                    onclick: function () {
                        editor.insertContent('[fold-title]在这里输入标题[/fold-title]');
                        editor.insertContent('[fold-body]在这里输入内容[/fold-body]');
                    }
                },
                {
                    text: 'NOTE面板',
                    onclick: function () {
                        editor.insertContent('[note-callout-title]在这里输入标题[/note-callout-title]');
                        editor.insertContent('[note-callout-body]在这里输入内容，一条一行~[/note-callout-body]');
                        editor.insertContent('[note-callout-footer]这里不要输入内容[/note-callout-footer]');
                    }
                },
                {
                    text: '==按钮类==',
                },
                {
                    text: '普通按钮',
                    onclick: function () {
                        editor.insertContent('[btn-primary]在这里输入内容[/btn-primary]');
                    }
                },
                {
                    text: '灰色按钮',
                    onclick: function () {
                        editor.insertContent('[btn-secondary]在这里输入内容[/btn-secondary]');
                    }
                },
                {
                    text: '成功按钮',
                    onclick: function () {
                        editor.insertContent('[btn-success]在这里输入内容[/btn-success]');
                    }
                },
                {
                    text: '红色按钮',
                    onclick: function () {
                        editor.insertContent('[btn-danger]在这里输入内容[/btn-danger]');
                    }
                },
                {
                    text: '黄色按钮',
                    onclick: function () {
                        editor.insertContent('[btn-warning]在这里输入内容[/btn-warning]');
                    }
                },
                {
                    text: '信息按钮',
                    onclick: function () {
                        editor.insertContent('[btn-info]在这里输入内容[/btn-info]');
                    }
                },
                {
                    text: '轻盈按钮',
                    onclick: function () {
                        editor.insertContent('[btn-light]在这里输入内容[/btn-light]');
                    }
                },
                {
                    text: '黑色按钮',
                    onclick: function () {
                        editor.insertContent('[btn-dark]在这里输入内容[/btn-dark]');
                    }
                },
                {
                    text: '链接按钮',
                    onclick: function () {
                        editor.insertContent('[btn-link]在这里输入内容[/btn-link]');
                    }
                }, {
                    text: '通栏普通按钮',
                    onclick: function () {
                        editor.insertContent('[btn-lg-primary]在这里输入内容[/btn-lg-primary]');
                    }
                }, {
                    text: '通栏灰色按钮',
                    onclick: function () {
                        editor.insertContent('[btn-lg-secondary]在这里输入内容[/btn-lg-secondary]');
                    }
                }, {
                    text: '==进度条（正在写）==',
                },
                {
                    text: '==普通类==',
                }, {
                    text: '文章过期时间',
                    onclick: function () {
                        editor.insertContent('[countdown time="填入时间格式要固定 比如：2021-09-20 12:22:57"]');
                    }
                },
                {
                    text: '仅登录可见内容',
                    onclick: function () {
                        editor.insertContent('[hide]在这里填入内容[/hide]');
                    }
                },
                {
                    text: '仅回复可见内容',
                    onclick: function () {
                        editor.insertContent('[reply]在这里填入内容[/reply]');
                    }
                },

            ]
        });
    });
})();