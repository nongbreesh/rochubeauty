<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Replace Textareas by Class Name - CKEditor Sample</title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type" />
	<script type="text/javascript" src="ckeditor.js"></script>
	
</head>
<body>
	<h1>
		CKEditor Sample
	</h1>
	<!-- This <div> holds alert messages to be display in the sample page. -->
	<div id="alerts">
		<noscript>
			<p>
				<strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript
				support, like yours, you should still see the contents (HTML data) and you should
				be able to edit it normally, without a rich editor interface.
			</p>
		</noscript>
	</div>
	<form action="sample_test.php" method="post" enctype="multipart/form-data" >
		<p>
			<label for="editor1">
				Editor 1:</label><br />
			<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"></textarea>
			    <script type="text/javascript">
        //<![CDATA[
            CKEDITOR.replace( 'editor1',{


            filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?Type=Images',
            filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?Type=Flash',
            filebrowserUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

            } );
        //]]>
    </script>
		</p>
		<p>
			<input type="submit" value="Submit" />
		</p>
	</form>
	<div id="footer">
		<hr />
		<p>
			CKEditor - The text editor for Internet - <a href="http://ckeditor.com/">http://ckeditor.com</a>
		</p>
		<p id="copy">
			Copyright &copy; 2003-2010, <a href="http://cksource.com/">CKSource</a> - Frederico
			Knabben. All rights reserved.
		</p>
	</div>
</body>
</html>
