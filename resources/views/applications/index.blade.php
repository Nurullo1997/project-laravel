<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <span class="text-blue-500 font bold text-xl">My Applications</span>

                    <!-- This is an example component -->
                    <div class='mt-5'>

                        @foreach ($applications as $application)
                            <div class="rounded-xl border p-5 mt-5 shadow-md w-9/12 bg-white">
                                <div class="flex w-full items-center justify-between border-b pb-3">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]">
                                        </div>
                                        <div class="text-lg font-bold text-slate-700">{{ $application->user->name }}
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-8">
                                        <button
                                            class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">
                                            # {{ $application->id }} </button>
                                        <div class="text-xs text-neutral-500"> {{ $application->created_at }} </div>
                                    </div>
                                </div>

                                <div class="flex justify-between">
                                    <div>
                                        <div class="mt-4 mb-3">
                                            <div class="mb-3 text-xl font-bold"> {{ $application->subject }} </div>
                                            <div class="text-sm text-neutral-600"> {{ $application->message }}
                                            </div>
                                        </div>

                                        <div>
                                            <div class="flex items-center justify-between text-slate-500">
                                                {{ $application->user->email }}

                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="border m-6 p-6 rounded hover:bg-gray-50 transition cursor-pointer flex flex-col items-center">
                                            @if (is_null($application->file_url))
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18 18 6M6 6l12 12" />
                                                </svg>
                                                No File
                                            @else
                                                <a href="{{ asset('storage/' . $application->file_url) }}"
                                                    target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>
                                                </a>
                                            @endif


                                        </div>
                                    </div>

                                </div>
                                @if ($application->answer()->exists())
                                    <div>
                                        <hr class="border">

                                        <h3 class="text-xs fond-bold mt-2 text-indigo-600">Answer:</h3>
                                        <p>{{ $application->answer->body }}</p>
                                    </div>
                                @else
                                    @if (auth()->user()->role->name == 'manager')
                                        <div class="flex justify-end">
                                            <a href="{{ route('answers.create', ['application' => $application->id]) }}"
                                                type="button"
                                                class="middle none center mr-4 rounded-lg bg-green-500 py-2 px-4 text-sm font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"data-ripple-light="true">
                                                Answer
                                            </a>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        @endforeach

                        {{ $applications->links() }}

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
