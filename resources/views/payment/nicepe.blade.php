<x-user-auth-layout>
    @section('title', __('Payment - NicePe '))

    <form action="{{ $baseUrl }}" method="post" id="nicepe_form">
        @foreach ($transactionData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <input type="hidden" name="checksum" value="{{ $checksum }}">
        <button type="submit">Pay Now</button>
    </form>

    <script></script>

</x-user-auth-layout>
