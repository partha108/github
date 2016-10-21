/**
* editor_plugin_src.js
*/

(function () {
    tinymce.create('tinymce.plugins.AspNetBrowser', {
        init: function (ed, url) {
            // Register commands
			//alert(base_url)
            ed.addCommand('mceAspNetBrowser', function () {
                ed.windowManager.open({
                    file: base_url + 'index.php/tinymce',
                    width: 700 + parseInt(ed.getLang('aspnetbrowser.delta_width', 0)),
                    height: 300 + parseInt(ed.getLang('aspnetbrowser.delta_height', 0)),
                    inline: 1
                }, {
                    plugin_url: url
                });
            });

            // Register buttons
            /*
            You also have to put this line of css in the ui.css file of the 
            themes-advanced-skins-default folder
            .defaultSkin span.mce_aspnetbrowser {background:url(img/aspnetbrowser.png) no-repeat center}
            and copy the aspnetbrowser.png to the themes-advanced-skins-default-img folder of the default theme,
            */
            ed.addButton('aspnetbrowser', {
                title: 'StratFord Image Manager',
                cmd: 'mceAspNetBrowser'
            });
        },

        getInfo: function () {
            return {
                longname: 'Codeigniter Plaugin',
                author: 'Mark Angus',
                authorurl: 'http://sugnatech.codeplex.com',
                infourl: 'http://sugnatech.codeplex.com',
                version: tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('aspnetbrowser', tinymce.plugins.AspNetBrowser);
})();