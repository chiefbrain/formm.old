/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/*CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};*/

/*    CKEDITOR.editorConfig = function( config )
    {
        config.skin             = 'kama';
        config.uiColor        = 'red';
        config.language         = 'ru';
        config.fullPage         = false;
        config.height           = 500;
        config.removePlugins    = 'resize,about,save';
    };
*/
	
	// '+CKFSYS_PATH+' — путь к файловому менеджеру у вас, чтото типа 
// /path/to/ckeditor/plugins/filemanager, путь указывать от DOCUMENT_ROOT

if (!myHeight) var myHeight=400;

var PATH = '/general/filemanager';
var TYPE = PATH+'/browser/default/browser.html?Type=';
var CONNECT = '&Connector='+PATH+'/connectors/php/connector.php';
CKEDITOR.editorConfig = function( config ) {
        config.skin             = 'kama';
        config.uiColor        = '#c7c78f';
        config.language         = 'ru';
        config.fullPage         = false;
        config.height           = myHeight;
        config.removePlugins    = 'resize,about,save';

     config.filebrowserImageBrowseUrl = TYPE+'Image'+CONNECT;
     config.filebrowserFileBrowseUrl  = TYPE+'File'+CONNECT;
     config.filebrowserFlashBrowseUrl = TYPE+'Flash'+CONNECT;
     config.filebrowserBrowseUrl      = TYPE+'File'+CONNECT;
}

/*

<script  type="text/javascript">

var PATH = "/general/filemanager";
var TYPE = PATH+"/browser/default/browser.html?Type=";
var CONNECT = "&Connector="+PATH+"/connectors/php/connector.php";

CKEDITOR.replace("ckeditor",{
uiColor: "#333",
height: "400px",
language : "ru",
filebrowserImageBrowseUrl : TYPE+"Image"+CONNECT,
filebrowserFileBrowseUrl  : TYPE+"File"+CONNECT,
filebrowserFlashBrowseUrl : TYPE+"Flash"+CONNECT,
filebrowserBrowseUrl      : TYPE+"File"+CONNECT
});
</script>

config.skin - интерфейс. Возможны три варианта: kama, v2, office2003. По умолчанию kama.
config.uiColor - цвет интерфейса. Работает только для kama.
config.language - Язык интерфейса.
config.fullPage - оплетка для редактируемого документа. Если установлено true то редактируемая область будет содержать полноценный html документ, если false - только контент.
config.height - высота редактируемой области в пикселах. Аналогично для ширины.
config.removePlugins - Список кнопок (плагинов), которые нужно отключить. Например: resize - это благодаря которой область редактора можно растянуть как угодно, удерживая мышью нижний правый угол, save - кнопка сохранить. 
*/