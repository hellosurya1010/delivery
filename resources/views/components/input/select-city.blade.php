<div>
    <div class="mt-2">
        <h6 class="fw-semibold m-0">City</h6>
        <select class="form-control" id="{{ $id }}" name="{{ $name }}">
            <option value="">Select</option>
            @foreach ($cities as $city)
                <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
            @endforeach
        </select>
    </div>

    <script>
        $(document).ready(function() {
            let citieselect = $("#{{ $id }}");
            citieselect.select2({
                dropdownParent: $("{{ $dropdownParent }}")
            });
        });
    </script>

</div>

