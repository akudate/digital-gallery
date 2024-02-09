@extends('main.layout')
@section('content')
<div>
    <div class="p-5 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 mb-5">
        <h3 class="text-3xl font-bold dark:text-white">My Foto</h3>
    </div>
    <div id="accordion-flush" data-accordion="open" data-active-classes="dark:bg-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
        @foreach ($groupedFoto as $month => $photos)
            <h2 id="accordion-flush-heading-{{ $loop->index + 1 }}">
                <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-400 dark:border-gray-500 dark:text-gray-400 gap-3 mb-4" data-accordion-target="#accordion-flush-body-{{ $loop->index + 1 }}" aria-expanded="true" aria-controls="accordion-flush-body-{{ $loop->index + 1 }}">
                    <span>{{ $month }}</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-{{ $loop->index + 1 }}" class="hidden" aria-labelledby="accordion-flush-heading-{{ $loop->index + 1 }}">
                <div class="columns-2 gap-4 md:columns-3 lg:columns-6">
                    @foreach ($photos as $photo)
                        <div class="relative group">
                            <a href="/view-foto/{{$photo->id}}" class="block relative">
                                <img class="mb-4 h-auto max-w-full rounded-lg transition-transform transform-gpu hover:scale-110" src="{{ asset('foto/' . $photo->file) }}" alt="">
                                <div class="absolute inset-0 bg-black opacity-0 transition-opacity group-hover:opacity-50 flex items-center justify-center rounded-lg">
                                    <i class="text-white fas fa-search fa-2x mr-1"></i>
                                    <div class="text-white ">{{$photo->judul}}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
