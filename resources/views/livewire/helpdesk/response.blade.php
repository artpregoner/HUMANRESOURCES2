<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label>Response</label>
            <textarea class="form-control" wire:model="responseText"></textarea>
            @error('responseText') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Response</button>
    </form>

</div>
