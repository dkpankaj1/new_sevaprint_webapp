<div class="mb-3">
    <div class="mb-2">
        <div style="width: 200px; aspect-ratio: 4 / 3;">
            <img id="preview-{{ $id }}" src="{{ $previewUrl ?? '' }}" class="img-thumbnail"
                style="width: 100%; height: 100%; object-fit: contain; display: {{ $previewUrl ? 'block' : 'none' }};">
        </div>
        
    </div>
    <input type="file" id="{{ $id }}" name="{{ $name }}" class="form-control" accept="image/*"
        onchange="previewImage(event, '{{ $id }}')">


    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<script>
    function previewImage(event, id) {
        const preview = document.getElementById('preview-' + id);
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
