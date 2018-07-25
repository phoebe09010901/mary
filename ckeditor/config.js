/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.uiColor = '#14B8C4';
	config.filebrowserBrowseUrl = '../ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '../ckfinder/ckfinder.html?type=Images';
	config.filebrowserBrowseUrl = '../ckfinder/ckfinder.html?type=Flash';
	config.filebrowserBrowseUrl = '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserBrowseUrl = '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserBrowseUrl = '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
	config.enterMode = CKEDITOR.ENTER_BR;   //避免內文自動幫你加 <p>
	config.allowedContent = true;
};