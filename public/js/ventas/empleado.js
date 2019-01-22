function rand_code(){
	chars="0123456789abc";
	lon=5;
	code = "";
	for (x=0; x < lon; x++)
	{
	rand = Math.floor(Math.random()*chars.length);
	code += chars.substr(rand, 1);
	}
	$('#codigo').val(code);
	$.get(`codigo/${code}`,function(res,sta){
		if(res[0].codigo == null){
			$('#codigo').val(code);
		}else{
			rand_code();
		}
	});
}