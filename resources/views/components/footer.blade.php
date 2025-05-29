<footer class="bg-gray-200 text-gray-900 py-6 w-full mt-10 border-t border-gray-500">
    <div class="container mx-auto px-4 flex flex-col md:flex-row justify-around items-center">
        <div class="mb-2 md:mb-0">
            <span class="font-bold">My Library</span> &copy; {{ date('Y') }}. All rights reserved.
            <span class="ml-2 text-gray-400 text-xs">Built with Laravel & TailwindCSS</span>
        </div>
        <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4 text-sm">
            <a href="{{ url('/') }}" class="hover:underline">Home</a>
            <a href="{{ route('books.byGenre', ['genre_name' => 'all']) }}" class="hover:underline">Books</a>
            <a href="" class="hover:underline">About</a>
            <a href="" class="hover:underline">Contact</a>
            <a href="mailto:support@mylibrary.com" class="hover:underline">support@mylibrary.com</a>
        </div>
        <div class="mt-4 md:mt-0 text-xs text-gray-400">
            <span>Follow us:</span>
            <a href="https://instagram.com" target="_blank" class="ml-2 hover:text-pink-400">Instagram</a> |
            <a href="https://facebook.com" target="_blank" class="ml-2 hover:text-blue-400">Facebook</a>
        </div>
    </div>
</footer>