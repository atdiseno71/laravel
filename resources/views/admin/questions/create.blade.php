<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Question') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.questions.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="question_text" class="block text-sm font-medium text-gray-700">{{ __('Question Text') }}</label>
                            <textarea name="text" id="question_text" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">{{ __('Answers') }}</label>
                            <div id="answers_container">
                                <div class="flex items-center mt-2">
                                    <input type="text" name="answers[0][text]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Answer text">
                                    <input type="checkbox" name="answers[0][is_correct]" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-1 text-sm text-gray-700">Correct</span>
                                </div>
                                <div class="flex items-center mt-2">
                                    <input type="text" name="answers[1][text]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Answer text">
                                    <input type="checkbox" name="answers[1][is_correct]" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-1 text-sm text-gray-700">Correct</span>
                                </div>
                                <div class="flex items-center mt-2">
                                    <input type="text" name="answers[2][text]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Answer text">
                                    <input type="checkbox" name="answers[2][is_correct]" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-1 text-sm text-gray-700">Correct</span>
                                </div>
                                <div class="flex items-center mt-2">
                                    <input type="text" name="answers[3][text]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Answer text">
                                    <input type="checkbox" name="answers[3][is_correct]" value="1" class="ml-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-1 text-sm text-gray-700">Correct</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                {{ __('Save Question') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
