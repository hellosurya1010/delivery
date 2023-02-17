@extends('layouts.admin')


@section('style')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Shipment Settings</h4>
                </div>
                <div class="card-body">
                    <form id="shipmentSettings">
                        <div class="col-md-4  mt-1 form-group">
                            <x-input.input-field label="Price per mile" name="price_per_miles" value="{{ $shipment->data['price_per_miles'] }}"
                                id="price_per_miles">
                            </x-input.input-field>
                        </div>
                        <div class="col-md-4  mt-1 form-group">
                            <x-input.input-field label="Price per kilometer" name="price_per_kilometer" value="{{ $shipment->data['price_per_kilometer'] }}"
                                id="price_per_kilometer">
                            </x-input.input-field>
                        </div>
                        <div class="col-md-4  mt-1 form-group"> 
                            <x-input.select name="is_approved" label="Is approved" :selectOption="false" toSelect="{{ $dv::$approved }}" dropdownParent=".bs-example-modal-lg"
                                :options="[$dv::$approved => 'Approved', $dv::$rejected => 'Rejected']" id='is_approved'>
                            </x-input.select>
                        </div>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(() => {
            (function() {
                const {
                    clearErrorMessages,
                    getFormData,
                    ajaxError,
                    formRest,
                    formState,
                    imgPreview,
                    beforeSend,
                } = formHelper(shipmentSettings);

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
                    beforeSend: beforeSend,
                    success(res) {
                        formRest();
                        $('.bs-example-modal-lg').modal('hide');
                        SwalModal({
                            title: "New delivery partner added."
                        });
                        location.reload();
                    },
                    error: ajaxError()
                });

            })();
        });
    </script>
@endsection
