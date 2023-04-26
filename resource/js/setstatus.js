$(document).ready(function () {
    load_data();
    var count = 1;

    function load_data() {
        $(document).on('click', '.verifyES', function () {
            var a = $(this).data("id");
            $("#verifystatus").submit(function (e) {
                e.preventDefault();
                this.a = a;
                var b = $('#vfeducstatus').val();


                if (a === '' || b === '') {
                    $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/caveportal/resource/controllers/setStatus.php',
                        data: {
                            did: a,
                            vfeducstatus: b
                        },
                        success: function (response) {
                            $('#verify-status').modal().hide();

                            swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Saved',
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


$(document).ready(function () {
    load_data();
    var count = 1;

    function load_data() {
        $(document).on('click', '.verifyESYS', function () {
            var a = $(this).data("id");
            $("#verifyentsem").submit(function (e) {
                e.preventDefault();
                this.a = a;
                var b = $('#vfEsem').val();
                var c = $('#vfEsy').val();
                var d = c + '-' + b;


                if (a === '' || d === '') {
                    $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/caveportal/resource/controllers/setStatus.php',
                        data: {
                            did: a,
                            ent_sy: d
                        },
                        success: function (response) {
                            $('#verify-entsem').modal().hide();

                            swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Saved',
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

$(document).ready(function () {
    load_data();
    var count = 1;

    function load_data() {
        $(document).on('click', '.verifyLSYS', function () {
            var a = $(this).data("id");
            $("#verifyendsem").submit(function (e) {
                e.preventDefault();
                this.a = a;
                var b = $('#vfLsem').val();
                var c = $('#vfLsy').val();
                var d = c + '-' + b;


                if (a === '' || d === '') {
                    $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/caveportal/resource/controllers/setStatus.php',
                        data: {
                            did: a,
                            la_sy: d
                        },
                        success: function (response) {
                            $('#verify-endsem').modal().hide();

                            swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Saved',
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

$(document).ready(function () {
    load_data();
    var count = 1;

    function load_data() {
        $(document).on('click', '.verifyChecker', function () {
            var a = $(this).data("id");
            $("#verifychecker").submit(function (e) {
                e.preventDefault();
                this.a = a;
                var b = $('#cname').val();
                        
                if (a === '' || b === '') {
                    $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/caveportal/resource/controllers/setStatus.php',
                        data: {
                            did: a,
                            checker: b
                
                        },
                        success: function (response) {
                            $('#verify-checker').modal().hide();

                            swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Saved',
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



