<div>
    <h1>Welcome, {{ auth()->user()->name }}</h1>
    <button wire:click="logout">Logout</button>
</div>
