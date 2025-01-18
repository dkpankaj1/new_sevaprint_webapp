<x-admin-auth-layout>
    @section('title', __('Recharge | show'))
    @section('page-title', 'Recharge | show')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.mobile-recharge.show', $mobileRecharge) }}
    @endsection

    <div class="card">
        <div class="card-header">
            Recharge ID: {{ $mobileRecharge->uniqid }}
        </div>
        <div class="card-body">
            <h5 class="card-title">User: {{ $mobileRecharge->user_id }} | {{ $mobileRecharge->user->name }} | {{ $mobileRecharge->user->email }}</h5>
            <p class="card-text"><strong>Recharge Type:</strong> {{ $mobileRecharge->type }}</p>
            <p class="card-text"><strong>Mobile Number:</strong> {{ $mobileRecharge->mobile_number }}</p>
            <p class="card-text"><strong>Amount:</strong> {{ $mobileRecharge->currency->code }}
                {{ number_format($mobileRecharge->amount, 2) }}</p>
            <p class="card-text"><strong>Operator:</strong> {{ $mobileRecharge->operator }}</p>
            <p class="card-text"><strong>Circle:</strong> {{ $mobileRecharge->circle }}</p>
            <p class="card-text">
                <strong>Status:</strong>
                @php
                    $statusClasses = [
                        'complete' => 'success',
                        'pending' => 'info',
                        'failed' => 'danger',
                    ];
                    $badgeClass = $statusClasses[$mobileRecharge->status] ?? 'secondary';
                @endphp
                <span class="badge bg-{{ $badgeClass }}">
                    {{ ucfirst($mobileRecharge->status) }}
                </span>
            </p>
            <p class="card-text"><strong>Recharged At:</strong>
                {{ $mobileRecharge->recharged_at ? $mobileRecharge->recharged_at->format('d M Y, h:i A') : 'Not Recharged' }}
            </p>
        </div>
        <div class="card-footer text-end">

        </div>
    </div>

</x-admin-auth-layout>
