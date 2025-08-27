<x-layout>
  <div class="container mt-5">
    <h2 class="text-primary fw-bold mb-4">Create Booking</h2>

    <form method="POST" action="{{ route('bookings.store') }}">
      @csrf

      <!-- Select Doctor -->
      <div class="mb-3">
        <label for="doctor_id" class="form-label fw-bold">Select Doctor</label>
        <select name="doctor_id" id="doctor_id" class="form-select" required>
          <option value="">-- Choose Doctor --</option>
          @foreach($doctors as $doctor)
            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
          @endforeach
        </select>
        @error('doctor_id') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <!-- Select Slot -->
      <div class="mb-3">
        <label for="time_slot" class="form-label fw-bold">Available Slot</label>
        <select name="time_slot" id="time_slot" class="form-select" required>
          <option value="">-- Choose Slot --</option>
          @foreach($doctors as $doctor)
            @foreach($doctor->available_slots ?? [] as $timeSlot)
              <option value="{{ $timeSlot }}">{{ $doctor->name }} - {{ $timeSlot }}</option>
            @endforeach
          @endforeach
        </select>
        @error('time_slot') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <!-- Booking Date -->
      <div class="mb-3">
        <label for="booking_date" class="form-label fw-bold">Booking Date</label>
        <input type="date" name="booking_date" id="booking_date" class="form-control" required>
        @error('booking_date') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <button type="submit" class="btn btn-success">Book Now</button>
    </form>
  </div>
</x-layout>
