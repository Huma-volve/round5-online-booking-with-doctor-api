<x-layout>
  <div class="container mt-5">
    <div class="card shadow-sm border-0 rounded">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">User Details</h4>
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-light">← Back to Users</a>
      </div>

      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Name:</div>
          <div class="col-md-9">{{ $user->name }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Email:</div>
          <div class="col-md-9">{{ $user->email }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Role:</div>
          <div class="col-md-9">
            <span class="badge bg-info text-dark">
              {{ $user->roles->pluck('name')->first() ?? 'N/A' }}
            </span>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Status:</div>
          <div class="col-md-9">
            <span class="badge rounded-pill {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">
              {{ $user->is_active ? 'Active' : 'Inactive' }}
            </span>
          </div>
        </div>
          {{-- Delete Form --}}
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger px-3">Delete</button>
            </form>
    </div>
  </div>
      </div>

     
</x-layout>
