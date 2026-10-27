<nav>
    <x-nav-link href="{{route('showcase.index')}}" :active="request()->routeIs('showcase.index')">home</x-nav-link>
    <x-nav-link href="{{route('about')}}" :active="request()->routeIs('about')">about</x-nav-link>
    <x-nav-link href="{{route('login')}}" :active="request()->routeIs('login')">login</x-nav-link>
</nav>
