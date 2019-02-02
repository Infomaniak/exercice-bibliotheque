$(document).ready(function() {

    //Edit books :
    var tableBooks = $('#editBooks').DataTable({
        "displayLength": 5,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });

    //add book
    var counter = 1;
    $('#addBook').on( 'click', function () {
        tableBooks.row.add( [
            "<input type='text' placeholder='title'>",
            "<input type='text' placeholder='category'>",
            "<input type='text' placeholder='author,author,...'>",
            "<input type='text' placeholder='publisher'>",
            "<input type='date'>",
            "<input type='text' placeholder='synopsis'>",
            "<input type='url' placeholder='cover picture (url)'>",
            "<input type='url' placeholder='pdf (url)'>",
            "<input type='number' placeholder='quantity'>",
            '<i class="fa fa-envelope-o new" aria-hidden="true" style="cursor: pointer"></i>' +
            '<i class="fa fa-minus-square" aria-hidden="true" style="cursor: pointer"></i>'
        ] ).draw( false );

        counter++;
    } );
//TODO : All JS input validations

    //remove
    $('#editBooks').on("mousedown", "td .fa.fa-minus-square", function(e) {
        let title = $(this).closest("tr").find("td").html();
        tableBooks.row($(this).closest("tr")).remove().draw();

        //remove from database :  ajax call to ../Controllers/book.php
        $.ajax({
            type: 'POST',
            dataType: 'text',
            url: '../Controllers/book.php',
            data: {action: "remove", title: title},
            success: function (Data) {
                if(Data !== "") alert(Data); // shows a php error
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("error " + XMLHttpRequest + " " + textStatus + " "+errorThrown);
            }
        });
    })


    //edit
    $("#editBooks").on('mousedown.edit', "i.fa.fa-pencil-square", function(e) {

        $(this).removeClass().addClass("fa fa-envelope-o");
        let $row = $(this).closest("tr").off("mousedown");
        let $tds = $row.find("td").not(':first').not(':last');

        $.each($tds, function(i, el) {
            var txt = $(this).text();
            $(this).html("").append("<input type='text' value=\""+txt+"\">");
        });

    });

    $("#editBooks").on('mousedown', "input", function(e) {
        e.stopPropagation();
    });


    //save
    $("#editBooks").on('mousedown.save', "i.fa.fa-envelope-o", function(e) {
        //frontend save :
        $(this).removeClass().addClass("fa fa-pencil-square");
        let $row = $(this).closest("tr");
        let $tds;
        if($(this).find(".new")) {
            $tds = $row.find("td").not(':last');
            $(this).find(".new").removeClass(".new")
        }
        else {
            $tds = $row.find("td").not(':first').not(':last');
        }
        let data = [];
        $.each($tds, function(i, el) {
            var txt = $(this).find("input").val();
            data[i] = txt;
            $(this).html(txt);
        });
        data[0] = $row.find("td").html();

        //save to database :  ajax call to ../Controllers/book.php
        $.ajax({
            type: 'POST',
            dataType: 'text',
            url: '../Controllers/book.php',
            data: {action: "save", title: data[0], category: data[1], authors: data[2], publisher: data[3], release_date: data[4],
            synopsis: data[5], cover: data[6], pdf: data[7], quantity: data[8]},
            success: function (Data) {
                if(Data !== "") alert(Data); // shows a php error
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("error " + XMLHttpRequest + " " + textStatus + " "+errorThrown);
            }
        });

    });

    $("#editBooks").on('mousedown', "#selectbasic", function(e) {
        e.stopPropagation();
    });

    //See holders :
    var groupColumn = 0;
    var tableHolders = $('#seeHolders').DataTable({
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "order": [[ groupColumn, 'asc' ]],
        "displayLength": 5,
        "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        }
    });
} );

