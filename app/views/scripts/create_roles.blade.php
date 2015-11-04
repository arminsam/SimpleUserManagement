<script>
    (function($) {
        $('body').on('click', 'a[data-toggle="select-capabilities"]', function()
        {
            var checkboxes = $(this).closest('.capabilities-container').find('input:checkbox');
            $(this).toggleClass('selected');

            if ($(this).hasClass('selected'))
            {
                checkboxes.prop('checked', true)
            }
            else
            {
                checkboxes.removeAttr('checked');
            }
        });
    })(jQuery);
</script>
