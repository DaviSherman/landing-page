/* global redux_change, wp */

jQuery(document).ready(function () {

    jQuery('.redux-custom_field-remove').live('click', function () {
        redux_change(jQuery(this));
        jQuery(this).parent().siblings().find('input[type="text"]').val('');
        jQuery(this).parent().siblings().find('textarea').val('');
        jQuery(this).parent().siblings().find('input[type="hidden"]').val('');

        var slideCount = jQuery(this).parents('.redux-container-custom_field:first').find('.redux-custom_field-accordion-group').length;

        if (slideCount > 1) {
            jQuery(this).parents('.redux-custom_field-accordion-group:first').slideUp('medium', function () {
                jQuery(this).remove();
            });
        } else {
            jQuery(this).parents('.redux-custom_field-accordion-group:first').find('.remove-image').click();
            jQuery(this).parents('.redux-container-custom_field:first').find('.redux-custom_field-accordion-group:last').find('.redux-custom_field-header').text("New Slide");            
        }
    });

    jQuery('.redux-custom_field-add').click(function () {

        var newSlide = jQuery(this).prev().find('.redux-custom_field-accordion-group:last').clone(true);
        var slideCount = jQuery(newSlide).find('input[type="text"]').attr("name").match(/[0-9]+(?!.*[0-9])/);
        var slideCount1 = slideCount*1 + 1;

        jQuery(newSlide).find('input[type="text"], input[type="hidden"], textarea').each(function(){

            jQuery(this).attr("name", jQuery(this).attr("name").replace(/[0-9]+(?!.*[0-9])/, slideCount1) ).attr("id", jQuery(this).attr("id").replace(/[0-9]+(?!.*[0-9])/, slideCount1) );
            jQuery(this).val('');
            if (jQuery(this).hasClass('slide-sort')){
                jQuery(this).val(slideCount1);
            }
        });

        jQuery(newSlide).find('.screenshot').removeAttr('style');
        jQuery(newSlide).find('.screenshot').addClass('hide');
        jQuery(newSlide).find('.screenshot a').attr('href', '');
        jQuery(newSlide).find('.remove-image').addClass('hide');
        jQuery(newSlide).find('.redux-custom_field-image').attr('src', '').removeAttr('id');
        jQuery(newSlide).find('h3').text('').append('<span class="redux-custom_field-header">New slide</span><span class="ui-accordion-header-icon ui-icon ui-icon-plus"></span>');
        jQuery(this).prev().append(newSlide);
    });

    jQuery('.slide-title').keyup(function(event) {
        var newTitle = event.target.value;
        jQuery(this).parents().eq(3).find('.redux-custom_field-header').text(newTitle);
    });

    jQuery(function () {
        jQuery(".redux-custom_field-accordion")
            .accordion({
                header: "> div > fieldset > h3",
                collapsible: true,
                active: false,
                heightStyle: "content",
                icons: { "header": "ui-icon-plus", "activeHeader": "ui-icon-minus" }
            })
            .sortable({
                axis: "y",
                handle: "h3",
                connectWith: ".redux-custom_field-accordion",
                start: function(e, ui) {
                    ui.placeholder.height(ui.item.height());
                    ui.placeholder.width(ui.item.width());
                },
                placeholder: "ui-state-highlight",
                stop: function (event, ui) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.children("h3").triggerHandler("focusout");
                    var inputs = jQuery('input.slide-sort');
                    inputs.each(function(idx) {
                        jQuery(this).val(idx);
                    });
                }
            });
    });




});