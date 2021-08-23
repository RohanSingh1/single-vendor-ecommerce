$("#datatable").DataTable({
    ordering: true
});
$(document).ready(function() {
    $("#create").modal("show");
    $(".form-horizontal").show();
    $(".modal-title").text("Add User");
});

// function Edit POST

$(document).on("click", ".delete-modal", function() {
    $("#footer_action_button").text(" Delete");
    $("#footer_action_button").removeClass("glyphicon-check");
    $("#footer_action_button").addClass("glyphicon-trash");
    $(".actionBtn").removeClass("btn-success");
    $(".actionBtn").addClass("btn-danger");
    $(".modal-title").text("Delete User");
    $(".actionBtn").addClass("delete");
    $(".id").text($(this).data("id"));
    $(".deleteContent").show();
    $(".form-horizontal").hide();
    $(".title").html($(this).data("first_name"));
    $("#myModal").modal("show");
});

// form delete
$(".modal-footer").on("click", ".delete", function() {
    $.ajax({
        type: "POST",
        url: "delete",
        data: {
            _token: $("input[name=_token]").val(),
            id: $(".id").text()
        },
        success: function(data) {
            $(".item" + $(".id").text()).remove();
        },
        error: function(error) {
            console.log(error);
        }
    });
});
// Show function

$(document).on("click", ".show-modal", function() {
    $("#show").modal("show");
    $("#id").text($(this).data("id"));
    $("#fir").text($(this).data("first_name"));
    $("#las").text($(this).data("last_name"));
    $("#ema").text($(this).data("email"));
    $("#con").text($(this).data("contact"));
    $("#add").text($(this).data("address"));
    $(".modal-title").text("Show User");
});
