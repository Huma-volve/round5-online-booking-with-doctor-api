<x-layout>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-primary fw-bold">Specialist Management</h2>
      <a href="{{ route('specialists.create') }}" class="btn btn-outline-primary">+ Add New Specialist</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle shadow-sm">
        <thead class="table-primary text-center">
          <tr>
            <th scope="col">🖼 Icon</th>
            <th scope="col">🇬🇧 Name (EN)</th>
            <th scope="col">🇸🇦 Name (AR)</th>
            <th scope="col">📝 Description</th>
            <th scope="col">📍 Status</th>
            <th scope="col">⚙️ Actions</th>
          </tr>
        </thead>
        <tbody class="text-center">
          @forelse($specialists as $specialist)
            <tr>
            <td>
                @php
                    $media = $specialist->getFirstMedia('icons');
                  @endphp
                @if($media)
                    <img src="{{ asset('storage/' . $media->id . '/' . $media->file_name) }}" alt="Doctor Image"
                        style="display:block; width:50px; height:50px;" />
                @else
                    <span class="text-muted">No Icon</span>
                @endif
            </td>
              <td><a href = "/specialists/{{$specialist->id}}">{{ $specialist->name_en }}</a></td>
              <td>{{ $specialist->name_ar }}</td>
              <td>
                @if($specialist->description)
                  {{ Str::limit($specialist->description, 50) }}
                @else
                  <span class="text-muted">N/A</span>
                @endif
              </td>
              <td>
                <span class="badge rounded-pill {{ $specialist->is_active ? 'bg-success' : 'bg-secondary' }}">
                  {{ $specialist->is_active ? 'Active' : 'Inactive' }}
                </span>
              </td>
              <td>
                <a href="{{ route('specialists.edit', $specialist->id) }}" 
                   class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                <form action="{{ route('specialists.destroy', $specialist->id) }}" 
                      method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button type="submit" 
                          class="btn btn-sm btn-outline-danger"
                          onclick="return confirm('Delete this specialist?')">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-muted">No specialists found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</x-layout>
