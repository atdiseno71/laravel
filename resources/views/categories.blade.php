<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Exam Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Choose a category to start an exam:') }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($categories as $category)
                            <a href="{{ route('exam.index', ['category' => $category]) }}" class="block p-6 bg-gray-100 rounded-lg shadow hover:bg-gray-200 transition duration-150 ease-in-out">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $category }}</h4>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
