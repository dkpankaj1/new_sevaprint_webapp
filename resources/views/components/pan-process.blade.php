<form action="{{ route('nsdl.process', $panCard) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-sm btn-success">Complete Pan Application</button>
</form>