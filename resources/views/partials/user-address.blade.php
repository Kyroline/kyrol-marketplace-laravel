<div class="card mb-2">
    <div class="card-body">
        <div class="row">
            <h6>{{ $address->label }}</h6>
        </div>
        <strong>{{ $address->receiver }}</strong>
        <span>{{ $address->phone }}</span><br>
        <span>{{ $address->address }}</span><br>
        <p class="mb-0">{{ $address->province }}, {{ $address->city }}</p>
    </div>
</div>