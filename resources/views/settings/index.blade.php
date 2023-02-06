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
                        <div class="col-md-6  mt-1 form-group">
                            <x-input.input-field label="Price per mile" name="price" value="{{ $shipment->data['price'] }}"
                                id="price">
                            </x-input.input-field>
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
