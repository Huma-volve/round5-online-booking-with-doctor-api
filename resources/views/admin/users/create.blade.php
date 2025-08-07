<x-layout>
  <div class="container mt-5">
    <div class="card shadow-sm border-0 bg-light">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Create User</h4>
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-light">← Back</a>
      </div>

      <div class="card-body bg-white">
        <form method="POST" action="{{ route('users.store') }}">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm"
              required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-semibold text-dark">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm"
              required>
          </div>
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold text-dark">Password</label>
            <input type="password" id="password" name="password"
                class="form-control bg-light border border-secondary-subtle rounded shadow-sm" required>
        </div>

          <div class="mb-4">
            <label for="role" class="form-label fw-semibold text-dark">Role</label>
            <select id="role" name="role"
              class="form-select bg-light border border-secondary-subtle rounded shadow-sm"
              required>
              <option value="" disabled selected>Select a role</option>
              @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                  {{ ucfirst($role->name) }}
                </option>
              @endforeach
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
