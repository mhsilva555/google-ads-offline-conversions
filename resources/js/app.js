jQuery(function ($) {

    /**
     * Validate Buttons Actions
     */
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

    /**
     * Delete Lead
     */
    $(document).on('click', '.delete-lead', function (e) {
        e.preventDefault()

        let lead_id = $(this).data('id')

        $.ajax({
            url: obj.ajaxurl,
            method: 'GET',
            data: {
                lead_id: lead_id,
                action: 'delete_lead'
            }
        }).done((response) => {
            document.location.reload()
        })
    });

    /**
     * Save Conversion Name
     */
    $(document).on('click', '.save-conversion-name', function () {
        let conversion_name = $('#conversion_name').val()

        $.ajax({
            url: obj.ajaxurl,
            method: 'GET',
            data: {
                conversion_name: conversion_name,
                action: 'update_conversion_name'
            }
        }).done(() => {
            document.location.reload()
        })
    });

    /**
     * Select All Leads Table
     */
    $(document).on('change', '#select-all', function () {
        let btn_export = $('#btn-export');
        let btn_delete = $('#btn-delete');
        let check_export = $('.check-export');

        if ($(this).prop('checked')) {
            check_export.prop('checked', true)
            btn_export.prop('disabled', false)
            btn_delete.prop('disabled', false)
        } else {
            check_export.prop('checked', false)
            btn_export.prop('disabled', true)
            btn_delete.prop('disabled', true)
        }
    })

    /**
     * Delete Action
     */
    $(document).on('click', '#btn-delete', function (e) {
        e.preventDefault();

        let delete_list = []

        $('.check-export').each((index, element) => {
            if (element.checked) {
                delete_list.push(element.value)
            }
        })

        $.ajax({
            url: obj.ajaxurl,
            method: 'GET',
            data: {
                lead_id: delete_list,
                action: 'delete_lead'
            }
        }).done((response) => {
            document.location.reload()
        })
    })

    /**
     * Export Action
     */
    $(document).on('click', '#btn-export', function (e) {
        e.preventDefault()

        let export_list = []

        $('.check-export').each((index, element) => {
            if (element.checked) {
                export_list.push(element.value)
            }
        })

        $.ajax({
            url: obj.ajaxurl,
            method: 'GET',
            data: {
                lead_id: export_list,
                action: 'export_lead'
            }
        }).done((response) => {
            document.location.reload()
        })
    })

    /**
     * Delete Export
     */
    $(document).on('click', '.delete-export', function (e) {
        e.preventDefault()

        let export_file = $(this).data('file')

        $.ajax({
            url: obj.ajaxurl,
            method: 'GET',
            data: {
                export_file: export_file,
                action: 'delete_export'
            }
        }).done((response) => {
            document.location.reload()
        })
    })
});