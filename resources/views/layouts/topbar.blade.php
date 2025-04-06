<flux:header class="block! bg-white lg:bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:navbar class="w-full lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="start">
            <flux:profile avatar="{{ Auth::user()->profile_photo_url ?? asset('template/assets/images/avatar-1.jpg') }}" />

            <flux:menu>
                <flux:subheading>Signed in as</flux:subheading>
                <flux:heading>{{  Auth::user()->email }}</flux:heading>
                <flux:menu.separator />

                <flux:menu.item icon="arrow-right-start-on-rectangle" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                </flux:menu.item>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:navbar>

    <flux:navbar scrollable>
        @php
            $role = Auth::user()->role;
            $redirectRoute = match ($role) {
                'admin' => 'admin.index',
                'hr' => 'hr2.index',
                'employee' => 'home',
                default => null,
            };
        @endphp
        @if ($redirectRoute)
            <flux:navbar.item :href="route($redirectRoute)"
                :current="request()->is('dashboard') || request()->is('hr2') || request()->is('portal')">Home
            </flux:navbar.item>
            <flux:breadcrumbs.item href=""></flux:breadcrumbs.item>
        @endif

        @hasSection('breadcrumbs')
            <flux:breadcrumbs>
                @yield('breadcrumbs')
            </flux:breadcrumbs>
        @endif
    </flux:navbar>
</flux:header>
