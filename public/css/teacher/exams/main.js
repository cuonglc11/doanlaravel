$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#addExamsForm").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/teacher/exams/store",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (rs) {
                if (rs.success) {
                    location.reload();
                }
            },
        });
    });
});
