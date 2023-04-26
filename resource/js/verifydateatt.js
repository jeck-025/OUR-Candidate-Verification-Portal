$(document).ready(function () {
    load_data();
    var count = 1;

    function load_data() {
        $(document).on('click', '.verifyDA', function () {
            var a = $(this).data("id");
            $("#verifydateatt").submit(function (e) {
                e.preventDefault();
                this.a = a;
                var b = $('#vfdateatt').val();
                

                if (a === '' || b === '') {
                    $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/caveportal/resource/controllers/verifyDateAtt.php',
                        data: {
                            did: a,
                            vfdateatt: b
                        },
                        success: function (response) {
                            $('#verify-date-att').modal().hide();

                            swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Last Attendance Date Verified',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 1500
                            }).then(function (result) {
                                if (true) {
                                    window.location = 'info.php?id=' + a;
                                }
                            })

                        },
                        error: function (response) {
                            console.log("Failed");
                        }
                    });
                }
            });
        })
    }

});