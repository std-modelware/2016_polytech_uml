/// <reference path="../../3rd/jquery/jquery.d.ts" />
/// <reference path="../../3rd/bootstrap/js/bootstrap.d.ts" />
/// <reference path="Ajax.d.ts" />

namespace Ajax {
    export function postJson(url:string, options?:JQueryAjaxSettings) {
        options = options || {};
        options.dataType = 'json';
        options.method = 'POST';

        var dataToSend = options.data;
        if (typeof dataToSend == "string") {
            dataToSend = JSON.parse(dataToSend);
        }
        dataToSend = dataToSend || {};
        dataToSend.isAjax = true;

        options.data = dataToSend;
        var success = options.success;

        options.success = function (data:IAjaxData, textStatus:string, jqXHR:JQueryXHR) {
            if (data.RedirectUrl) {
                redirect(data.RedirectUrl, data.ActionData);
                return;
            }

            if (data.ModalView) {
                $("#modal-content").replaceWith(data.ModalView.Html);

                if (success) {
                    success(data.ActionData, textStatus, jqXHR);
                }

                $(data.ModalView.Selector).modal({
                    backdrop: 'static',
                    keyboard: false
                });
                return;
            }

            if (data.Views && data.Views.length > 0) {
                for (var i = 0; i < data.Views.length; i++) {
                    var view = data.Views[i];
                    $(view.Selector).replaceWith(view.Html);
                }
            }

            if (success) {
                success(data.ActionData, textStatus, jqXHR);
            }
        }

        return $.ajax(url, options);
    }

    export function redirect(url:string, data?:any) {
        if (data)
            data = "?" + $.param(data);
        else
            data = "";
        window.location.href = url + data;
    }
}