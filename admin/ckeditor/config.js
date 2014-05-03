/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
            config.skin  = 'kama'; //kama, office2003, V2
            config. language  ='th';
            config.extraPlugins = 'uicolor';
            config.uiColor='#006699';
            config. height  =300;
            config.width  =900;
			
			config.toolbar_Full =
			[
				['Source','-','Save','NewPage','Preview','-','Templates'],
				['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
				['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
				'/',
				['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
				['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
				['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
				['Link','Unlink','Anchor'],
				['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],				
				['TextColor','BGColor'],
				['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],				
				'/',
				['Styles','Format','Font','FontSize'],
				['Maximize', 'ShowBlocks','-','About']
			];
			
            config.filebrowserBrowseUrl ='ckfinder/ckfinder.html';
            config.filebrowserImageBrowseUrl ='ckfinder/ckfinder.html?Type=Images';
            config.filebrowserFlashBrowseUrl ='ckfinder/ckfinder.html?Type=Flash';
            config.filebrowserUploadUrl ='ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
            config.filebrowserImageUploadUrl ='ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
            config.filebrowserFlashUploadUrl ='ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
};
