<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
            <h1 class="text-center font-bold text-xl">
                Log In
            </h1>

            <form method="POST" action="/sessions" class="mt-10">
                @csrf
                <x-form.input name="username" autocomplete="username" />
                <x-form.input name="password" type="password" autocomplete="password" />
                <x-form.button text="Log In" /> 
            </form>
            </x-panel>
        </main>
    </section>
</x-layout>