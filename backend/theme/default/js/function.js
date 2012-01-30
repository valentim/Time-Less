$(document).ready(function(){
	var URL = "localhost/cms/admin/";
	
	$("#form").validate({
		submitHandler: function(form) {
			var galeria = $('.galeria').val(),
				status = $('.status').val(),
				controler = URL+"galerias/cadastra",
				pattern = /editar/; 
		
			if(pattern.test(window.location.href)) {
				controler = window.location.href;
			}
			
			$.post(controler, {nome: galeria, status: status}, function(data){
				if(data == "existe") {
					alert("Essa galeria já existe");
				} else {
					alert("Galeria cadastrada com sucesso!");
				}
			});
		}
	});
	
	$('.acoes a:eq(1)').click(function(){
		var excluir = confirm("Gostaria de excluir essa galeria?");
		if(!excluir) {
			return false;
		}
	});
});