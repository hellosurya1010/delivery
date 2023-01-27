<div>

    <div class="mt-2">
        <h6 class="fw-semibold m-0">Country</h6>
        <select class="form-control" id="{{ $id }}" name="{{ $name }}">
            <option value="">Select</option>
            @foreach ($countires as $country)
                <option data-phoneCode="{{ $country['phonecode'] }}" value="{{ $country['id'] }}">{{ $country['name'] }}</option>
            @endforeach
        </select>
    </div>

    <script>
        $(document).ready(function() {
            let countrySelect = $("#{{ $id }}");
            let stateSelect = $("#{{ $targetStateId }}");
            countrySelect.select2({
                dropdownParent: $("{{ $dropdownParent }}")
            });

            countrySelect.on('change', function() {
                $.ajax({
                    type: "GET",
                    url: `{{ url('') }}/ajax/states/${this.value}`,
                    success(res) {
                        let {
                            data: {
                                states
                            }
                        } = res;
                        stateSelect.empty();
                        let newOption = new Option("Select", "", false, false);
                        stateSelect.append(newOption);
                        states.forEach(state => {
                            newOption = new Option(state.name, state.id, false, false);
                            stateSelect.append(newOption);
                        });
                    }
                });
            });

        });
    </script>

</div>
