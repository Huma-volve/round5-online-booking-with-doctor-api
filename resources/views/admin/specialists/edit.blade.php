<x-layout>
  <div class="container mt-5">
    <div class="card shadow-sm border-0 bg-light">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Edit Specialist</h4>
        <a href="{{ route('specialists.index') }}" class="btn btn-sm btn-outline-light">← Back</a>
      </div>

      <div class="card-body bg-white">
        <form method="POST" action="{{ route('specialists.update', $specialist->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- Name EN --}}
          <div class="mb-3">
            <label for="name_en" class="form-label fw-semibold text-dark">Name (English)</label>
            <input type="text" id="name_en" name="name_en"
              value="{{ old('name_en', $specialist->name_en) }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm" required>
          </div>

          {{-- Name AR --}}
          <div class="mb-3">
            <label for="name_ar" class="form-label fw-semibold text-dark">Name (Arabic)</label>
            <input type="text" id="name_ar" name="name_ar"
              value="{{ old('name_ar', $specialist->name_ar) }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm" required>
          </div>

          {{-- Description --}}
          <div class="mb-3">
            <label for="description" class="form-label fw-semibold text-dark">Description (optional)</label>
            <textarea name="description" id="description" rows="3"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm">{{ old('description', $specialist->description) }}</textarea>
          </div>

          {{-- Icon/Image --}}
          <div class="mb-3">
            <label for="icon" class="form-label fw-semibold text-dark">Icon / Image (optional)</label>
            <input type="file" id="icon" name="icon"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm">
            @if($specialist->getFirstMediaUrl('icon'))
              <div class="mt-2">
                <img src="{{ $specialist->getFirstMediaUrl('icon') }}" alt="Specialist Icon" class="img-thumbnail" width="80">
              </div>
            @endif
          </div>

          {{-- Status --}}
          <div class="mb-3">
            <label for="status" class="form-label fw-semibold text-dark">Status</label>
            <select name="status" id="status"
              class="form-select bg-light border border-secondary-subtle rounded shadow-sm">
              <option value="1" {{ $specialist->status ? 'selected' : '' }}>Active</option>
              <option value="0" {{ !$specialist->status ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>

          {{-- Submit --}}
          <div class="text-end">
            <button type="submit" class="btn btn-success px-4">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout>
