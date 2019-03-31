function select_type_Over() {
document.getElementById('type_add').style.display='';
}
function select_type_Out() {
document.getElementById('type_add').style.display='none';
}

function vopros(id,name,type) {
if (type==10) type='Папку: "'+name+'"<br/>и все ее содержимое';
else if (type==12) type='Данный контент из папки';
else if (type==20) type='Документ: "'+name+'"';
else if (type==30) type='Ярлык: "'+name+'"';
var f = '<div style="font-weight:800;text-align:center;">Вы уверены, что хотите удалить<br/>'+type+' ?<'+'/'+'div>';
f += '<div style="text-align:center;margin-top:20px;">';
f += '<input type="button" value="Да" style="width:50px;" onclick="window.location.href=\'?a=del&amp;id='+id+'\';" />&nbsp;&nbsp;';
f += '<input type="button" value="Нет" style="width:50px;" onclick="vopros2()" />';
f += '<'+'/'+'div>';
document.getElementById('fon').style.display='block';
document.getElementById('win').innerHTML=f;
document.getElementById('win').style.display='block';
return false;
}
function vopros2() {
document.getElementById('fon').style.display='none';
document.getElementById('win').style.display='none';
}