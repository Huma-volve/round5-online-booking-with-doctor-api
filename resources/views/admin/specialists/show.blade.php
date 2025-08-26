<x-layout>
  <div class="container mt-5">
    <div class="card shadow-sm border-0 rounded">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Specialist Details</h4>
        <a href="{{ route('specialists.index') }}" class="btn btn-sm btn-outline-light">← Back to Specialists</a>
      </div>

      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Name (EN):</div>
          <div class="col-md-9">{{ $specialist->name_en }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Name (AR):</div>
          <div class="col-md-9">{{ $specialist->name_ar }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Description:</div>
          <div class="col-md-9">
            {{ $specialist->description ?? 'N/A' }}
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Icon / Image:</div>
          <div class="col-md-9">

            @php
                    $media = $specialist->getFirstMedia('icons');
                  @endphp
                @if($media)
                    <img src="{{ asset('storage/' . $media->id . '/' . $media->file_name) }}" alt="Doctor Image"
                        style="display:block; width:50px; height:50px;" />
                @else
                    <span class="text-muted">No Icon</span>
                @endif
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 fw-semibold text-secondary">Status:</div>
          <div class="col-md-9">
            <span class="badge rounded-pill {{ $specialist->is_active ? 'bg-success' : 'bg-secondary' }}">
              {{ $specialist->is_active ? 'Active' : 'Inactive' }}
            </span>
          </div>
        </div>

        {{-- Delete Form --}}
        <form action="{{ route('specialists.destroy', $specialist->id) }}" 
              method="POST" 
              onsubmit="return confirm('Are you sure you want to delete this specialist?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger px-3">Delete</button>
        </form>
      </div>
    </div>
  </div>
</x-layout>
