<x-layout>
  <div class="container mt-5">
    <h2 class="text-primary fw-bold mb-4">Add New Specialist</h2>

    <form method="POST" action="{{ route('specialists.store') }}" enctype="multipart/form-data" class="card p-4 shadow-sm border-0">
      @csrf

      <div class="mb-3">
        <label class="form-label">Name (EN)</label>
        <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}" required>
        @error('name_en') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Name (AR)</label>
        <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}" required>
        @error('name_ar') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Icon / Image</label>
        <input type="file" name="icon" class="form-control">
        @error('icon') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
        <label class="form-check-label">Active</label>
      </div>

      <button type="submit" class="btn btn-primary">Save Specialist</button>
      <a href="{{ route('specialists.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</x-layout>
