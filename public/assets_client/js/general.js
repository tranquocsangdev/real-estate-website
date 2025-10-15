// Display errors
window.displayErrors = function (err) {
    const time = 500;
    var errors = err.response.data.errors;

    var errorArray = [];
    Object.keys(errors).forEach(function (key) {
        toastr["error"](errors[key][0], "Lỗi!", {
            closeButton: true, // Có nút "x" để tắt thủ công
            tapToDismiss: false, // Không tự tắt khi click vào
            preventDuplicates: true, // Tránh hiển thị nhiều lỗi giống nhau

            // 🔽 Thêm các thuộc tính mới
            timeOut: 5000, // Thời gian tự động tắt: 5000ms (5 giây)
            extendedTimeOut: 2000, // Thêm 2 giây nếu người dùng hover vào
            progressBar: true, // Hiển thị thanh tiến trình đếm ngược
        });
    });

    // Nếu có yêu cầu reload trang sau khi hiển thị lỗi
    if (err.response.data.reload) {
        if (err.response.data.link != "") {
            setTimeout(
                'window.location = "' + err.response.data.link + '"',
                time
            );
        } else {
            setTimeout("location.reload()", time);
        }
    }
};

window.number_format = function (
    number,
    decimals = 0,
    dec_point = ".",
    thousands_sep = ","
) {
    var n = number,
        c = isNaN((decimals = Math.abs(decimals))) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep,
        s = n < 0 ? "-" : "";
    var i = parseInt((n = Math.abs(+n || 0).toFixed(c))) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;

    return (
        s +
        (j ? i.substr(0, j) + t : "") +
        i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) +
        (c
            ? d +
              Math.abs(n - i)
                  .toFixed(c)
                  .slice(2)
            : "")
    );
};

window.numeralInput = function (element, format = "0,0") {
    return numeral(element.value).format(format);
};

window.getNumberInput = function (str) {
    str = str.replace(",", "");
    if (str.indexOf(".") == -1) {
        return parseInt(str);
    }
    return parseFloat(str);
};

// Copy to clipboard
window.copyToClipboard = function (element, text = "") {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(element).select();
    document.execCommand("copy");
    $temp.remove();

    var messages = "Copied";
    if (text != "") {
        messages += ` ${text}`;
    }

    toastr.success(messages);
};

// Copy to clipboard tooltip
window.copyToClipboardTooltip = function (element) {
    var value = $(element).attr("title");
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(value).select();
    document.execCommand("copy");
    $temp.remove();
    toastr.success("Copied");
};

// Convert number to VN word
window.numberToWord = function (num) {
    var t = [
            "không",
            "một",
            "hai",
            "ba",
            "bốn",
            "năm",
            "sáu",
            "bảy",
            "tám",
            "chín",
        ],
        r = function (r, n) {
            var o = "",
                a = Math.floor(r / 10),
                e = r % 10;
            return (
                a > 1
                    ? ((o = " " + t[a] + " mươi"), 1 == e && (o += " mốt"))
                    : 1 == a
                    ? ((o = " mười"), 1 == e && (o += " một"))
                    : n && e > 0 && (o = " lẻ"),
                5 == e && a >= 1
                    ? (o += " lăm")
                    : 4 == e && a >= 1
                    ? (o += " tư")
                    : (e > 1 || (1 == e && 0 == a)) && (o += " " + t[e]),
                o
            );
        },
        n = function (n, o) {
            var a = "",
                e = Math.floor(n / 100),
                n = n % 100;
            return (
                o || e > 0
                    ? ((a = " " + t[e] + " trăm"), (a += r(n, !0)))
                    : (a = r(n, !1)),
                a
            );
        },
        o = function (t, r) {
            var o = "",
                a = Math.floor(t / 1e6),
                t = t % 1e6;
            a > 0 && ((o = n(a, r) + " triệu"), (r = !0));
            var e = Math.floor(t / 1e3),
                t = t % 1e3;
            return (
                e > 0 && ((o += n(e, r) + " ngàn"), (r = !0)),
                t > 0 && (o += n(t, r)),
                o
            );
        };

    if (0 == num) return t[0];
    var str = "",
        a = "";
    do
        (ty = num % 1e9),
            (num = Math.floor(num / 1e9)),
            (str = num > 0 ? o(ty, !0) + a + str : o(ty, !1) + a + str),
            (a = " tỷ");
    while (num > 0);
    str = str.trim();

    return str.charAt(0).toUpperCase() + str.slice(1);
};

window.displaySuccess = function (res, show = true) {
    var message = res.data?.message;

    if (!show) return; // 👉 Nếu không cần hiển thị thì thoát sớm

    if (res.data?.status == 1) {
        toastr["success"](message, "Thành Công!", {
            closeButton: true,
            tapToDismiss: false,
            preventDuplicates: true,
            timeOut: 5000,
            extendedTimeOut: 2000,
            progressBar: true,
        });
    } else if (res.data?.status == 0) {
        toastr["error"](message, "Có Lỗi!", {
            closeButton: true,
            tapToDismiss: false,
            preventDuplicates: true,
            timeOut: 5000,
            extendedTimeOut: 2000,
            progressBar: true,
        });
    } else {
        toastr["warning"](message, "Cảnh Báo!", {
            closeButton: true,
            tapToDismiss: false,
            preventDuplicates: true,
            timeOut: 5000,
            extendedTimeOut: 2000,
            progressBar: true,
        });
    }
};
// Display message
window.displayMessage = function (message) {
    const time = 1000;

    message = message.data;
    if (message.type == "swal") {
        swal("Thành công", message.message, message.sub_type);
    }

    if (message.type == "toastr") {
        if (message.sub_type == "info") {
            toastr["info"](message.message, "Info!", {
                closeButton: true,
                tapToDismiss: false,
                preventDuplicates: true,
            });
        } else if (message.sub_type == "success") {
            toastr["success"](message.message, "Success!", {
                closeButton: true,
                tapToDismiss: false,
                preventDuplicates: true,
            });
        } else if (message.sub_type == "warning") {
            toastr["warning"](message.message, "Warning!", {
                closeButton: true,
                tapToDismiss: false,
                preventDuplicates: true,
            });
        } else {
            toastr["error"](message.message, "Error!", {
                closeButton: true,
                tapToDismiss: false,
                preventDuplicates: true,
            });
        }
    }

    if (message.reload) {
        if (message.link != "") {
            setTimeout('window.location = "' + message.link + '"', time);
        } else {
            setTimeout("location.reload()", time);
        }
    }
};

// Convert Vietnamese to English
window.nonAccentVietnamese = function (str) {
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // Huyền sắc hỏi ngã nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // Â, Ê, Ă, Ơ, Ư

    return str;
};

window.convertToSlug = function (text) {
    text = window.nonAccentVietnamese(text);
    text = text.replace(/-+/g, " ");
    text = text.toLowerCase();
    text = text.replace(/[^\w ]+/g, "");
    text = text.replace(/ +/g, "-");
    text = text.replace(/\s\s+/g, " ");

    if (text[0] == "-") {
        text = text.substr(1);
    }

    if (text[text.length - 1] == "-") {
        text = text.substr(0, text.length - 1);
    }

    return text;
};

window.trimSlash = function (text) {
    return text.replace(/^\/|\/$/g, "");
};

window.currentLink = function () {
    return window.trimSlash(window.location.href);
};

window.getPageFromUrl = function (url_string) {
    var url = new URL(url_string);

    return url.searchParams.get("page");
};

// window.clipboard.copy('Something wanna coppy');
window.clipboard = (function (window, document, navigator) {
    var textArea, copy;

    function isOS() {
        return navigator.userAgent.match(/ipad|iphone/i);
    }

    function createTextArea(text) {
        textArea = document.createElement("textArea");
        textArea.value = text;
        document.body.appendChild(textArea);
    }

    function selectText() {
        var range, selection;

        if (isOS()) {
            range = document.createRange();
            range.selectNodeContents(textArea);
            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            textArea.setSelectionRange(0, 999999);
        } else {
            textArea.select();
        }
    }

    function copyToClipboard() {
        document.execCommand("copy");
        document.body.removeChild(textArea);
    }

    copy = function (text) {
        createTextArea(text);
        selectText();
        copyToClipboard();
    };

    return {
        copy: copy,
    };
})(window, document, navigator);

window.copyToClipboardTemplate = function (text, message) {
    window.clipboard.copy(text);

    var messages = "Copy";
    if (message != "") {
        messages = ` ${message}`;
        toastr.success(messages);
    }
};

// Notify
window.notifyMe = function (message, title = "Default title") {
    if (Notification.permission !== "granted") Notification.requestPermission();
    else {
        var notification = new Notification(title, {
            icon: "http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png",
            body: message,
        });

        notification.onclick = function () {
            window.open("http://www.google.com");
        };
    }
};

window.getFormData = function ($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    console.log(unindexed_array);
    $.map(unindexed_array, function (n, i) {
        indexed_array[n["name"]] = n["value"];
    });

    return indexed_array;
};

window.date_format = function (now) {
    return moment(now).format("DD/MM/yyyy");
};
