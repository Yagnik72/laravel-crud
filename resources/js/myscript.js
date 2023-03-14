var $ = require("jquery");

const Swal = require("sweetalert2");

$(document).ready(function (jQuery) {
    jQuery("table.table.table-primary .btn.btn-danger.permanent").on(
        "click",
        function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = jQuery(this).parent().attr("href");
                }
            });
        }
    );

    if(jQuery('.customer-create-form').length > 0){
        // $(document).on("click", "#formFile", function () {
        //     var file = $(this).parents().find(".file");
        //     file.trigger("click");
        // });
        $('input[type="file"]').change(function (e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    }

    // trashed file disabled
    jQuery(".user-status-trash").on("click", function () {
        Swal.fire({
            position: "top-end",
            icon: "info",
            title: "Please Restore Record.",
            showConfirmButton: false,
            timer: 1500,
        });
    });

    // ajax status
    jQuery(".user-status-class").on("click", function () {
        var $_this = jQuery(this);
        var Cid = jQuery(this).data("cid");

        jQuery.ajax({
            type: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: ajaxData.routes.status,
            data: {
                cid: Cid,
            },
            success: function (response) {
                if (response.success) {
                    console.log(response.customerStatus);
                    if (response.customerStatus == 1) {
                        $_this.attr(
                            "class",
                            "badge badge-success user-status-class"
                        );
                        $_this.text("Active");

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.customerName + " Status Updated.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else if (response.customerStatus == 0) {
                        $_this.attr(
                            "class",
                            "badge badge-danger user-status-class"
                        );
                        $_this.text("Inactive");

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.customerName + " Status Updated.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
        });
    });

    // Login error popup -- Top end
    if(jQuery('.alert.alert-danger.home-login-error').length > 0){
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: jQuery('.alert.alert-danger.home-login-error').data('error-message'),
            showConfirmButton: false,
            timer: 2000
        })
    }
});
