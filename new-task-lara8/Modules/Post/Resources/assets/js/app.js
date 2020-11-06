const { isEmpty } = require("lodash");
(function ($) {
    jQuery.ajaxSetup({
        cache: false,
    });
    var lara
    lara = {
        _callApi: function (
            urn,
            method,
            parameters,
            callback,
            contentType = "application/x-www-form-urlencoded",
        ) {
            let options = {
                url: urn,
                type: method,
                data: parameters,
                contentType: contentType,
                success: eval(callback),
                error: eval('lara.errorHandle'),

            };
            if (contentType === false) {
                options.processData = false;
                options.contentType = false;
            }

            $.ajax(options);
        },
        getDescription: function (slug) {

            var urn = 'post/show';
            var method = 'get';
            var parameters = {};
            parameters.slug = slug;
            var callback = "lara.showDescription";
            lara._callApi(
                urn,
                method,
                parameters,
                callback
            );

        },
        showDescription: function (d) {

            $('#postDesc').html();
            $('#postDesc').html(d.result[0].description);

        },
        destroyPost(slug) {
            var confirmation = confirm("Are you sure you want to delete this post?");
            if (confirmation == true) {
                var urn = 'post/delete';
                var method = 'get';
                var parameters = {};
                parameters.slug = slug;
                var callback = "lara.refreshPage";
                lara._callApi(
                    urn,
                    method,
                    parameters,
                    callback
                );
            }
        },
        refreshPage: function (d) {

            var url = new URL(window.location.href);
            location.replace(url);

        },
        errorHandle: function (d) {

            $('.custom-field-error').remove();
            if (d.responseJSON.errors) {
                jQuery.each(d.responseJSON.errors, function (i, item) {
                    console.log(i + '' + item[0]);
                    $('#' + i).after(
                        '<div class="custom-field-error"><span class="text-danger">' +
                        item[0] +
                        "</span></div>"
                    );
                });
            }

        },
    }
    window.lara = lara;

})(jQuery);