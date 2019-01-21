jQuery(document).ready(function ($) {
    /**
     * return button
     */
    $('.js-return').click(function (e) {
        e.preventDefault();
        history.back();
    });
});