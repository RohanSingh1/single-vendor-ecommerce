$(document).on("click", ".delete-item", function (e) {
    e.preventDefault(); // Don't post the form, unless confirmed
    if (confirm("Are you sure?")) {
        // Post the form
        $(e.target)
            .closest("form")
            .submit(); // Post the surrounding form
    }
});

function loadFile(event) {
    var output = document.getElementById("preview");
    output.src = URL.createObjectURL(event.target.files[0]);
    document
        .getElementById("oldFeatureImage")
        .setAttribute("class", "display-none");
}

$(document).ready(function () {
    $('.datePicker').daterangepicker({
        timePicker: false,
        use24hours: false,
        singleDatePicker: true,
        minDate: moment().startOf('hour'),
        showDropdowns: true,
        locale: {
            format: 'Y-MM-D'
        }
    });
    $('.timeDatePicker').daterangepicker({
        timePicker: true,
        use24hours: true,
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'Y-MM-D HH:mm'
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
$(document).on('click', '.delete-confirm', function (e) {
    e.preventDefault();
    const url = $(this).parents('form').attr('action');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        type: 'warning',
        // buttons: true,
        showConfirmButton: true,
        showCancelButton: true,
    }).then(function (value) {
        if (value) {
            $.ajax({
                type: "DELETE",
                url: url,
                data: {'_method': 'DELETE'},
                success: function (success) {
                    console.log(success);
                    if (success == 204) {
                        setTimeout(function () {
                            window.location.reload(true);
                        }, 1000);
                        swal({
                            title: "Success!",
                            text: "Data has been deleted \n Click OK to refresh the pages",
                            type: "success",
                        }).then(function () {
                        });
                    } else if (success == 23000) {
                        swal({
                            title: "Error!",
                            text: "Error: Data cannot be deleted check related value exists ",
                            type: 'error',
                        });
                    }
                }, error: function (data) {
                    swal({
                        title: 'Opps...',
                        text: 'Error: 500, Server Error',
                        type: 'error',
                        timer: '1500'
                    })
                    console.log(data);
                }
            });
        }
    });
});
$(document).on('click', '.recover-confirm', function (e) {
    e.preventDefault();
    const url = $(this).parents('form').attr('action');
    swal({
        title: 'Are you sure?',
        text: 'You want to recover this item!',
        type: 'warning',
        // buttons: true,
        showConfirmButton: true,
        showCancelButton: true,
    }).then(function (value) {
        if (value) {
            $.ajax({
                type: "DELETE",
                url: url,
                data: {'_method': 'DELETE'},
                success: function (success) {
                    console.log(success);
                    if (success == 204) {
                        setTimeout(function () {
                            window.location.reload(true);
                        }, 1000);
                        swal({
                            title: "Success!",
                            text: "Data has been recovered \n Click OK to refresh the pages",
                            type: "success",
                        }).then(function () {
                        });
                    } else if (success == 23000) {
                        swal({
                            title: "Error!",
                            text: "Error: Data cannot be recovered",
                            type: 'error',
                        });
                    }
                }, error: function (data) {
                    swal({
                        title: 'Opps...',
                        text: 'Error: 500, Server Error',
                        type: 'error',
                        timer: '1500'
                    })
                    console.log(data);
                }
            });
        }
    });
});
