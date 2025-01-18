@if (!$isError)
    <div class="row">
        <!-- List of plans -->
        <div class="col-4">
            <div id="list-example" class="list-group" style="max-height: 300px;overflow-y:scroll;">
                @foreach ($plans as $key => $plan)
                    <a class="list-group-item list-group-item-action" href="#list-item-{{ Str::slug($key) }}">
                        {{ $key ?? 'Unnamed Plan' }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Details of plans -->
        <div class="col-8">
            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true"
                class="scrollspy-example" tabindex="0">
                @foreach ($plans as $key => $plan)
                    <h4 id="list-item-{{ Str::slug($key) }}">{{ $key }}</h4>
                    <ul class="list-group">
                        @foreach ($plan as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>RS:</strong> {{ $item->rs ?? 'N/A' }} <br>
                                    <strong>Validity:</strong> {{ $item->validity ?? 'N/A' }} <br>
                                    <strong>Description:</strong> {{ $item->desc ?? 'N/A' }}
                                </div>
                                <button class="btn btn-primary btn-sm" onclick="setPlanAmt('{{ $item->rs ?? 0 }}')">Select Plan</button>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning">No Plan Found</div>
@endif
