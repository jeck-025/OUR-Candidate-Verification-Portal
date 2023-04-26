$(document).ready(function () {
    load_data();
    var count = 1;

    function load_data() {
        $(document).on('click', '.verifyN', function () {
            var a = $(this).data("id");
            $("#verifyname").submit(function (e) {
                e.preventDefault();
                this.a = a;
                var b = $('#vfname').val();
                

                if (a === '' || b === '') {
                    $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/caveportal/resource/controllers/verifyName.php',
                        data: {
                            did: a,
                            vfname: b
                        },
                        success: function (response) {
                            $('#verify-name').modal().hide();

                            swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Name Verified',
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