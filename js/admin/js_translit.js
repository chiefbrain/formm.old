function translit(v,type) {
//var type='<?= $get_type; ?>';
var dop='';
var rus=new Array("а","б","в","г","д","е","ё","ж","з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","ь","ы","ъ","э","ю","я");
var RUS=new Array("А","Б","В","Г","Д","Е","Ё","Ж","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ь","Ы","Ъ","Э","Ю","Я");
var lat=new Array("a","b","v","g","d","e","e","j","z","i","i","k","l","m","n","o","p","r","s","t","u","f","h","c","ch","sh","sh","-","y","-","ye","yu","ya");
var LAT=new Array("A","B","V","G","D","E","E","J","Z","I","I","K","L","M","N","O","P","R","S","T","U","F","H","C","CH","SH","SH","-","Y","-","YE","YU","YA");

function str_replace ( search, replace, subject ) {	// Replace all occurrences of the search string with the replacement string
	if(!(replace instanceof Array)){
		replace=new Array(replace);
		if(search instanceof Array){//If search	is an array and replace	is a string, then this replacement string is used for every value of search
			while(search.length>replace.length){
				replace[replace.length]=replace[0];
			}
		}
	}
	if(!(search instanceof Array))search=new Array(search);
	while(search.length>replace.length){//If replace	has fewer values than search , then an empty string is used for the rest of replacement values
		replace[replace.length]='';
	}
	if(subject instanceof Array){//If subject is an array, then the search and replace is performed with every entry of subject , and the return value is an array as well.
		for(k in subject){
			subject[k]=str_replace(search,replace,subject[k]);
		}
		return subject;
	}
	for(var k=0; k<search.length; k++){
		var i = subject.indexOf(search[k]);
		while(i>-1){
			subject = subject.replace(search[k], replace[k]);
			i = subject.indexOf(search[k],i);
		}
	}
	return subject;
}
v=v.replace(/\s/g,'_') 
v=str_replace(rus,lat,v);
v=str_replace(RUS,LAT,v);
if (type==20 && v!='') dop = '.html';
document.add_form.add_translit.value=v+dop;
}