<div>
    <div class="mt-2">
        <h6 class="fw-semibold m-0">State</h6>  
        <select class="form-control" data-toSelected="" id="{{ $id }}" name="{{ $name }}">
            <option value="">Select</option>
            @foreach ($states as $state)
                <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
            @endforeach
        </select>
    </div>


    <script>
        $(document).ready(function() {
            let stateSelect = $("#{{ $id }}");
            let citySelect = $("#{{ $targetCityId }}");
            stateSelect.select2({
                dropdownParent: $("{{ $dropdownParent }}")
            });

            stateSelect.on('change', function() {
                $.ajax({
                    type: "GET",
                    url: `{{ url('') }}/ajax/cities/${this.value}`,
                    success(res) {
                        let {
                            data: {
                                cities
                            }
                        } = res;
                        citySelect.empty();
                        let newOption = new Option("Select", "", false, false);
                        citySelect.append(newOption);
                        cities.forEach(state => {
                            newOption = new Option(state.name, state.id, false, false);
                            citySelect.append(newOption);
                        });
                    }
                });
            });

        });
    </script>

</div>

