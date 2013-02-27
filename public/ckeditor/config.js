/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	
    //config.uiColor = '#AADC6E';
	config.extraPlugins = 'internpage';
    config.removePlugins = 'devtools';
    config.toolbar_Basic =
          [
            ['Source','oembed','-', 'Bold', 'Italic', 'TextColor', 'BGColor', '-', 'NumberedList', 'BulletedList' ,'-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull', '-', 'Link', 'Unlink', "Anchor", 'Image','HorizontalRule','Styles','Format','Font','FontSize' ]
      ];
    config.toolbar = 'Basic'; 
};
