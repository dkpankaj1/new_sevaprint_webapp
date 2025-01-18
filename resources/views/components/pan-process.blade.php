@if ($processed)
    <button type="button" class="btn btn-sm btn-secondary" disabled>Processed</button>
@else
    <form action="{{ route('nsdl.process', $panCard) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-success">Submit PAN Application</button>
    </form>
@endif
