<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Question') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.questions.update', $question) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="question_text" class="block text-sm font-medium text-gray-700">{{ __('Question Text') }}</label>
                            <textarea name="text" id="question_text" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('text', $question->text) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">{{ __('Answers') }}</label>
                            <div id="answers_container">
                                @foreach ($question->answers as $index => $answer)
                                    <div class="flex items-center mt-2">
                                        <input type="hidden" name="answers[{{ $index }}][id]" value="{{ $answer->id }}">
                                        <input type="text" name="answers[{{ $index }}][text]" value="{{ old('answers.' . $index . '.text', $answer->text) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Answer text">
                                        <input type="checkbox" name="answers[{{ $index }}][is_correct]" value="1" @checked(old('answers.' . $index . '.is_correct', $answer->is_correct)) class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <span class="ml-1 text-sm text-gray-700">Correct</span>
                                        <button type="button" class="ml-2 text-red-600 hover:text-red-900 remove-answer-btn">Remove</button>
                                    </div>
                                @endforeach
                                <button type="button" id="add_answer_btn" class="mt-4 px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Add Answer</button>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                {{ __('Update Question') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let answerIndex = {{ count($question->answers) }};
            const answersContainer = document.getElementById('answers_container');
            const addAnswerBtn = document.getElementById('add_answer_btn');

            addAnswerBtn.addEventListener('click', function () {
                const newAnswerHtml = `
                    <div class="flex items-center mt-2">
                        <input type="text" name="answers[${answerIndex}][text]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Answer text">
                        <input type="checkbox" name="answers[${answerIndex}][is_correct]" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-1 text-sm text-gray-700">Correct</span>
                        <button type="button" class="ml-2 text-red-600 hover:text-red-900 remove-answer-btn">Remove</button>
                    </div>
                `;
                answersContainer.insertAdjacentHTML('beforeend', newAnswerHtml);
                answerIndex++;
            });

            answersContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-answer-btn')) {
                    e.target.closest('.flex.items-center.mt-2').remove();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
