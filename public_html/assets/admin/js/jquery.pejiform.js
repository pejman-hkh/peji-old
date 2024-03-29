var formResponse = {};
(function(e) {
    var iter_response = 0;
    e.pejiFormResponse = function(a) {
        formResponse[iter_response++] = a
    }
    e.fn.pejiForm = function(t) {
        var n = {
            start_load: function() {},
            elements_ok: function() {},
            elements_no: function() {},
            response: function() {},
            check: function() {},
            start_form_validate: function() {},
            send: !0,
            all_elements_ok: function() {},
            before_submit: function() {},
            after_submit: function() {},
            bind: "submit"
        };
        var r = e.extend(n, t);
        return this.not('[pejiForm="true"]').each(function() {
            $(this).attr('pejiForm', !0);
            submited = "";
            e(this).find("[type='submit']").unbind("click").bind("click", function() {
                if (typeof $(this).attr("name") != 'undefined') {
                    submited = "&" + e(this).attr("name") + "=ok"
                }
            });
            r.before_submit(this);
            e(this).bind(r.bind, function() {
                r.after_submit(this);
                pat_arr = new Array;
                pat_arr.email = /^[a-zA-Z0-9-._]+@[a-zA-Z0-9-._]+\.[a-zA-Z0-9-._]{2,4}$/i;
                pat_arr.url = /www\.[a-zA-Z0-9-._]+\.[a-zA-Z]{2,4}/i;
                pat_arr.user = /^[a-zA-Z0-9-._]{3,20}$/;
                pat_arr.pass = /^[a-zA-Z0-9-._]{5,20}$/;
                pat_arr.number = /^([0-9]+)$/;
                form = this;
                error = "";
                e(this).find("input, select, textarea").not("[type=submit]").each(function() {

                   
                    r.start_form_validate(form, this);
                    val = e(this).val();
                    if (typeof e(this).attr("error") != "undefined" && e(this).attr("error") != "") {
                        if (val == "" || val == 0 ) {
                            error = e(this).attr("error")
                        }
                    }
                    if (typeof e(this).attr("check") != "undefined" && e(this).attr("check") != "" && e(this).val() != "") {
                        element = this;
                        for (key in pat_arr) {
                            value = pat_arr[key];
                            if (e(element).attr("check") == key) {
                                if (!val.match(new RegExp(value))) {
                             
                                    error = r.check(element, key, pat_arr);
                                }
                            }
                        }
                    }
                    $(this).parents().each(function() {
                        if ($(this).css("display") == "none") {
                            error = ''
                        }
                    });
                    if (typeof $(this).attr("disabled") != 'undefined') {
                        error = ''
                    }
                    if (error != "") {
                        r.elements_no(this, error);
                        return !1
                    } else {
                        r.elements_ok(this, error)
                    }
                });
                if (error != "") {
                    return !1
                }

                    
                r.all_elements_ok();
                if (r.send) {

                    r.before_serialize(form);


                    data = e(this).serialize();
                    data += '&ajax=true';


                    ajax_method = e(this).attr("ajax_method");
                    if (typeof e(this).attr("ajax_method") == "undefined") {
                        ajax_method = "post"
                    }
                    action = e(this).attr("action") + (e(this).attr("action").indexOf('?') == -1 ? '?' : '&') + 'ajax';
                    e.ajax({
                        type: ajax_method,
                        dataType: 'json',
                        url: action,
                        data: data + submited,
                        beforeSend: function(e) {
                            r.start_load(form)
                            r.before_send(form)
                        },
                        success: function(e) {
                            r.response(form, e)
                        }
                    });

                    return !1
                }
            })
        })
    }
})(jQuery);


$(__do_pejiForm = function() {
    $(".ajax").pejiForm({
        before_submit: function(form) {
            $(form).find('*[error]').addClass('is-invalid1')
        },
        before_serialize: function( form ) {
            
            
            try {
                for( var x in window.editors ) {
                    window.editors[x].updateSourceElement();  
                }
            } catch( e ) {

            }
            
            $(form).find("input[type='text']").each(function() {
     
                $(this).val( $(this).val() );
            });

            if (typeof $.fn.unpriceFormat === 'undefined') return !1;
            var pr_in = $(form).find('.price_format').each(function() {
                $(this).unpriceFormat();
                $(this).val($(this).unmask())
            })
        },
        before_send: function() {
            $(".pejiform-check").remove();
            var sbmt = $(form).find('button[type="submit"]');
            sbmt.data('html', sbmt.html()).html('Loading ... ');
            sbmt = $(form).find('input[type="submit"]');
            sbmt.each(function() {
                $(this).data('val', $(this).val()).val('Loading ... ')
            })
        },
        start_form_validate: function(e, t) {
            $(t).each(function() {
                if ($(this).val() == $(this).attr("error") || $(this).val() == $(this).attr("check")) {
                    $(t).val("")
                }
            })
        },
        start_load: function(e) {
            $(e).css("position", "relative");
            //show_load()
        },
        elements_no: function(e, t) {
            if (!t) t = "";
            $(".is-invalid").removeClass("is-invalid");
            if ($(e).parents(".selector:first").length > 0) {
                $(".selector").removeClass("alert1");
                $(e).parents(".selector:first").addClass("alert1")
            }
       
            $(".pejiform-check").remove();

            h = $('<span class="pejiform-check text-danger">' + t + '</span>');
          
            $(e).after(h)
       
            $(e).focus().addClass("is-invalid").bind("keydown click", function() {
                if ($(this).prev().text() === t) {
                    $(this).prev().remove().unbind("keydown").unbind("click")
                }
            });
       
            $(e).focus();
        },
        elements_ok: function(e) {},
        response: function(e, t) {
            if (typeof formResponse !== 'undefined') {
                for (x in formResponse) {
                    formResponse[x](e, t)
                }
            }
            $("img[src*='captcha']").attr('src', '/captcha?t=' + Math.random(0, 9999));
            if (t == null) {
                //hide_load();
                return !1
            }
            if (typeof t.status == 'undefined') {
                s = 0
            } else {
                s = t.status
            }
            if (t != null && t != '') {
                now_form = e;
                empty_form = ((s == 0) ? '' : '')
                if ($(e).prev().hasClass("alert-danger") || $(e).prev().hasClass("alert-success")) {
                    $(e).prev().removeClass().addClass('alert-dismissable').addClass('form-error-box').addClass(((s == 0) ? 'alert alert-danger' : 'alert alert-success')).html('' + t.msg + empty_form)
                } else {
                    $('<div class="' + ((s == 0) ? 'alert alert-danger' : 'alert alert-success') + ' alert-dismissable form-error-box">' + t.msg + empty_form + '</div>').insertBefore(e).hide().slideDown()
                }
            }
            $(".loader").fadeOut(function() {
                $(this).remove()
            });
            $(e).find(".is-invalid").removeClass('is-invalid');
            pos = $(".form-error-box").offset();
            $("html,body").animate({
                scrollTop: pos.top - 200
            }, 800);
            //hide_load();
            var sbmt = $(e).find('button[type="submit"]');
            sbmt.html(sbmt.data('html'));
            sbmt = $(e).find('input[type="submit"]');
            sbmt.each(function() {
                $(this).val($(this).data('val'))
            });
            if (typeof $.fn.unpriceFormat !== 'undefined') {
                $(form).find('.price_format').priceFormat({
                    prefix: '',
                    suffix: '',
                    centsLimit: 0
                })
            }
        },
        check: function(e, t, n) {

            return typeof $(e).attr("check_error") !== 'undefined' ? $(e).attr("check_error") : "نادرست است";
        }
    })
});
