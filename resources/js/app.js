jQuery(function ($) {

    $(document).on('click', '.check-export', function (e) {
        let btn_export = $('#btn-export');
        let btn_delete = $('#btn-delete');
        let inputs = $('.check-export');
        let validate = [];

        inputs.each((index, value) => {
            validate.push(value.checked)
        })

        if ($.inArray(true, validate) !== -1) {
            btn_export.attr('disabled', false)
            btn_delete.attr('disabled', false)
        } else {
            btn_export.attr('disabled', true)
            btn_delete.attr('disabled', true)
        }
    });

});