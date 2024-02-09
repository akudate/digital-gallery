@extends('main.layout')
@section('content')
<div class="flex justify-center">
    <div class="relative w-full max-w-4xl max-h-full">
        <div class="relative">
            <section class="bg-gray-100 dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-2xl">
                    <form action="/add-foto-user" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full sm:row-span-3">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div id="dropzone-text" class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG, or GIF (MAX. 800x400px)</p>
                                        </div>
                                        <input id="dropzone-file" name="file" type="file" class="hidden" required/>
                                        <div id="image-preview" class="hidden w-full h-64 overflow-hidden">
                                            <!-- Image preview will be displayed here -->
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                <input type="text" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan judul foto" required>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Album (Optional)</label>
                                <select name="album" id="album" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Not Selected</option>
                                    @foreach ($album as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                <textarea style="resize: none" name="deskripsi" id="deskripsi" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan deskripsi singkat tentang isi foto" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Submit
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    document.getElementById('dropzone-file').addEventListener('change', handleFileSelect);

    function handleFileSelect(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const text = document.getElementById('dropzone-text');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();

            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Only image files are allowed.');
                return;
            }

            // Optionally, limit file size (in bytes)
            const maxSize = 5 * 1024 * 1024; // 5 MB
            if (file.size > maxSize) {
                alert('File size exceeds the maximum limit (5MB).');
                return;
            }

            reader.onload = function (e) {
                // Display image preview
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" alt="Image Preview">`;
                preview.classList.remove('hidden');
                text.classList.add('hidden');
            };

            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
