(function($) {
    handleSidebarAccordion();
    handleSidebarToggle();
    handleNiceScroll();
    handleDataTables();
    handleDateTimePickers();
    handleTooltips();
    handleFileinputs()
    handleTextToSlug();
    handleDeleteRecordConfirmation();
    window.onload = handleResponsiveView();
    window.onresize = function(){ handleResponsiveView(); };

    function handleSidebarAccordion() {
        $('#nav-accordion').dcAccordion({
            eventType: 'click',
            autoClose: true,
            saveState: false,
            disableLink: true,
            speed: 'slow',
            showCount: false,
            autoExpand: true,
            classExpand: 'dcjq-current-parent'
        });

        $('#sidebar .sub-menu > a').click(function () {
            var o = ($(this).offset());
            var diff = 250 - o.top;
            if (diff > 0)
                $("#sidebar").scrollTo("-=" + Math.abs(diff), 500);
            else
                $("#sidebar").scrollTo("+=" + Math.abs(diff), 500);
        });
    }

    function handleSidebarToggle() {
        $('.fa-bars').click(function () {
            if ($('#sidebar > ul').is(":visible") === true) {
                $('#main-content').css({
                    'margin-left': '0px'
                });
                $('#sidebar').css({
                    'margin-left': '-210px'
                });
                $('#sidebar > ul').hide();
                $("#container").addClass("sidebar-closed");
            } else {
                $('#main-content').css({
                    'margin-left': '210px'
                });
                $('#sidebar > ul').show();
                $('#sidebar').css({
                    'margin-left': '0'
                });
                $("#container").removeClass("sidebar-closed");
            }
        });
    }

    function handleResponsiveView() {
        var wSize = $(window).width();
        if (wSize <= 768) {
            $('#container').addClass('sidebar-closed');
            $('#sidebar > ul').hide();
        }

        if (wSize > 768) {
            $('#container').removeClass('sidebar-closed');
            $('#sidebar > ul').show();
        }
    }

    function handleNiceScroll()
    {
        $('#sidebar').niceScroll({
            cursorcolor:'#ffde17',
            cursorwidth: '3',
            cursorborderradius: '10px',
            background: '#404040',
            spacebarenabled:false,
            cursorborder: ''
        });

        $('html').niceScroll({
            cursorcolor:'#ffde17',
            cursorwidth: '6',
            cursorborderradius: '10px',
            background: '#404040',
            spacebarenabled:false,
            cursorborder: '',
            zindex: '1000'
        });

        $('.stations-container').niceScroll({
            cursorcolor:'#797979',
            cursorwidth: '3',
            cursorborderradius: '10px',
            background: '#f5f5f5',
            spacebarenabled:false,
            cursorborder: '',
            zindex: '1000'
        });
    }

    function handleDataTables()
    {
        $('body').on('change', '.data-table select[name="limit"]', function()
        {
            var form = $(this).closest('form');
            form.find('input[name="page"]').val(1);
            form.submit();
        });

        $('body').on('click', '.data-table a.refresh-table', function()
        {
            var form = $(this).closest('form');
            form.submit();
        });

        $('body').on('click', '.data-table ul.dropdown-menu a', function(e)
        {
            e.stopPropagation();
        });

        $('body').on('click', '.data-table .pagination a', function(e)
        {
            e.preventDefault();
            var url = $(this).attr('href');
            var page = url.split('?page=')[1];
            var form = $(this).closest('.panel').find('form.data-table-form');
            form.find('input[name="page"]').val(page);
            form.submit();
        });

        $('body').on('click', '.data-table a.sortable', function(e)
        {
            e.preventDefault();
            var column = $(this).data('value');
            var order = $(this).hasClass('desc') ? 'asc' : 'desc';
            var form = $(this).closest('.panel').find('form.data-table-form');
            form.find('input[name="sort"]').val(column);
            form.find('input[name="order"]').val(order);
            form.submit();
        });

        $('body').on('change', '.data-table .select-toggle', function()
        {
            var checked = $(this).is(':checked');
            var table = $(this).closest('table');
            table.find('.select-row:not(:disabled)').each(function(element, index)
            {
                if (checked && !$(this).is(':checked'))
                {
                    $(this).prop('checked', true);
                }
                if (!checked && $(this).is(':checked'))
                {
                    $(this).prop('checked', false);
                }
            });
        });

        $('body').on('click', '.data-table .actions .btn-reset', function(e)
        {
            e.preventDefault();
            var form = $(this).closest('form');
            form.find('input[name=page]').val('1');
            form.find('input[name=sort]').val('');
            form.find('input[name=order]').val('');
            form.find('select[name=limit]').val('10');
            form.find('input[name="columns[]"]').each(function(element, index)
            {
                $(this).prop('checked', true);
            });
            form.find('.filters input, .filters select').each(function(element, index)
            {
                $(this).val('');
            });
            form.submit();
        });

        $('body').on('submit', '.data-table form', function()
        {
            $(this).find('.loader').show();
        });

        $('body').on('click', '.data-table form .btn-delete', function(e)
        {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete selected record(s)?'))
            {
                return;
            }
            var url = $(this).attr('href');
            var selectedRows = $.map($('input.select-row:checked'), function(n, i)
            {
                return $(n).data('record-id');
            });
            url += '?' + $.param({rows: selectedRows});
            window.location.href = url;
        });
    }

    function handleDateTimePickers()
    {
        $('.date-time-picker').each(function(element, index)
        {
            $(this).datetimepicker({
                timepicker: $(this).data('type') != 'date-picker',
                datepicker: $(this).data('type') != 'time-picker',
                format: $(this).data('format'),
                step: 15
            });
        });

        $('body').on('click', '.date-time-picker-trigger', function()
        {
            $(this).closest('.input-group').find('.date-time-picker').datetimepicker('show');
        });
    }

    function handleTooltips()
    {
        $('[data-toggle="tooltip"]').tooltip();
    }

    function handleFileinputs()
    {
        $('[data-plugin="fileinput"]')
            .fileinput({
                'showUpload': false,
                'browseClass': 'btn btn-default',
                'removeIcon': '<i class="fa fa-fw fa-trash"></i>',
                'removeLabel': '',
                'browseIcon': '<i class="fa fa-fw fa-folder-open"></i>',
                'browseLabel': ''
            })
            .on('fileloaded', function()
            {
                $(this).closest('.form-group').find('a.thumbnail').remove();
            });
    }

    function handleTextToSlug()
    {
        $('body').on('keyup', '[data-plugin="text-to-slug"]', function(e)
        {
            var target = $(this).data('target');
            var separator = $(this).data('separator') ? $(this).data('separator') : '-';
            var text = $(this).val();
            var slug = convertToSlug(text, separator);
            $(target).val(slug);
        });
    }

    function convertToSlug(text, separator)
    {
        return text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g, separator);
    }

    function handleDeleteRecordConfirmation()
    {
        $('body').on('click', '.btn-delete-record', function(e)
        {
            if (!confirm('Are you sure you want to delete selected record(s)?'))
            {
                e.preventDefault();
            }
        });
    }
})(jQuery);