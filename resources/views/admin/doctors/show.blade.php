<x-layout>
  <div class="container mt-5">
    <div class="card shadow-sm border-0 rounded">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Doctor Details</h4>
        <a href="{{ route('doctors.index') }}" class="btn btn-sm btn-outline-light">← Back to Doctors</a>
      </div>

      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Name:</div>
          <div class="col-md-9">{{ $doctor->name }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Email:</div>
          <div class="col-md-9">{{ $doctor->email }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Phone:</div>
          <div class="col-md-9">{{ $doctor->phone }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Specialty:</div>
          <div class="col-md-9">{{ $doctor->specialist->name ?? 'N/A' }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Bio:</div>
          <div class="col-md-9">{{ $doctor->bio }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Available Slots:</div>
          <div class="col-md-9">
            @if(is_array($doctor->available_slots))
              @foreach($doctor->available_slots as $slot)
                <span class="badge bg-secondary me-1">{{ $slot }}</span>
              @endforeach
            @else
              {{ $doctor->available_slots }}
            @endif
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Status:</div>
          <div class="col-md-9">
            <span class="badge rounded-pill {{ $doctor->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
              {{ ucfirst($doctor->status) }}
            </span>
          </div>
        </div>

        {{-- Delete Form --}}
        <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger px-3">Delete</button>
        </form>
      </div>
    </div>
  </div>
</x-layout>
