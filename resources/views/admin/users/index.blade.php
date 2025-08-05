<x-layout>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-primary fw-bold">User Management</h2>
      <a href="{{ route('users.create') }}" class="btn btn-outline-primary">+ Add New User</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle shadow-sm">
        <thead class="table-primary text-center">
          <tr>
            <th scope="col">👤 Name</th>
            <th scope="col">📧 Email</th>
            <th scope="col">🎓 Role</th>
            <th scope="col">📍 Status</th>
            <th scope="col">⚙️ Actions</th>
          </tr>
        </thead>
        <tbody class="text-center">
          @forelse($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <span class="badge bg-info text-dark">
                  {{ $user->roles->pluck('name')->first() ?? 'N/A' }}
                </span>
              </td>
              <td>
                <span class="badge rounded-pill {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">
                  {{ $user->is_active ? 'Active' : 'Inactive' }}
                </span>
              </td>
              <td>
                <a href="/users/{{ $user->id }}" class="btn btn-sm btn-outline-info me-1">View</a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-muted">No users found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</x-layout>
