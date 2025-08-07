@extends('layouts.app')

@section('title', 'Checklist Hari Ini')

@push('styles')
    <style>
        .form-switch .form-check-input {
            width: 3rem;
            height: 1.5rem;
            cursor: pointer;
        }

        .form-switch .form-check-input:checked {
            background-color: #28a745; /* green */
            border-color: #28a745;
        }

        .form-switch .form-check-input:focus {
            box-shadow: none;
        }

        .form-check-label {
            font-weight: 600;
            font-size: 1rem;
            min-width: 40px;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-4">Checklist Hari Ini</h1>

        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Perangkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perangkat as $index => $item)
                    @php
                        $latest = $item->checklists->first();
                        $isOn = $latest && $latest->aksi === 'on';
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            <form action="{{ route('checklist.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="perangkat_id" value="{{ $item->id }}">
                                <input type="hidden" name="aksi" id="aksi{{ $item->id }}">
                                <div class="form-check form-switch d-flex justify-content-center align-items-center">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="switch{{ $item->id }}" onchange="submitToggle(this)"
                                        {{ $isOn ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2 text-{{ $isOn ? 'success' : 'secondary' }}"
                                        for="switch{{ $item->id }}">
                                        {{ $isOn ? 'ON' : 'OFF' }}
                                    </label>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        function submitToggle(checkbox) {
            const form = checkbox.closest('form');
            const aksiInput = form.querySelector('input[name="aksi"]');
            aksiInput.value = checkbox.checked ? 'on' : 'off';
            form.submit();
        }
    </script>
@endpush
