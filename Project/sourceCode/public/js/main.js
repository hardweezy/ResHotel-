$(document).ready(function() {
    // Write your custom Javascript codes here...

    /**
     * departure event to show calender
     * @type {String}
     */
    $("#departure").dateDropper({
        lock: "from",
        minYear: 2015,
        dropPrimaryColor: "#F87A54"
    });

        /**
     * arrival event to show calender
     * @type {String}
     */
    $("#arrival").dateDropper({
        lock: "from",
        minYear: 2015
    });

        /**
     * @import nice-select plugin to beautify default search
     * @type {String}
     */
    $('select').niceSelect();

    /**
     * @import parsley to validate form on client side
     * Note there is server side validation too
     * @type {String}
     */
    $('#checkAvailabilityForm').parsley();

    /**
     * @import Dropzone.Js to handle image uplaods
     * @type {String}
     */

    Dropzone.options.myAwesomeDropzone = {
        url: "../admin/uploads.php",
        addRemoveLinks: false,
        acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF',
        init: function() {
            this.on("complete", function(file) {
                if (file.status == "success") {
                    ohSnap('image uploaded', {
                        color: 'green',
                        icon: 'icon-alert'
                    });
                }
            });
            this.on("error", function(file) {
                if (file.status == "error") {
                    ohSnap('image not uploaded', {
                        color: 'red',
                        icon: 'icon-alert'
                    });
                }
            });
        }



    };



    /**
     * AJAX call to create Room at the Admin section
     */
    $(document).on('click', '#addRoom', function(e) {
        e.preventDefault();
        if ($('#room_upload').parsley().isValid()) {
            $.ajax({
                type: "POST",
                url: "../includes/room_upload.php",
                data: {
                    _csrf: $("input[name=_csrf]").val(),
                    roomName: $("#roomName").val(),
                    roomDescription: $("#roomDescription").val(),
                    numberOfRooms: $("#numberOfRooms").val(),
                    priceRoom: $("#priceRoom").val(),
                    adultMaxCapacity: $("#adultMaxCapacity").val(),
                    childMaxCapacity: $("#childMaxCapacity").val()

                },
                dataType: 'json',
                cache: false,
                success: function(data) {
                    if (data.status == "success") {
                        $("#addRoom, #room_upload").hide();
                        $("#gotoRooms, #imagegallery").show();
                        ohSnap(data.message, {
                            color: 'green',
                            icon: 'icon-alert'
                        });
                    } else if (data.status == "failed_validation") {
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    } else if (data.status == "error") {
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    }
                },
                error: function(response) {
                    /**
                     * Error with form submission
                     * @type {String}
                     */
                    ohSnap('Oh Snap, there is an error with your submission', {
                        color: 'red',
                        icon: 'icon-alert'
                    });
                }

            })
            return false;
        } else {
            ohSnap('Oh Snap, there is an error with your submission', {
                color: 'red',
                icon: 'icon-alert'
            });
        }
    });

    /**
     * [aJax to register and login user]
     * @param
     ** @returns  {[JSON]}
     */
    $(document).on('click', '#btn-signup', function(e) {
        e.preventDefault();
        if ($('#signupform').parsley().isValid()) {
            $.ajax({
                type: "POST",
                url: "../includes/reg.php",
                data: {
                    _csrf: $("input[name=_csrf]").val(),
                    name: $("input[name=name]").val(),
                    email: $("input[name=email]").val(),
                    password: $("input[name=password]").val()
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == "success") {
                        /**
                         * Clear all input
                         */
                        $("#btn-signup").attr("disabled", "true");
                        $("input[name=name]").val("");
                        $("input[name=email]").val("");
                        $("input[name=password]").val("");

                        /**
                         * [color description]
                         * @type display notificatin before redirecting
                         */
                        ohSnap(data.message, {
                            color: 'green',
                            icon: 'icon-alert'
                        });
                        /**
                         * [redirects]
                         * @param  {String} ){  window.location.href [redirect to home]
                         * @param  {[type]} 5000 [after 3 seconds]
                         * @return {[type]}      [description]
                         */
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    } else if (data.status == "failed_validation") {
                        /**
                         * On failed Validation
                         * @type {String}
                         */
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    } else if (data.status == "error") {
                        /**
                         * On invalid _csrf token
                         * @type {String}
                         */
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    }

                },
                error: function(response) {
                    /**
                     * Error with form submission
                     * @type {String}
                     */
                    ohSnap('Oh Snap, there is an error with your submission', {
                        color: 'red',
                        icon: 'icon-alert'
                    });
                }
            })
            return false;
        } else {
            /**
             * On error with form validation from parsley()
             * @type {String}
             */
            ohSnap('Oh Snap, there is an error with your submission', {
                color: 'red',
                icon: 'icon-alert'
            });

        }
    });
    /**
     * [aJax call to validate if email field is unique]
     * @param
     * @return {[JSON]}
     */
    $(document).on('keyup', '#email', function(e) {
        e.preventDefault();
        var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
        if (ck_email.test($(this).val())) {
            $.ajax({
                method: 'POST',
                url: '../includes/email.php',
                data: {
                    _csrf: $("input[name=_csrf]").val(),
                    email: $("input[name=email]").val()
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == "found") {
                        $("#btn-signup").attr("disabled", "true");
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    } else if (data.status == "not_found") {
                        $("#btn-signup").removeAttr("disabled");
                        ohSnap(data.message, {
                            color: 'green',
                            icon: 'icon-alert'
                        });
                    } else if (data.status == "failed_validation") {
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    } else if (data.status == "error") {
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    }

                },
                error: function(response) {
                    ohSnap('Oh Snap, there is an error with your submission', {
                        color: 'green',
                        icon: 'icon-alert'
                    });
                }
            })
            return false;
        }
    });


    /**
     * [aJax call to Login User]
     * @return {JSon} [description]
     */
    $(document).on('click', '#btn-login', function(e) {
        e.preventDefault();
        if ($('#loginbox').parsley().isValid()) {
            $.ajax({
                type: "POST",
                url: "../includes/login.php",
                data: {
                    _csrf: $("input[name=_csrf]").val(),
                    email: $("input[name=email]").val(),
                    password: $("input[name=password]").val()
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == "success") {
                        /**
                         * Clear all input
                         */
                        $("#btn-login").attr("disabled", "true");
                        $("input[name=email]").val("");
                        $("input[name=password]").val("");

                        /**
                         * [color description]
                         * @type display notificatin before redirecting
                         */
                        ohSnap(data.message, {
                            color: 'green',
                            icon: 'icon-alert'
                        });
                        /**
                         * [redirects]
                         * @param  {String} ){  window.location.href [redirect to home]
                         * @param  {[type]} 5000 [after 3 seconds]
                         * @return {[type]}      [description]
                         */
                        setTimeout(function() {
                            window.location.href = '../admin/'
                        }, 2000);
                    } else if (data.status == "fail") {
                        /**
                         * On failed response
                         * @type {String}
                         */
                        $("#btn-login").removeAttr("disabled");
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    } else if (data.status == "failed_validation") {
                        /**
                         * On failed Validation
                         * @type {String}
                         */
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    } else if (data.status == "error") {
                        /**
                         * On invalid _csrf token
                         * @type {String}
                         */
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    }

                },
                error: function(response) {
                    /**
                     * Error with form submission
                     * @type {String}
                     */
                    ohSnap('Oh Snap, there is an error with your submission', {
                        color: 'red',
                        icon: 'icon-alert'
                    });
                }
            })
            return false;
        } else {
            /**
             * On error with form validation from parsley()
             * @type {String}
             */
            ohSnap('Oh Snap, there is an error with your submission', {
                color: 'red',
                icon: 'icon-alert'
            });

        }
    });


    /**
     * [loadRooms description]
     * @param  {[datatables]} 
     * @return {[type]}     
     */
    $('#loadRooms').DataTable({
        "language": {
            "lengthMenu": "Display _MENU_ rooms per page",
            "zeroRecords": "No room type available",
            "infoEmpty": "No rooms available",
            "infoFiltered": "(filtered from _MAX_ total rooms)"
        },
        processing: true,
        serverSide: true,
        ajax: '../includes/fetchrooms.php',
        columns: [{
            defaultContent: '',
            data: 'upload_name',
            sortable: false,
            render: function(data) {
                return '<img src="../public/uploads/' + data + '" style="width:55px;height:55px" class="img-responsive text-center">';
            }
        }, {
            defaultContent: '',
            data: 'name',
            name: 'name'
        }, {
            defaultContent: '',
            data: 'number_of_rooms',
            name: 'number_of_rooms'
        }, {
            defaultContent: '0',
            data: 'price',
            name: 'price'
        }, {
            defaultContent: '0',
            data: 'adult_max_capacity',
            name: 'adult_max_capacity'
        }, {
            defaultContent: '0',
            data: 'child_max_capacity',
            name: 'child_max_capacity'
        }],

        pageLength: 15,
        lengthMenu: [
            [15, 30, 45, -1],
            [15, 30, 45, "All"]
        ]

    });

    
    /**
     * [load bookings at admin description]
     * @param  {[datatables array]} 
     * @return {[JSON array]}     
     */
    $('#loadBookings').DataTable({
        "language": {
            "lengthMenu": "Display _MENU_ bookings per page",
            "zeroRecords": "No booking available",
            "infoEmpty": "No booking available",
            "infoFiltered": "(filtered from _MAX_ total bookings)"
        },
        processing: true,
        serverSide: true,
        ajax: '../includes/fetchbookings.php',
        columns: [{
            defaultContent: '',
            data: 'reservations_id',
            sortable: false,
            render: function(data) {
                return '<a href="bookingdetails.php?reservation='+ data +'">#'+data+'</a>';
            }
        }, {
            defaultContent: '',
            data: 'fullname',
            name: 'fullname'
        }, {
            defaultContent: '',
            data: 'name',
            name: 'name'
        },
         {
            defaultContent: '',
            data: null,
            sortable: false,
            render: function format(data) {
                return new Date(data.date_in).toDateString();
            }
        }, {
            defaultContent: '',
            data: null,
            sortable: false,
            render: function format(data) {
                return new Date(data.date_out).toDateString();
            }
        },{
            defaultContent: '',
            data: null,
            sortable: false,
            render: function format(data) {
                return 'R'+data.amount_charged;
            }
        }, {
            defaultContent: '0',
            data: 'room_number',
            name: 'room_number'
        }, {
            defaultContent: '0',
            data: 'adult_count',
            name: 'adult_count'
        }, {
            defaultContent: '0',
            data: 'child_count',
            name: 'child_count'
        }],

        pageLength: 15,
        lengthMenu: [
            [15, 30, 45, -1],
            [15, 30, 45, "All"]
        ]

    });


    
    /**
     * [reserve Room description]
     * @param  {[pass the id of the room to the POST URL
     * and wait for response, onSuccess, onFail, onError
     * have been covered 
     * @return {[type]}     
     */
    $(document).on('click', '#reserveNow', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id);
        $('.onReserveNow').attr("disabled", "true");
        $.ajax({
            url: '../includes/make-reservation.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
                arrival: $("#arrival").val(),
                departure: $("#departure").val(),
                roomCapacity: $("#roomCapacity").val(),
                childCapacity: $("#childCapacity").val(),
                adultCapacity: $("#adultCapacity").val(),

                _csrf: $("input[name=_csrf]").val()

            },
            cache: false,
            success: function(data) {
                if (data.status == "success") {
                    /**
                     * Clear all input
                     */


                    $("#preReservationSummary").hide();
                    $("#reservationSummary").show().fadeIn(3000);

                    $("#reservationSummary").load('../includes/review-bookings.php');


                    /**
                     * [color description]
                     * @type display notificatin before redirecting
                     */
                    ohSnap(data.message, {
                        color: 'green',
                        icon: 'icon-alert'
                    });

                } else if (data.status == "failed_validation") {
                    /**
                     * On failed Validation
                     * @type {String}
                     */
                    ohSnap(data.message, {
                        color: 'red',
                        icon: 'icon-alert'
                    });
                } else if (data.status == "error") {
                    /**
                     * On invalid _csrf token
                     * @type {String}
                     */
                    ohSnap(data.message, {
                        color: 'red',
                        icon: 'icon-alert'
                    });
                }

            },
            error: function(response) {
                /**
                 * Error with submission from the server
                 * @type {404-501 errors}
                 */
                ohSnap('Oh Snap, there is an error submitting your reservation', {
                    color: 'red',
                    icon: 'icon-alert'
                })
            }
        })
        return false;
    });

    /**
     * [description]
     * On checkout,
     * We take as many information we need about the Guest
     * the Room, and his/her reservation
     * @return JSON
     */
    $(document).on('click', '#buttonCheckoutForm', function(e) {
        e.preventDefault();
        if ($('#checkoutForm').parsley().isValid()) {
            e.stopImmediatePropagation();
            $.ajax({
                url: '../includes/checkout-booking.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    guestFirstName: $("#guestFirstName").val(),
                    guestLastName: $("#guestLastName").val(),
                    guestEmail: $("#guestEmail").val(),
                    guestPhone: $("#guestPhone").val(),
                    guestAddress: $("#guestAddress").val(),
                    guestAddress2: $("#guestAddress2").val(),
                    guestPostalCode: $("#guestPostalCode").val(),
                    guestCountry: $("#guestCountry").val(),
                    _csrf: $("input[name=_csrf]").val()
                },
                cache: false,
                success: function(data) {
                    if (data.status == "success") {

                        /**
                         * if returned JSON status equal success
                         * clear all input text on form
                         * echo out returned message
                         * redirect to HOme-Page
                         */

                        $("#guestFirstName").val("");
                        $("#guestLastName").val("");
                        $("#guestEmail").val("");
                        $("#guestPhone").val("");
                        $("#guestAddress").val("");
                        $("#guestAddress2").val("");
                        $("#guestPostalCode").val("");
                        $('#buttonCheckoutForm').hide();

                        ohSnap(data.message, {
                            color: 'green',
                            icon: 'icon-alert',
                            time: '7000'
                        });
                        setTimeout(function() {
                            window.location.href = '../'
                        }, 6000);

                    } else if (data.status == "failed_validation") {
                        /**
                         * On failed Validation
                         * @type {String}
                         */
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    } else if (data.status == "error") {
                        /**
                         * On invalid _csrf token
                         * @type {String}
                         */
                        ohSnap(data.message, {
                            color: 'red',
                            icon: 'icon-alert'
                        });
                    }
                },
                error: function(response) {
                    /**
                     * Error with form submission
                     * @type {String}
                     */
                    ohSnap('Oh Snap, there is an error with your submission', {
                        color: 'red',
                        icon: 'icon-alert'
                    });
                }


            })
            return false;

            $("form#checkoutForm").unbind('submit');

        } else {
            /**
             * only trigger this if there is a problem with parsley Validation
             * not returning true
             * @type {404-501}
             */
            ohSnap('Oh Snap, you have validation errors, kindly correct it', {
                color: 'red',
                icon: 'icon-alert'
            });
        }


    });

    $(document).on('click', '#homeCheckAvailability', function(e) {
        var slug = $(this).data('id');
        e.preventDefault();
                            if (!e) return;
                            console.log('#homeCheckAvailability');
                            if( $('#checkAvailabilityForm').parsley().isValid()){
                              $('form#checkAvailabilityForm').submit();

                            }
    });

    /*
    End Javascript Document.ready function
     */

});