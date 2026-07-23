<x-layouts::app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">{{ $title }}</h1>
        {{-- <x-button wire:navigate href="{{ route('history.create') }}">{{ __('Install Kit') }}</x-button> --}}
      </div>
    </div>

    <h1>Change History</h1>

</x-layouts::app>
