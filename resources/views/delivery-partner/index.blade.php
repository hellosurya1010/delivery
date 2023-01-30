@extends('layouts.admin')


@section('style')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Delivery Partners</h5>
                    <div>
                        <button type="button" class="btn btn-primary" id="create-model-button" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-lg"><i class="las la-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">

                    <table id="deliver-partners-table" class="table table-nowrap dt-responsive table-bordered display"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--  Large modal example -->
    <div class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="display: flex;justify-content: space-between; width: 100%; margin: 0 25px;">
                        <h5 class="modal-title" id="myLargeModalLabel">Add delivery partner</h5>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <label for="delivery-partner-from-toggler" class="form-label text-muted">Enable Edit</label>
                                <input class="form-check-input" type="checkbox" id="delivery-partner-from-toggler">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="DeliveryPartnerForm">
                        <div class="row">
                            <div class="col-sm-4 mt-1 form-group">
                                <x-input.select-country name="country_id" id='countrySelect' targetStateId='stateSelect'
                                    dropdownParent=".bs-example-modal-lg"></x-input.select-country>
                                <p class="input-error" data-error="country_id"></p>
                            </div>
                            <div class="col-sm-4 mt-1 form-group">
                                <x-input.select-state name="state_id" id='stateSelect' targetCityId="citySelect"
                                    dropdownParent=".bs-example-modal-lg"></x-input.select-state>
                                <p class="input-error" data-error="state_id"></p>
                            </div>
                            <div class="col-sm-4 mt-1 form-group">
                                <x-input.select-city name="city_id" id='citySelect' dropdownParent=".bs-example-modal-lg">
                                </x-input.select-city>
                                <p class="input-error" data-error="city_id"></p>
                            </div>
                            <div class="col-md-6  mt-1 form-group">
                                <x-input.input-field label="First name" name="first_name" id="first_name">
                                </x-input.input-field>
                            </div>
                            <div class="col-md-6  mt-1 form-group">
                                <x-input.input-field label="Last name" name="last_name" id="last_name">
                                </x-input.input-field>
                            </div>
                            <div class="col-md-6  mt-1 form-group">
                                <x-input.input-field label="Email" name="email" id="email">
                                </x-input.input-field>
                            </div>
                            <div class="col-md-6  mt-1 form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="countryPhoneCode">+</span>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        aria-describedby="inputGroupPrepend">
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                                <p class="input-error" data-error="phone"></p>
                            </div>
                            <div class="col-md-6  mt-1 form-group">
                                <x-input.input-field label="Driving license" name="driving_license_number"
                                    id="driving_license_number">
                                </x-input.input-field>
                            </div>
                            <div class="col-md-6  mt-1 form-group">
                                <x-input.input-field label="Password" name="password" id="password">
                                </x-input.input-field>
                            </div>
                            <div class="col-md-6  mt-1 form-group">
                                <x-input.image-upload name="profile_picture" label="Profile picture"
                                    id='profile_picture'>
                                </x-input.image-upload>
                                
                            </div>
                            <div class="col-md-6  mt-1 form-group">
                                <x-input.image-upload name="driving_license_image" label="Driving license image"
                                    id='driving_license_image'>
                                </x-input.image-upload>
                                <img class="img-thumbnail" id="driving_license_image_preview" alt="200x200" width="200" src="velzon/assets/images/small/img-3.jpg">
                            </div>
                        </div>
                    </form>
                </div>
                  
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i
                            class="ri-close-line me-1 align-middle"></i> Close</a>
                    <button form="DeliveryPartnerForm" type="submit" class="btn btn-primary ">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script>
        let showDeliveryPartnerDetials;
        $(document).ready(function() {
            var e = $("#deliver-partners-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.delivery-partners') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'profile_picture',
                        name: 'profile_picture'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });



            $('#countrySelect').on('change', function() {
                $('#countryPhoneCode').text(`+${$( "#countrySelect option:selected").data().phonecode}`);
            });

            const DeliveryPartnerForm = document.getElementById('DeliveryPartnerForm');
            const myLargeModalLabel = document.getElementById('myLargeModalLabel');

            const {
                clearErrorMessages,
                getFormData,
                ajaxError,
                formRest,
                formState, 
                imgPreview, 
            } = formHelper(DeliveryPartnerForm.id);
            imgPreview({
                inputFileId: "driving_license_image_preview", 
                imageElId: "driving_license_image", 
            });
            let {
                creaetState,
                updateState, 
                stateToggler, 
            } = formState();

            stateToggler(`delivery-partner-from-toggler`);

            document.getElementById('create-model-button').addEventListener('click', () => {
                creaetState({
                    before() {
                        myLargeModalLabel.innerText = 'Add delivery partner';
                    }
                });
            });

            showDeliveryPartnerDetials = (buttonEl) => {
                updateState({before(){
                    myLargeModalLabel.innerText = 'Update delivery partner';
                }});
                let user = JSON.parse(buttonEl.dataset.user);
                let form = DeliveryPartnerForm;
                form.email.value = user.email;
                form.first_name.value = user.first_name;
                form.last_name.value = user.last_name;
                let {
                    delivery_partner: dv
                } = user;
                form.driving_license_number.value = dv.driving_license_number;
                form.phone.value = user.phone;
                // form.driving_license.value = user.driving_license;
            }

            const deliveryPartner = {
                create() {
                    const formData = new FormData();
                    console.log(getFormData());
                    let formValues = getFormData();
                    for (let key in formValues) {
                        formData.append(key, formValues[key]);
                    }
                    formData.append('profile_picture', document.querySelector('[name="profile_picture"]').files[
                        0]);
                    formData.append('driving_license_image', document.querySelector(
                        '[name="driving_license_image"]').files[0]);
                    $.ajax({
                        type: "post",
                        url: `{{ url('') }}/api/delivery-partner-regiseter`,
                        "headers": {
                            "Accept": "application/json"
                        },
                        "processData": false,
                        "mimeType": "multipart/form-data",
                        "contentType": false,
                        "data": formData,
                        beforeSend: clearErrorMessages,
                        success(res) {
                            formRest();
                            $('.bs-example-modal-lg').modal('hide');
                            SwalModal({
                                title: "New delivery partner added."
                            });
                        },
                        error: ajaxError()
                    });
                },
                update() {

                }
            };

            DeliveryPartnerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                let {
                    formType
                } = DeliveryPartnerForm.dataset;
                if (formType == "create") {
                    deliveryPartner.create();
                } else if (formType == "update") {
                    deliveryPartner.update();
                }
            });
        });
    </script>
@endsection
