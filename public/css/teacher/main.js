// Xem trước hình ảnh
document.getElementById("img").addEventListener("change", function (e) {
    const preview = document.getElementById("imagePreview");
    const file = e.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = "block";
    } else {
        preview.style.display = "none";
    }
});
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#addCourseForm").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/teacher/store",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (rs) {
                //  console.log(rs);
                if (rs.success) {
                    location.reload();
                }
            },
        });
    });
    $(document).on("click", ".btn-edit", function () {
        const id = $(this).data("id");
        const title = $(this).data("title");
        const description = $(this).data("description");
        const category = $(this).data("category");
        const price = $(this).data("price");
        const img = $(this).data("img");
        $("#addCourseForm input[name='title']").val(title);
        $("#addCourseForm input[name='id']").val(id);

        $("#addCourseForm textarea[name='description']").val(description);
        $("#addCourseForm select[name='category_id']").val(category);
        $("#addCourseForm input[name='price']").val(price);
        $("#addCourseForm img#imagePreview").attr("src", img);
        const preview = document.getElementById("imagePreview");
        preview.style.display = "block";
    });
});
