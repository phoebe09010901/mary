function getDemoTheme() {
    var theme = document.body ? $.data(document.body, 'theme') : null
    if (theme == null) {
        theme = '';
    }
    else {
        return theme;
    }
    var themestart = window.location.toString().indexOf('?');
    if (themestart == -1) {
        return '';
    }

    var theme = window.location.toString().substring(1 + themestart);
    if (theme.indexOf('(') >= 0)
    {
        theme = theme.substring(1);
    }
    if (theme.indexOf(')') >= 0) {
        theme = theme.substring(0, theme.length-1);
    }

    var url = "../../jqwidgets/styles/jqx." + theme + '.css';

    if (document.createStyleSheet != undefined) {
        var hasStyle = false;
        $.each(document.styleSheets, function (index, value) {
            if (value.href != undefined && value.href.indexOf(theme) != -1) {
                hasStyle = true;
                return false;
            }
        });
        if (!hasStyle) {
            document.createStyleSheet(url);
        }
    }
    else {
        var hasStyle = false;
        if (document.styleSheets) {
            $.each(document.styleSheets, function (index, value) {
                if (value.href != undefined && value.href.indexOf(theme) != -1) {
                    hasStyle = true;
                    return false;
                }
            });
        }
        if (!hasStyle) {
            var link = $('<link rel="stylesheet" href="' + url + '" media="screen" />');
            link[0].onload = function () {
                if ($.jqx && $.jqx.ready) {
                    $.jqx.ready();
                };
            }
            $(document).find('head').append(link);
        }
    }
    $.jqx = $.jqx || {};
    $.jqx.theme = theme;
    return theme;
};
var theme = '';