// $("#addDeliveryPartner").validate({
    //     rules: {
    //         first_name: {
    //             required: true,
    //         },
    //         phone: {
    //             required: true,
    //             number: true,
    //         },
    //         email: {
    //             required: true,
    //             email: true,
    //             remote: {
    //                 url: `{{ url('/') }}/ajax/check/email/exists`,
    //                 type: "get",
    //                 data: {
    //                     email: function(){
    //                         console.log($('#email').val());
    //                         return $('#email').val();
    //                     }
    //                 },
    //                 // success: function(data) {
    //                 //     console.log(data, this, this?.message);
    //                 // }
    //             },
    //         },
    //         password: {
    //             required: true,
    //             minlength: 8,
    //         },
    //         last_name: {
    //             required: true,
    //         },
    //         driving_license_number: {
    //             required: true,
    //         },
    //         country: {
    //             required: true,
    //         },
    //         state: {
    //             required: true,
    //         },
    //         city: {
    //             required: true,
    //         },
    //     },
    //     messages: {
    //         email:{
    //             remote: "dfghjkl"
    //         }
    //     },
    //     errorPlacement: function(error, element) {
    //         element.closest('.form-group').append(error);
    //     },
    //     submitHandler() {
    //         console.log('dfashdfjkhsdjkfaksdhfkashd');
    //         console.log(this);
    //     }
    // });