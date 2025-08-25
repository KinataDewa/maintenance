@extends('layouts.app')

@section('title', 'Checklist Hari Ini')

@push('styles')
    <style>
        /* Table Styling */
        .table-custom {
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .table-custom thead {
            background: #343a40;
            color: #fff;
        }
        .table-custom th, 
        .table-custom td {
            vertical-align: middle;
        }

        /* Toggle khusus halaman checklist */
        .checklist-toggle-switch {
            position: relative;
            width: 65px;
            height: 34px;
            flex-shrink: 0;
        }

        .checklist-toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .checklist-slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #dee2e6;
            transition: 0.4s;
            border-radius: 50px;
        }

        .checklist-slider::before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: #fff;
            transition: 0.4s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .checklist-toggle-switch input:checked + .checklist-slider {
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .checklist-toggle-switch input:checked + .checklist-slider::before {
            transform: translateX(30px);
        }

        /* Label */
        .checklist-switch-label {
            font-weight: 600;
            font-size: 0.95rem;
            margin-left: 12px;
            min-width: 42px;
            text-align: center;
            color: #6c757d;
            transition: color 0.3s, transform 0.2s;
        }

        .checklist-switch-label.on {
            color: #28a745;
            transform: scale(1.05);
        }

        .checklist-switch-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }

        /* Hover row effect */
        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
            transition: 0.2s;
        }

        /* Responsive adjustment */
        @media (max-width: 576px) {
            .checklist-switch-label {
                font-size: 0.85rem;
                margin-left: 8px;
            }
            .checklist-toggle-switch {
                width: 55px;
                height: 30px;
            }
            .checklist-slider::before {
                height: 22px;
                width: 22px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-4 text-dark fw-bold">Checklist On/Off
        </h1>

        <div class="table-responsive">
            <table class="table table-custom text-start">
                <thead class="text-center">
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Perangkat</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perangkat as $index => $item)
                        @php
                            $latest = $item->checklists->first();
                            $isOn = $latest && $latest->aksi === 'on';
                        @endphp
                        <tr>
                            <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                            <td class="fw-medium">{{ $item->nama }}</td>
                            <td class="text-center">
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
