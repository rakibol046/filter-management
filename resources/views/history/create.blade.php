<x-layouts::app :title="$title">

    <div class="max-w-3xl mx-auto space-y-6">

       <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ $title }}</h1>

            <a href="{{ route('history') }}"
               class="rounded bg-gray-600 px-4 py-2 text-white hover:bg-gray-700">
                Back to History
            </a>
        </div>

        <div class="mb-6 rounded-lg border p-4 bg-gray-50 dark:bg-gray-900">
    <h2 class="text-xl font-bold mb-4">{{ $filter->name }}</h2>

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <span class="font-semibold">Brand:</span>
            {{ $filter->brand ?: 'N/A' }}
        </div>

        <div>
            <span class="font-semibold">Model:</span>
            {{ $filter->model ?: 'N/A' }}
        </div>

        <div class="col-span-2">
            <span class="font-semibold">Description:</span>
            {{ $filter->description ?: 'N/A' }}
        </div>

        <div>
            <span class="font-semibold">Status:</span>
            <span class="{{ $filter->status ? 'text-green-600' : 'text-red-600' }}">
                {{ $filter->status ? 'Active' : 'Inactive' }}
            </span>
        </div>
    </div>
</div>

        <form method="POST" action="{{ route('history.store') }}">
            @csrf

            <div class="space-y-4">

                  <div>
                    <label>Select the Kit</label>

                    <select name="filter_id" class="w-full border rounded p-2">
                        @foreach ($kits as $kit)
                            <option class="text-black" value="{{ $kit->id }}">{{ $kit->name }}</option>
                        @endforeach
                        @error('filter_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </select>
                </div>

               <div>
                    <label>Install Date</label>

                    <input
                        type="date"
                        name="date"
                        value="{{ old('date', now()->format('Y-m-d')) }}"
                        class="w-full border rounded p-2"
                    >

                    @error('date')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


               

                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    Install Kit
                </button>

            </div>

        </form>

    </div>

</x-layouts::app>