<x-layout>
  <div class="container mt-5">
    <h2 class="text-primary fw-bold mb-4">Bookings Management</h2>

    <!-- Filters -->
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Bookings</h2>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary">
        + New Booking
    </a>
</div>
    <form method="GET" class="row g-2 mb-3">
      <div class="col-md-4">
        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
      </div>
      <div class="col-md-4">
        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
      </div>
      <div class="col-md-3">
        <select name="doctor_id" class="form-select">
          <option value="">All Doctors</option>
          @foreach(\App\Models\Doctor::all() as $doctor)
            <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
              {{ $doctor->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-1">
        <button class="btn btn-primary">Filter</button>
      </div>
    </form>

    <!-- Booking Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center">
        <thead class="table-primary">
          <tr>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Booking Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bookings as $booking)
          <tr>
            <td>{{ $booking->user->name }}</td>
            <td>{{ $booking->doctor->name }}</td>
            <td>{{ $booking->booking_date }}</td>
            <td>
              <span class="badge bg-info">{{ ucfirst($booking->status) }}</span>
            </td>
            <td>
              <!-- Update Status -->
              <form method="POST" action="/bookings/{{ $booking->id }}" class="d-inline">
                @csrf @method('PUT')
                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                  @foreach(['pending','confirmed','canceled','completed'] as $status)
                    <option value="{{ $status }}" {{ $booking->status == $status ? 'selected' : '' }}>
                      {{ ucfirst($status) }}
                    </option>
                  @endforeach
                </select>
              </form>

              <!-- Delete -->
              <form method="POST" action="/bookings/{{ $booking->id }}" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{ $bookings->links() }}
    </div>
  </div>
</x-layout>
