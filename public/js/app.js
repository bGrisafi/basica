//PORTFOLIO MORE WORKS
$('body').on('click','#more-works', function(e){
  e.preventDefault();
  var url = $(this).attr('data-url');
  var offset = $(this).attr('data-offset');
  var limit = $(this).attr('data-limit');
  if (offset != -1) {
    $.ajax({
        url: url,
        method: 'get',
        data: {
          'offset': offset,
          'limit': limit
        },
        success: function(reponseSrv){

            $('#more-ajax').append(reponseSrv).find('ul:last-of-type').hide().slideDown();
            $('#more-works').attr('data-offset', ((offset*1) + (limit*1)));
            if($("#noMore").length > 0){//si la vue chargée par le controller est la vue "_noMore.html.twig"
              $('#more-works').attr('data-offset', (-1));
            }
            /*$('#ajax').fadeOut(function(){
              $('#ajax').html(reponseSrv).fadeIn();
            });*/

        },
        error: function(){
          window.alert("Problème durant la transaction...");
        }
    });
  }

});

//BLOG
$('body').on('click', '#pagination a', function(e){
  e.preventDefault();

  //VARIABLES
  var url = $('#pagination').attr('data-url');
  var offset = $('#pagination').attr('data-offset');
  var limit = $('#pagination').attr('data-limit');
  var page = $('#pagination').attr('data-page');
  var locale = $('#pagination').attr('data-locale');
  var lastPage = $('#data-lastPage').attr('data-lastPage');
  var traductions = { "dernierePage" : { "fr": "Plus d'autres articles", "en": "No more posts to show"} };

  //SUIVANT
  if ($(this).attr('data-value') == 'suiv') {

    if (page*1 + 1 <= lastPage) {
      //requete ajax
      blogAjax(url, limit, offset*1+limit*1);

      //changement d'offset
      $('#pagination').attr('data-offset',offset*1+limit*1);

      //changement de page dans la pagination
      page = changePage(page, true);
    }

  }

  //PRECEDENT
  else if ($(this).attr('data-value') == 'prec') {
    if (page > 1) {//empeche la requete d avoir lieu si le précédent est désactivé
      //requete ajax
      blogAjax(url, limit, offset-limit);

      //changement d'offset
      $('#pagination').attr('data-offset',offset*1-limit*1);

      //changement de page dans la pagination
      page = changePage(page, false);

    }

  }

  //NUMERO
  else{
    //vérifie qu'il ne s'agit pas de la page actuelle
    if (!$(this).parent('li').hasClass('active')) {

      //change l'offset selon la page sur laquelle on clique
      offset = $(this).attr('data-value')*limit;
      $('#pagination').attr('data-offset', offset);

      //requete ajax
      blogAjax(url, limit, offset-limit);

      //retire le active
      $('[data-value = "'+ page +'"]').parent('li').removeClass('active');
      //change la valeur de page a la page actuelle
      page = $(this).attr('data-value');

      //change les valeurs de la page courranter et l'offset
      $('#pagination').attr('data-page', page);
      $('#pagination').attr('data-offset',offset-limit);

      //mets le active
      $('[data-value = "'+ page +'"]').parent('li').addClass('active');

    }
  }

  //verification d etat du bouton suivant
  checkButtonState('suiv', page, lastPage);

  //passe le précédent en disabled si on est sur 1
  checkButtonState('prec', page, 1);


});


//FONCTIONS

function blogAjax(url, limit, offset){
  $.ajax({
      url: url,
      method: 'get',
      data: {
        'offset': offset,
        'limit': limit
      },
      success: function(reponseSrv){
          $('#articles-ajax').fadeOut(function(){
            $(this).html(reponseSrv).fadeIn();
          });

      },
      error: function(){
        window.alert("Problème durant la transaction...");
      }
  });
}

function changePage(pageCourrante, sens){
  //retrait du active sur la page actuelle
  $('[data-value = "'+ pageCourrante +'"]').parent('li').removeClass('active');
  if (sens) {//si on est dans le suivant
    pageCourrante++;
  }else{//si on est dans le précédent
    pageCourrante--;
  }
  //ajout du active
  $('[data-value = "'+ pageCourrante +'"]').parent('li').addClass('active');
  //modification du data-page
  $('#pagination').attr('data-page',pageCourrante);
  return pageCourrante;
}

function checkButtonState(classe, page, comparator){
  if (page == comparator) {
    $('[data-value = "'+ classe +'"]').parent('li').addClass('disabled');
  } else{
    $('[data-value = "'+ classe +'"]').parent('li').removeClass('disabled');
  }
}
