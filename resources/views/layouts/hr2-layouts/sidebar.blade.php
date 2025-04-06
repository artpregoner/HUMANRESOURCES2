<flux:sidebar sticky stashable class="border-r bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Human Resources" class="px-2 dark:hidden" />
    <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Human Resources" class="hidden px-2 dark:flex" />

    <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" :href="route('hr2.index')"
            :current="request()->is('hr2')"
            wire:navigate>Dashboard
        </flux:navlist.item>
        <flux:navlist.item icon="currency-dollar" :href="route('hr2.claims.index')"
            :current="request()->Is('hr2/claims') || request()->is('hr2/claims/*')" wire:navigate>Claims Request</flux:navlist.item>
        <flux:navlist.item icon="inbox" badge="{{ $ticketCount }}"
            :href="route('hr2.helpdesk.index')"
            :current="request()->routeIs('hr2/helpdesk') || request()->is('hr2/helpdesk/*')" wire:navigate>Tickets
        </flux:navlist.item>
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" :href="route('home')" target="_blank">Portal</flux:navlist.item>
    </flux:navlist>

    <flux:separator />

    <flux:navlist variant="outline">
        <flux:radio.group variant="outline" x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">Light</flux:radio>
            <flux:radio value="dark" icon="moon">Dark</flux:radio>
        </flux:radio.group>
    </flux:navlist>

    <flux:dropdown position="top" align="start" class="max-lg:hidden">
        <flux:profile avatar="{{ Auth::user()->profile_photo_url ?? asset('template/assets/images/avatar-1.jpg') }}" name="{{  Auth::user()->name }}" />

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
