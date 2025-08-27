<x-layout>
  <div class="container mt-5">
    <div class="card shadow-sm border-0 bg-light">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Create Doctor</h4>
        <a href="{{ route('doctors.index') }}" class="btn btn-sm btn-outline-light">← Back</a>
      </div>

      <div class="card-body bg-white">
        
        <form method="POST" action="{{ route('doctors.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <input type="file" name="profile_image" accept="image/*" required>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-semibold text-dark">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label fw-semibold text-dark">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm" required>
          </div>

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

          <div class="mb-3">
            <label for="bio" class="form-label fw-semibold text-dark">Bio</label>
            <textarea id="bio" name="bio"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm"
              rows="3">{{ old('bio') }}</textarea>
          </div>

          <div class="mb-3">
            <label for="available_slots" class="form-label fw-semibold text-dark">Available Slots</label>
            <select name="available_slots[]" id="available_slots" multiple
              class="form-select bg-light border border-secondary-subtle rounded shadow-sm">
              <option value="Sunday">Sunday</option>
              <option value="Monday">Monday</option>
              <option value="Tuesday">Tuesday</option>
              <option value="Wednesday">Wednesday</option>
              <option value="Thursday">Thursday</option>
              <option value="Friday">Friday</option>
              <option value="Saturday">Saturday</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="status" class="form-label fw-semibold text-dark">Status</label>
            <select name="status" id="status"
              class="form-select bg-light border border-secondary-subtle rounded shadow-sm">
              <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
              <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-primary px-4">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout>
