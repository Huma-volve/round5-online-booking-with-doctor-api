<x-layout>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-primary fw-bold">Doctor Management</h2>
      <a href="{{ route('doctors.create') }}" class="btn btn-outline-primary">+ Add New Doctor</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle shadow-sm">
        <thead class="table-primary text-center">
          <tr>
            <th scope="col">👤 Name</th>
            <th scope="col">📧 Email</th>
            <th scope="col">📞 Phone</th>
            <th scope="col">🏥 Specialty</th>
            <th scope="col">📅 Available Slots</th>
            <th scope="col">📍 Status</th>
            <th scope="col">⚙️ Actions</th>
          </tr>
        </thead>
        <tbody class="text-center">
          @forelse($doctors as $doctor)
        <tr>
          <td>  <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="Doctor Image" width="50" height="50" />
         </td>
          <td>{{ $doctor->name }}</td>
          <td>{{ $doctor->email }}</td>
          <td>{{ $doctor->phone }}</td>
          <td>
          <span class="badge bg-info text-dark">
          {{ $doctor->specialist->name_en ?? 'N/A' }}
          </span>
          </td>
          <td>
        @if(is_array($doctor->available_slots))
        @foreach($doctor->available_slots as $slot)
        <li>{{ $slot }}</li>
        @endforeach
      @else
        <span class="text-muted">N/A</span>
      @endif
          </td>
          <td>
          <span class="badge rounded-pill {{ $doctor->status ? 'bg-success' : 'bg-secondary' }}">
          {{ $doctor->status ? 'Active' : 'Inactive' }}
          </span>
          </td>
          <td>
          <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-sm btn-outline-info me-1">View</a>
          <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
          </td>
        </tr>
      @empty
            <tr>
              <td colspan="7" class="text-muted">No doctors found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</x-layout>
