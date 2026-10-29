@props(['status' => 'tersedia', 'class' => ''])

@php
    $normalized = strtolower(str_replace(' ', '_', trim((string) $status)));
    $config = match($normalized) {
        'tersedia' => [
            'label' => 'Tersedia',
            'bg' => '#DCFCE7',
            'text' => '#166534',
            'border' => '#86EFAC',
            'dot' => '#16A34A',
        ],
        'dipinjam' => [
            'label' => 'Dipinjam',
            'bg' => '#FEF9C3',
            'text' => '#854D0E',
            'border' => '#FDE047',
            'dot' => '#CA8A04',
        ],
        'dalam_perbaikan', 'dalam perbaikan' => [
            'label' => 'Dalam Perbaikan',
            'bg' => '#FEE2E2',
            'text' => '#991B1B',
            'border' => '#FCA5A5',
            'dot' => '#DC2626',
        ],
        default => [
            'label' => ucwords(str_replace('_', ' ', $status)),
            'bg' => '#F3F4F6',
            'text' => '#374151',
            'border' => '#D1D5DB',
            'dot' => '#6B7280',
        ],
    };
@endphp

<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold tracking-wide shadow-xs {{ $class }}"
      style="background-color: {{ $config['bg'] }}; color: {{ $config['text'] }}; border: 1px solid {{ $config['border'] }};"
      role="status"
      aria-label="Status: {{ $config['label'] }}">
    <span class="w-2 h-2 rounded-full shrink-0" style="background-color: {{ $config['dot'] }};" aria-hidden="true"></span>
    <span>{{ $config['label'] }}</span>
</span>
