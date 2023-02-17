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
                    <form action="{{ route('settings.update', ['setting' => $shipment->id]) }}" method="POST"  id="shipmentSettings">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="settgins_type" value="shipmentSettings">
                        <div class="row mb-1">
                            <div class="col-md-4  mt-1 form-group">
                                <x-input.input-field label="Price per mile" name="price_per_miles"
                                    value="{{ $shipment->data['price_per_miles'] }}" :required="true" id="price_per_miles">
                                </x-input.input-field>
                            </div>
                            <div class="col-md-4  mt-1 form-group">
                                <x-input.input-field label="Price per kilometer" name="price_per_kilometer"
                                    value="{{ $shipment->data['price_per_kilometer'] }}" :required="true" id="price_per_kilometer">
                                </x-input.input-field>
                            </div>
                            @php
                                $currenyOptions = [];
                                foreach ($currencies as $option) {
                                    $currenyOptions[$option->id] = $option->name ." - ". $option->symbol;
                                    // array_push($html, '<option ' . ($toSelect == $value ? 'selected' : '') . " value='$value'>$text</option>");
                                }
                            @endphp
                            <div class="col-md-4  mt-1 form-group">
                                <x-input.select name="currency_id" label="Currency" value="{{ $shipment->data['currency_id'] }}" :selectOption="false" toSelect="{{ $shipment->data['currency_id'] }}"
                                    :options="$currenyOptions"
                                    id='currency'>
                                </x-input.select>
                            </div>
                        </div>
                        <div style="display: flex;justify-content: flex-end">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Google map API key</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.update', ['setting' => $map->id]) }}" method="POST"  id="shipmentSettings">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="settgins_type" value="mapAPISettings">
                        <div class="row mb-1">
                            <div class="col-md-12 mt-1 form-group">
                                <x-input.input-field label="Key" :required="true" name="key"
                                    value="{{ $map->data['key'] }}" id="key">
                                </x-input.input-field>
                            </div>
                        </div>
                        <div style="display: flex;justify-content: flex-end">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

