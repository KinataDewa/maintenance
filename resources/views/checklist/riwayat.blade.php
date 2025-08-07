@extends('layouts.app')

@section('title', 'Riwayat Checklist')

@section('content')
<div class="container">
    <h1 class="page-title">Riwayat Checklist</h1>
    
    @if($groupedChecklists->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada riwayat checklist.
        </div>
    @else
        <div class="accordion" id="checklistAccordion">
            @foreach ($groupedChecklists as $tanggal => $checklists)
                @php
                    $accordionId = 'collapse-' . \Str::slug($tanggal);
                @endphp
                <div class="accordion-item mb-2 shadow-sm">
                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                        <button class="accordion-button collapsed bg-dark text-white fw-bold" type="button"
                            data-bs-toggle="collapse" data-bs-target="#{{ $accordionId }}"
                            aria-expanded="false" aria-controls="{{ $accordionId }}">
                            {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                        </button>
                    </h2>
                    <div id="{{ $accordionId }}" class="accordion-collapse collapse"
                        aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#checklistAccordion">
                        <div class="accordion-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm mb-0 text-dark">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Perangkat</th>
                                            <th>Aksi</th>
                                            <th>Jam</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checklists as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->perangkat->nama }}</td>
                                                <td class="text-uppercase text-{{ $item->aksi === 'on' ? 'success' : 'danger' }}">
                                                    {{ $item->aksi }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                                                <td>{{ $item->user->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
