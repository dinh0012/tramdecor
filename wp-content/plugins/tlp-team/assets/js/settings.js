(function ($) {
    if ($('.tlp-color').length) {
        $('.tlp-color').wpColorPicker();
    }
    if ($("#scg-wrapper .tlp-color").length) {
        var cOptions = {
            defaultColor: false,
            change: function (event, ui) {
                createShortCode();
            },
            clear: function () {
                createShortCode();
            },
            hide: true,
            palettes: true
        };
        $("#scg-wrapper .tlp-color").wpColorPicker(cOptions);
    }
    imageSize();
    $(window).on('load', function () {
        createShortCode();
    });
    $("#rt-feature-img-size").on('change', function () {
        imageSize();
    });
    $("#scg-wrapper").on('change', 'select,input', function () {
        createShortCode();
    });
    $("#sc-layout").on('change', function () {
        var val = $(this).val();
        if (val == 'carousel') {
            $("#carousel-sc").slideDown();
        } else {
            $("#carousel-sc").slideUp();
        }
    });
    $("#scg-wrapper").on("input propertychange", function () {
        createShortCode();
    });

    function createShortCode() {
        var sc = "[tlpteam";
        $("#scg-wrapper").find('input[name],select[name],textarea[name]').each(function (index, item) {
            var v = $(this).val(),
                name = this.name;
            if (this.type === 'checkbox') {
                if (this.checked && $("#sc-layout").val() == 'carousel') {
                    sc = v ? sc + " " + name + "=" + '"' + v + '"' : sc;
                }
            }else{
                sc = v ? sc + " " + name + "=" + '"' + v + '"' : sc;
            }

        });
        sc = sc + "]";
        $("#sc-output textarea").val(sc);
    }

    $("#sc-output textarea").on('click', function () {
        $(this).select();
        document.execCommand('copy');
    });

    function imageSize() {
        var size = $("#rt-feature-img-size").val();
        if (size == "rt_custom") {
            $(".rt-custom-image-size-wrap").show();
        } else {
            $(".rt-custom-image-size-wrap").hide();
        }
    }

})(jQuery);

function tlpTeamSettings(e) {

    jQuery('#response').hide();
    arg = jQuery(e).serialize();
    bindElement = jQuery('#tlpSaveButton');
    AjaxCall(bindElement, 'tlpTeamSettings', arg, function (data) {
        console.log(data);
        if (data.error) {
            jQuery('#response').removeClass('error');
            jQuery('#response').show('slow').text(data.msg);
        } else {
            jQuery('#response').addClass('error');
            jQuery('#response').show('slow').text(data.msg);
        }
    });

}

function AjaxCall(element, action, arg, handle) {
    if (action) data = "action=" + action;
    if (arg) data = arg + "&action=" + action;
    if (arg && !action) data = arg;
    data = data;

    var n = data.search("tlp_nonce");
    if (n < 0) {
        data = data + "&tlp_nonce=" + tpl_nonce;
    }

    jQuery.ajax({
        type: "post",
        url: ajaxurl,
        data: data,
        beforeSend: function () {
            jQuery("<span class='tlp_loading'></span>").insertAfter(element);
        },
        success: function (data) {
            jQuery(".tlp_loading").remove();
            handle(data);
        }
    });
}
