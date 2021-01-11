function editMainRow(id) {
    $('.dropdown').hide();
    $.ajax({
        type: "POST",
        url: "/ajax/editMain",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
        }
    })
        .done(function (report) {
            $('#row' + id).html(report);
        });
}
function saveMainRow(id) {
    $('.dropdown').show();
    $.ajax({
        type: "POST",
        url: "/ajax/saveMain",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id,
            d: $('#d').val(),
            invoice: $('#invoice').val(),
            art: $('#art').val(),
            outgo: $('#outgo').val(),
            cash: $('#cash').val(),
            comment: $('#comment').val()
        }
    })
        .done(function (report) {
            $('#row' + id).html(report);
        });
}
