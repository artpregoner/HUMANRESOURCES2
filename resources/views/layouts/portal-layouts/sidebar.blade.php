<flux:sidebar sticky stashable class="border-r bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand :href="route('landingpage')" logo="{{ asset ('asset/images/ecom-logo.png')}}" name="Human Resources" class="px-2 dark:hidden" />
    <flux:brand :href="route('landingpage')" logo="{{ asset ('asset/images/ecom-logo.png')}}" name="Human Resources" class="hidden px-2 dark:flex" />

    <flux:navlist variant="outline">

        <flux:navlist.item icon="home" :href="route('home')"
            :current="request()->is('portal')"
            wire:navigate>Dashboard
        </flux:navlist.item>

        <flux:navlist.item icon="user" :href="route('portal.myprofile')"
            :current="request()->is('portal/myprofile')"
            wire:navigate>My Profile
        </flux:navlist.item>

        <flux:navlist.item icon="currency-dollar" badge="{{ Auth::user()->claims->count() }}"
            :href="route('portal.claims.index')"
            :current="request()->Is('portal/claims') || request()->is('portal/claims/*')" wire:navigate>Expenses
        </flux:navlist.item>

        <flux:navlist.item icon="inbox" badge="{{ Auth::user()->tickets->count() }}"
            :href="route('portal.helpdesk.index')"
            :current="request()->routeIs('portal/helpdesk') || request()->is('portal/helpdesk/*')" wire:navigate>Tickets
        </flux:navlist.item>

    </flux:navlist>

    <flux:spacer />
    @adminOrHr
        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" :href="route('admin.index')" target="_blank">Back to Main</flux:navlist.item>
        </flux:navlist>
    @endadminOrHr

    @auth
        @php
            $roleTitle = match (Auth::user()->role){
                'admin' => 'Admin',
                'hr' => 'HR',
                'employee' => 'Employee',
                default => 'Unknown Role',
            }
        @endphp
    <flux:callout variant="success" icon="user" heading="User Role: {{$roleTitle}}" />
    @endauth

    <flux:separator />

    <flux:navlist variant="outline">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">Light</flux:radio>
            <flux:radio value="dark" icon="moon">Dark</flux:radio>
        </flux:radio.group>
    </flux:navlist>

    <flux:dropdown position="top" align="start" class="max-lg:hidden">
        @if (Auth::user()->profile_photo_path)
            <flux:profile
                avatar="{{ Auth::user()->profile_photo_url }}"
                name="{{ Auth::user()->name }}"
            />
        @else
            <flux:profile
            name="{{ Auth::user()->name }}" color="red"/>
        @endif

        <flux:menu>
            <flux:subheading>Signed in as</flux:subheading>
            <flux:heading>{{  Auth::user()->email }}</flux:heading>
            <flux:menu.separator />
            <flux:menu.item icon="arrow-right-start-on-rectangle" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </flux:menu.item>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:sidebar>
