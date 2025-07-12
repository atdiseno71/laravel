<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exam Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Your Score') }}: {{ $score }} / {{ $totalQuestions }}</h3>

                    @foreach ($results as $result)
                        <div class="mb-6 p-4 border rounded-lg {{ $result['is_correct'] ? 'border-green-400 bg-green-50' : 'border-red-400 bg-red-50' }}">
                            <p class="font-semibold">{{ $loop->iteration }}. {{ $result['question']->text }}</p>
                            <p class="mt-2">{{ __('Your Answer') }}: <span class="{{ $result['is_correct'] ? 'text-green-600' : 'text-red-600' }}">{{ $result['selected_answer']->text }}</span></p>
                            @if (!$result['is_correct'])
                                <p class="text-green-600">{{ __('Correct Answer') }}: {{ $result['correct_answer']->text }}</p>
                            @endif
                        </div>
                    @endforeach

                    <div class="mt-6">
                        <form action="{{ route('exam.start') }}" method="POST">
                            @csrf
                            @if(isset($category))
                                <input type="hidden" name="category" value="{{ $category }}">
                            @endif
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                {{ __('Start New Exam') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
