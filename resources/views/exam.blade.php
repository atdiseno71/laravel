<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('NCLEX Exam') }} @if(isset($category)) - {{ $category }} @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($question)
                        <p class="text-lg font-semibold">{{ $question->text }}</p>

                        <form action="{{ route('exam.answer') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            @foreach ($question->answers as $answer)
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="answer_id" value="{{ $answer->id }}" class="form-radio">
                                        <span class="ml-2">{{ $answer->text }}</span>
                                    </label>
                                </div>
                            @endforeach

                            <div class="mt-6">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    {{ __('Submit Answer') }}
                                </button>
                            </div>
                        </form>
                    @else
                        <p>{{ __('No questions available at the moment.') }}</p>
                        <form action="{{ route('exam.start') }}" method="POST" class="mt-4">
                            @csrf
                            @if(isset($category))
                                <input type="hidden" name="category" value="{{ $category }}">
                            @endif
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                {{ __('Start New Exam') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
