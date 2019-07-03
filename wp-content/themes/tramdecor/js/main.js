/**
 * Created by dinh0 on 10/7/2018.
 */
jQuery( document ).ready( function( $ ) {
    function toggleMenuMobile() {
        $('body').toggleClass('show-menu-mobile enable-load-effects')
    }

    $(document).ready(function () {
        $(document).on('click', 'header#mobile button.nav-toggle', function () {
            toggleMenuMobile();
        });
        $(document).on('click', '.Mobile-overlay-close', function () {
            toggleMenuMobile();
        })
        $(document).on('click', 'button.Mobile-overlay-nav-item', function () {
            var dataControllerFolder = $(this).data('controller-folder-toggle');
            $('.Mobile-overlay-menu').addClass('has-active-folder');
            $('.Mobile-overlay-folder[data-controller-folder=' + dataControllerFolder + ']').addClass('is-active-folder');
        })
        $(document).on('click', 'button.Mobile-overlay-folder-item.Mobile-overlay-folder-item--toggle', function () {
            var dataControllerFolder = $(this).data('controller-folder-toggle');
            $('.Mobile-overlay-menu').removeClass('has-active-folder');
            $('.Mobile-overlay-folder[data-controller-folder=' + dataControllerFolder + ']').removeClass('is-active-folder');
        })
    });
});