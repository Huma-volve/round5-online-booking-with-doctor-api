<x-layout>
  <div class="container mt-5">
    <div class="card shadow-sm border-0 bg-light">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Edit User</h4>
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-light">← Back</a>
      </div>

      <div class="card-body bg-white">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Name</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm"
              required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-semibold text-dark">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}"
              class="form-control bg-light border border-secondary-subtle rounded shadow-sm"
              required>
          </div>

          <div class="mb-4">
            <label for="role" class="form-label fw-semibold text-dark">Role</label>
            <select id="role" name="role"
              class="form-select bg-light border border-secondary-subtle rounded shadow-sm"
              required>
              @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                  {{ ucfirst($role->name) }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-success px-4">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout>
