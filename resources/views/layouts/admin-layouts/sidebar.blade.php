<flux:sidebar sticky stashable class="border-r bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand :href="route('landingpage')" logo="{{ asset ('asset/images/ecom-logo.png')}}" name="FAR EAST" class="px-2 dark:hidden" />
    <flux:brand :href="route('landingpage')" logo="{{ asset ('asset/images/ecom-logo.png')}}" name="FAR EAST" class="hidden px-2 dark:flex" />

    <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" :href="route('admin.index')"
            :current="request()->is('dashboard')"
            wire:navigate>Dashboard
        </flux:navlist.item>

        <flux:navlist.group expandable heading="Workforce Analytics">
            <flux:navlist.item :href="route('admin.workforce.index')"
                :current="request()->is('workforce/analytics')" wire:navigate>Analytics
            </flux:navlist.item>
        </flux:navlist.group>

        <flux:navlist.item icon="currency-dollar" badge="{{ $claimCount }}" :href="route('admin.claims.index')"
            :current="request()->Is('claims') || request()->is('claims/*')" wire:navigate>Claims Request
        </flux:navlist.item>

        <flux:navlist.item icon="inbox" badge="{{ $ticketCount }}"
            :href="route('admin.helpdesk.index')"
            :current="request()->routeIs('helpdesk') || request()->is('helpdesk/*')" wire:navigate>Tickets
        </flux:navlist.item>

        <flux:navlist.item icon="user" :href="route('admin.index.employee')"
            :current="request()->is('self-service/employee/*')"
            wire:navigate>EmployeeList
        </flux:navlist.item>
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" :href="route('home')" target="_blank">Portal</flux:navlist.item>
    </flux:navlist>
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
            name="{{ Auth::user()->name }}" avatar:color="auto"/>
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
        </flux:menu.seperator>
    </flux:dropdown>
</flux:sidebar>
