<x-layout>
  <div class="container mt-5">
    <div class="card shadow-sm border-0 bg-light">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Edit Doctor</h4>
        <a href="{{ route('doctors.index') }}" class="btn btn-sm btn-outline-light">← Back</a>
      </div>

      <div class="card-body bg-white">
        <form method="POST" action="{{ route('doctors.update', $doctor->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- Name --}}
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $doctor->name) }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm" required>
          </div>

          {{-- Email --}}
          <div class="mb-3">
            <label for="email" class="form-label fw-semibold text-dark">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $doctor->email) }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm" required>
          </div>

          {{-- Phone --}}
          <div class="mb-3">
            <label for="phone" class="form-label fw-semibold text-dark">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm">
          </div>

          {{-- Specialist --}}
        <div class="mb-3">
  <label for="specialist_id" class="form-label fw-semibold text-dark">Specialty</label>
  <select id="specialist_id" name="specialist_id"
    class="form-select bg-light border border-secondary-subtle rounded shadow-sm" required>
    <option value="" disabled selected>Select a specialty</option>
    @foreach($specialists as $specialist)
      <option value="{{ $specialist->id }}" {{ old('specialist_id') == $specialist->id ? 'selected' : '' }}>
        {{ $specialist->name_en }}
      </option>
    @endforeach
  </select>
</div>

          {{-- Bio --}}
          <div class="mb-3">
            <label for="bio" class="form-label fw-semibold text-dark">Bio</label>
            <textarea name="bio" id="bio" rows="3"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm">{{ old('bio', $doctor->bio) }}</textarea>
          </div>

          {{-- Available Slots --}}
          <div class="mb-3">
            <label for="available_slots" class="form-label fw-semibold text-dark">Available Slots</label>
            <select name="available_slots[]" id="available_slots" multiple
              class="form-select bg-light border border-secondary-subtle rounded shadow-sm">
              @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                <option value="{{ $day }}" {{ in_array($day, $doctor->available_slots ?? []) ? 'selected' : '' }}>
                  {{ $day }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Status --}}
          <div class="mb-3">
            <label for="status" class="form-label fw-semibold text-dark">Status</label>
            <select name="status" id="status"
              class="form-select bg-light border border-secondary-subtle rounded shadow-sm">
              <option value="1" {{ $doctor->status ? 'selected' : '' }}>Active</option>
              <option value="0" {{ !$doctor->status ? 'selected' : '' }}>Inactive</option>
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
