(function() {
    tinymce.create('tinymce.plugins.jwthmetiny', {
        init : function(ed, url) {
            ed.addCommand('shortcodeGenerator', function() {

                tb_show("Top Class Shortcodes", url + '/shortcodes.php?&width=630&height=400');

                
            });
            //Add button
            ed.addButton('jwthemescgenerator', {    title : 'Shortcodes', cmd : 'shortcodeGenerator', image : url + '/shortcode-icon.png' });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : 'JW Theme TopClass TinyMCE',
                author : 'TopClass WordPress Theme',
                authorurl : 'http://www.jwtheme.com',
                infourl : 'http://www.jwtheme.com',
                version : tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });
    tinymce.PluginManager.add('jwtheme_buttons', tinymce.plugins.jwthmetiny);
})();