(function () {
    var app_url = $("#app_url").text();
    $("#app_url").remove();
    var api_url = `${app_url}/api/`;
    var states = {};
    var state_code = "DL";
    var purpose_type = "";
    var href = "beds";
    var list_ul_html = '<div class="list_ul">$1</div>';
    var list_li_html = '<div class="list_li" $1="$2"> <div class="listLogo"> <div class="listLogoStyle">$3</div></div><div class="listTextContainer"> <div class="listTextStyle">$4</div><div class="listTextDetailStyle">$5</div></div><div class="listNavigationIcon"> <span class="material-icons">chevron_right</span> </div></div>';
    var no_data_available = '<div class="no_data_available"><div class="no_data_available_text">No Data Available</div></div>';
    var no_form_available = '<div class="no_data_available"><div class="no_data_available_text">No Form Available</div></div>';
    var input_html = '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 input_col"><div class="group"><input type="text" $4 name="$1"><span class="highlight"></span><span class="bar"></span><label>$2</label></div>$3</div>';
    var select_html = '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 input_col"><select name="$1" class="$2">$3</select></div>';
    var option_html = '<option name="$1">$2</option>';
    var datetime_select = '<div class="$1"></div>';
    var fill_form = '<div class="fill_form"><form name="fill_form" action="" method="post"><div class="row">$1</div><div class="btn_box"><button class="btn_custom btn_submit">Submit</button></div></form></div>';
    String.prototype.sprintf = function (...merge) {
        return this.replace(/\$\d+/g, r => merge[r.slice(1) - 1]);
    };
    function ajax(url, data = {}, successCallback = "onSuccessAjax", failureCallback = "onFailAjax", beforeSend = "") {
        $.ajax({
            url: url,
            type: (data.get && data.get == true) ? "GET" : "POST",
            data: data,
            dataType: "json",
            beforeSend: function () {
                if (typeof beforeSend == "function") {
                    beforeSend();
                }
            },
            success: function (data) {
                if (typeof (successCallback) == "function") {
                    successCallback(data);
                }
            },
            error: function (error, textStatus, xhr) {
                var status = parseInt(error.status);
                var message = error.responseText;
                if (status == 401) {
                    message = "Failed";
                    showLoginModal();
                }
                if (typeof (failureCallback) == "function") {
                    // stopPace(true);
                    failureCallback(message);
                }
            }
        });
    }

    function ajax_multi(url = array(), data = array(), callback = null) {
        var done = url.length;
        var results = {};
        var errors = {};

        $(url).each(function (i) {
            ajax(url[i], data[i], function (result) {
                results[i] = result;
                done -= 1;
                if (done == 0) {
                    if (typeof callback == "function") {
                        callback(results, errors);
                    }
                }
            }, function (error) {
                errors[i] = error;
                done -= 1;
                if (done == 0) {
                    if (typeof callback == "function") {
                        callback(results, errors);
                    }
                }
            });
        });
    }
    $(document).ajaxStop(function () {
        // stopPace();
    });

    function onSuccessAjax(data = null) {
        console.log(data);
    }

    function onFailAjax(error = null) {
        console.log(error);
    }
    function getDetails(state_code, mode) {
        ajax(api_url + "getDetails/$1/$2".sprintf(state_code, mode), {}, function (result) {
            if (result.error) {
                alert("Error Fetching Data. Sorry for Inconvinence.");
                $(".page-content").html(no_data_available);
                return;
            }
            if (result.html.length > 0) {
                $(".page-content").html(result.html);
            } else {
                $(".page-content").html(no_data_available);
            }
        }, function (error) {
            $(".page-content").html(no_data_available);
        });
    }
    $.fn.serializeObject = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
    function getFormData(mode) {
        ajax(api_url + "getFormData/$1".sprintf(mode), {}, function (result) {
            if (result.error) {
                alert("Error Fetching Data. Sorry for Inconvinence.");
                $(".page-content").html(no_form_available);
                return;
            }
            if (result.inputs.length > 0) {
                var html = [];
                var datetimee = [];
                for (var i = 0; i < result.inputs.length; i++) {
                    var input = result.inputs[i];
                    if (input.type.toLowerCase() == "input") {
                        html.push(input_html.sprintf(input.name, input.title, "", input.isRequired ? 'required=""' : ""));
                    } else if (input.type.toLowerCase() == "select") {
                        var optionHTML = [];
                        for (var j = 0; j < input.options.length; j++) {
                            optionHTML.push(option_html.sprintf(input.options[j].option_value, input.options[j].option_text));
                        }
                        html.push(select_html.sprintf(input.name, "", optionHTML.join("")));
                    } else if (input.type.toLowerCase() == "date") {
                        html.push(input_html.sprintf(input.name, input.title, datetime_select.sprintf(input.name), "data-field='datetime'"));
                        datetimee.push(input.name);
                    }
                }
                $(".page-content").html(fill_form.sprintf(html.join("")));
                for (var j = 0; j < datetimee.length; j++) {
                    $("." + datetimee[j]).DateTimePicker();
                }
            } else {
                $(".page-content").html(no_form_available);
            }
        }, function (error) {
            $(".page-content").html(no_form_available);
        });
    }
    ajax(api_url + "states", {}, function (result) {
        states = result;
        var state_html = [];
        for (var i = 0; i < states.length; i++) {
            state_html.push(list_ul_html.sprintf(
                list_li_html.sprintf(
                    "state_code",
                    states[i].state_code,
                    states[i].state_name.charAt(0).toUpperCase(),
                    states[i].state_name,
                    ""
                )
            ));
        }
        $(".state_select").html(state_html);
    }, function (error) {
        console.log(error);
    });
    $(document).on("click", ".state_select .list_li", function (e) {
        e.preventDefault();
        state_code = $(this).attr("state_code");
        $("body").removeClass("state_select_mode");
        $("body").addClass("menu_select_mode");
        if (purpose_type == "requirer") {
            getDetails(state_code, "beds");
        } else {
            getFormData("beds");
        }
    });
    $(document).on("click", ".menu_bar a", function (e) {
        e.preventDefault();
        href = $(this).attr("href");
        href = href.substring(1);
        href = href.replace("_tab", "");
        if (purpose_type == "requirer") {
            getDetails(state_code, href);
        } else {
            getFormData(href);
        }
    });
    $(document).on("click", ".bottom_div_container .list_li", function (e) {
        e.preventDefault();
        if ($(this).closest(".bottom_div_container").hasClass("open")) {
            $(this).closest(".bottom_div_container").removeClass("open");
        } else {
            $(this).closest(".page-content").find(".bottom_div_container").removeClass("open");
            $(this).closest(".bottom_div_container").addClass("open");
        }
    });
    $(document).on("click", ".menu_bar_tab", function (e) {
        e.preventDefault();
        $(this).parent().find(".menu_bar_tab").removeClass("is-active");
        $(this).addClass("is-active");
    });
    $(document).on("click", ".menu_bar_button", function (e) {
        e.preventDefault();
        $("body").removeClass("menu_select_mode");
        $("body").addClass("state_select_mode");
        $(".page-content").html("");
    });
    $(document).on("click", ".purpose_button", function (e) {
        e.preventDefault();
        purpose_type = $(this).attr("button_type");
        $("body").removeClass("purpose_select_mode");
        $("body").addClass("state_select_mode");
    });
    $(document).on("click", ".btn_submit", function (e) {
        e.preventDefault();
        var data = $("form[name='fill_form']").serializeObject();
        console.log(api_url + "submitData/" + state_code + "/" + href);
        ajax(api_url + "submitData/" + state_code + "/" + href, data, function (result) {
            console.log(result);
        }, function (error) {
            console.log(error);
        });
    });
    $(document).on("submit", "form[name='fill_form']", function (e) {
        e.preventDefault();
    });
})();
