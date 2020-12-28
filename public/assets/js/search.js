$(function (){
  searchEvents();
  modifyInputSearch();
  modifySelectSearch();
  checkEnterSearch();
  clickButtonSearch();
});

function modifyInputSearch() {
  $('#search-input').keydown(function () {
    $('#search-select').prop('selectedIndex',0);
  });
}

function modifySelectSearch() {
  $('#search-select').on('change', function() {
    $('#search-input').val('');
  });
}

function checkEnterSearch() {
  $('#search input').keydown(function (event) {
      if (event.keyCode == 13 || event.which == 13) {
        event.preventDefault();
        searchEvents();
        return false;
      }
  });
}

function clickButtonSearch() {
  $("#search-button").click(function(event) {
    event.preventDefault();
    searchEvents();
    return false;
  });
}

function searchEvents()
{
  $.ajax({
    type: 'POST',
    url: '/events/search',
    data: $('#search').serialize(),
    dataType: 'json',
    success: function (response) {
      $('#programming').html('');
      if(response.length > 0) {
        response.forEach(function (event) {
          let date = convertDate(event.date_time);
          let eventHtml = '<div class="card col-3 m-3 p-3">' +
            '<a href="/events/detail/' + event.id + '" title="' + event.title + '">' +
              '<img src="' + event.picture + '" class="card-img" alt="' + event.title + '">' +
            '</a>' +
            '<div class="card-body">' +
              '<h5 class="card-title">' + event.title + '</h5>' +
              '<p class="card-text">Le ' + date + '</p>' +
              '<a href="/events/detail/' + event.id + '" class="btn btn-outline-orange">Détails</a>' +
            '</div>' +
          '</div>';
          $('#programming').append(eventHtml);
        });
      } else {
        $('#programming').append('<p>Aucun résultat ne correspond à votre recherche...</p>');
      };
      return false;
    },
    error: function (error) {
        /* popupError(' Cette requete n\'a pas aboutie'); */
        return false;
    }
  })
}

function convertDate(format) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(format)
  return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/')
}
