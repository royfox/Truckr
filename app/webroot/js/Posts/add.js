$(document).ready(function() {
    var $postAddForm = $('#PostAddForm');
    $postAddForm.find('.checkbox_modifier').click(function() {
        var $clickedSpan = $(this);
        $postAddForm.find('.checkbox input[type=checkbox]').each(function(index, $checkbox) {
            if ($clickedSpan.attr('select') === "true") {
                $checkbox.setAttribute('checked', true);
            } else {
                $checkbox.removeAttribute('checked');
            }
        });
    });
});
