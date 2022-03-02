<!doctype html>

<title>LightningSnaps</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
 <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

 <style>
    html {
        scroll-behavior: smooth;
    }
 </style>

 <!-- header -->
<body style="font-family: Open Sans, sans-serif" class="bg-zinc-500">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo1.png" alt="LightningSnaps Logo" width="200" height="32">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @auth
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="text-xs font-bold uppercase">
                                Welcome, {{ auth()->user()->name }}!
                            </button>
                        </x-slot>
                        
                        <x-dropdown-item href="/" :active="request()->is('/')">
                            Home
                        </x-dropdown-item>
                        @can('admin')
                        <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')">
                            New Post
                        </x-dropdown-item>
                        <x-dropdown-item href="/admin/posts" :active="request()->is('admin/posts')">
                            Manage Posts
                        </x-dropdown-item>
                        @endcan
                        <x-dropdown-item href="#" x-data="{}" @click.prevent="document.querySelector('#logout-form').submit()">
                            Log Out
                        </x-dropdown-item>

                    </x-dropdown> 

                    <form id="logout-form" method="POST" action="/logout" class="hidden">
                        @csrf
                        <button type="submit">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="/register" class="text-xs font-bold uppercase mr-4">
                        Register
                    </a>
                    <a href="/login" class="text-xs font-bold uppercase">
                        Log In    
                    </a>

                @endauth

                <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>
            </div>
        </nav>

        {{ $slot }}  <!-- default blade insertion variable -->

        <!-- footer -->
        <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <h5 class="text-3xl">Stay in touch with the latest posts</h5>
            <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="/newsletter" class="lg:flex text-sm">
                        @csrf

                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <input id="email" 
                                   name="email"
                                   type="text" 
                                   placeholder="Your email address"
                                   class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                        </div>

                        <button type="submit"
                                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                        >
                            Subscribe
                        </button>
                        <x-validation-error>
                            We were unable to add that address to our mailing list 
                        </x-validation-error>

                    </form>
                </div>
            </div>
        </footer>
    </section>

    <x-flash />
</body>
