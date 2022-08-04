
// появление таблицы
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        $('.loading').hide(300);
        $('.table-wrap').show(300);
    }, 500);
    // checkTaskRequest();
});

// Фильтр option
jQuery.fn.filterByText = function (filter) {
    let select = this;
    let toLowerFilter = filter[0].value.toLowerCase();

    let options = $("#" + select[0].id + " option");
    for (let i = 0; i < options.length; i++) {
        if (options[i].text.toLowerCase().indexOf(toLowerFilter) < 0) {
            $(options[i]).css({display:'none'});
        }
        else {
            $(options[i]).css({display:'block'});
        }
    }
};


/**
 * !!!
 */
$(document).ready(function () {
    'use strict';

    $('[data-toggle="tooltip"]').tooltip(); // tooltip's
    $('[data-toggle="popover"]').popover(); // popover's

    // отрисовка многофункциональной таблицы
    // Setup - add a text input to each footer cell
    $('#dataTable tfoot th').each(function () {
        let title = $(this).text();
        $(this).html('<input class="other-filter" type="text" placeholder="Поиск по ' + title + '" />');
    });

    // DataTable
    let table = $('#dataTable').DataTable({
        bPaginate: false,
        info: false,
        // searching: false,
        aLengthMenu: [
            [10, 25, 50, 100, 200, 500, 1000, -1],
            [10, 25, 50, 100, 200, 500, 1000, "All"]
        ],
        iDisplayLength: 10,
        language: {
            "processing": "Подождите...",
            "search": "Поиск:",
            "lengthMenu": "Показать _MENU_ записей",
            "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
            "infoEmpty": "Записи с 0 до 0 из 0 записей",
            "infoFiltered": "(отфильтровано из _MAX_ записей)",
            "infoPostFix": "",
            "loadingRecords": "Загрузка записей...",
            "zeroRecords": "Записи отсутствуют.",
            "emptyTable": "В таблице отсутствуют данные",
            "paginate": {
                "first": "Первая",
                "previous": "Предыдущая",
                "next": "Следующая",
                "last": "Последняя"
            },
            "aria": {
                "sortAscending": ": активировать для сортировки столбца по возрастанию",
                "sortDescending": ": активировать для сортировки столбца по убыванию"
            },
            "select": {
                "rows": {
                    "0": "Кликните по записи для выбора",
                    "1": "Выбрана одна запись",
                    "_": "Выбрано записей: %d"
                }
            }
        }
    });

    // Apply the search
    table.columns().every(function () {
        let that = this;

        $('input', this.footer()).on('keyup change clear', function () {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
    });
});
