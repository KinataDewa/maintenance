@extends('layouts.app')

@section('title', 'Checklist Hari Ini')

@push('styles')
    <style>
        /* Toggle khusus halaman checklist */
        .checklist-toggle-switch {
            position: relative;
            width: 60px;
            height: 32px;
        }

        .checklist-toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .checklist-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .checklist-slider::before {
            position: absolute;
            content: "";
            height: 24px;
            width: 24px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        .checklist-toggle-switch input:checked + .checklist-slider {
            background-color: #28a745;
        }

        .checklist-toggle-switch input:checked + .checklist-slider::before {
            transform: translateX(28px);
        }

        .checklist-switch-label {
            font-weight: 600;
            font-size: 1rem;
            margin-left: 12px;
            min-width: 40px;
            color: #6c757d;
            transition: color 0.3s;
        }

        .checklist-switch-label.on {
            color: #28a745;
        }

        .checklist-switch-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-4">Checklist On/Off</h1>

        <table class="table table-bordered text-start">
            <thead class="table-dark text-center">
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

                                <div class="checklist-switch-wrapper">
                                    <label class="checklist-toggle-switch">
                                        <input type="checkbox"
                                               id="switch{{ $item->id }}"
                                               onchange="submitToggle(this)"
                                               {{ $isOn ? 'checked' : '' }}>
                                        <span class="checklist-slider"></span>
                                    </label>
                                    <span class="checklist-switch-label {{ $isOn ? 'on' : '' }}"
                                          id="label{{ $item->id }}">
                                        {{ $isOn ? 'ON' : 'OFF' }}
                                    </span>
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
            const label = form.querySelector('.checklist-switch-label');
            const isOn = checkbox.checked;

            aksiInput.value = isOn ? 'on' : 'off';
            label.textContent = isOn ? 'ON' : 'OFF';
            label.classList.toggle('on', isOn);

            form.submit();
        }
    </script>
@endpush
