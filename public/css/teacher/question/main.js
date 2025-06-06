$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#addQuestionForm").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/teacher/question/store",
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
    $(document).on("click", ".btn-edit", function () {
        const id = $(this).data("id");
        const title = $(this).data("title");
        const content = $(this).data("content");
        const content_url = $(this).data("content_url");
        console.log(content);

        $("#addLessonForm input[name='title']").val(title);
        $("#addLessonForm input[name='id']").val(id);
        $("#addLessonForm textarea[name='content']").val(content);
        $("#addLessonForm input[name='content_url']").val(content_url);
    });
});
