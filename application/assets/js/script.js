var url = new URL(window.location.href);
var postData='';
var itemPerPage=5;
$(document).ready(function() {
            $.ajax({
                url: 'http://api.demo:8080',
                method: "POST",
                dataType: 'json',
                data: {data_action: 'fetch_all'},
                success: function (data) {
					postData=data;
					$("input[name=fetch_title]").val(url.searchParams.get('title'));
					affichage();

                },
                error:function () {
                    alert("echec");
                }
            });
    }
);

function affichage() {

	var page = url.searchParams.get('page');
	if(page == null)page=1;
	$.ajax({
		url: './welcome/pagination',
		type: 'POST',
		data: {data: postData,page:page,titre:url.searchParams.get('title'),itemPerPage:itemPerPage},
		dataType:'JSON',
		success: function(reponse){
			$.each(reponse[0], function(i){
					$('#content').append(
						"<article>" +
						"<div class='titre'>" +
						"<p>"+reponse[0][i]['titre_demande']+"</p>" +
						"<p>"+reponse[0][i]['budget_demande']+"&euro;</p>" +
						"<p>"+reponse[0][i]['date_demande']+"</p>" +
						"</div>" +
						"<p>"+reponse[0][i]['description_demande']+"</p>" +
						"<p>par <span class='user'>"+reponse[0][i]['nom_utilisateur']+"</span></p>" +
						"</article>"
					);
			});
			if(reponse[1]==0){
				$('#content').append(
					"<p class='void'>Aucun resultat</p>"
				)
			}
			pagination(reponse[1]);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(xhr.responseText);
			console.log(thrownError);
		}
	});
}

function pagination(items) {
	$('#pagination').pagination({
		items: items,
		itemsOnPage: itemPerPage,
		hrefTextPrefix: '?page=',
		hrefTextSuffix: (!url.searchParams.get('title'))?'':'&title='+url.searchParams.get('title'),
		cssStyle: 'compact-theme',
		prevText: 'Precedent',
		nextText: 'Suivant',
		currentPage: url.searchParams.get('page'),
	});
}

function searchByTitle() {
	var title = $("input[name=fetch_title]").val();
	url.searchParams.set('page','1');
	url.searchParams.set('title', title);
	$('#content').empty();
	affichage(title);
}
