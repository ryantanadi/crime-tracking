$(document).ready(function() {
  var currentPage = 1;
  var entriesPerPage = 5;

  function fetchData() {
    var startIndex = (currentPage - 1) * entriesPerPage;
    var endIndex = startIndex + entriesPerPage;

    $.getJSON('php/officer.php', function(data) {
      $('#officer-table tbody').empty();
      $.each(data.slice(startIndex, endIndex), function(index, row) {
        var tr = $('<tr>').appendTo('#officer-table');
        $('<td>').text(row.badge_number).appendTo(tr);
        $('<td>').text(row.officer_name).appendTo(tr);
        $('<td>').text(row.precinct).appendTo(tr);
        $('<td>').text(row.phone_contact).appendTo(tr);
        $('<td>').text(row.status).appendTo(tr);
        $('<td>').html('<button class="edit-button">Edit</button>').appendTo(tr);
        $('<td>').html('<button class="delete-button">Delete</button>').appendTo(tr);
      });

      var totalPages = Math.ceil(data.length / entriesPerPage);
      $('#page-selection').bootpag({
        total: totalPages,
        page: currentPage,
        maxVisible: 5,
        leaps: true,
        firstLastUse: true,
        first: 'First',
        last: 'Last',
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
      });
    });
  }

  $('#entries-per-page').change(function() {
    entriesPerPage = parseInt($(this).val());
    currentPage = 1;
    fetchData();
  });

  $('#page-selection').on('page', function(event, num) {
    currentPage = num;
    fetchData();
  });

  fetchData();
});
