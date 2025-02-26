<div>
    {{-- @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif --}}
    @include('components.alert.alert')

    <form wire:submit.prevent="save">
        <div class="card">
            <div class="card-header">
                <h5 class="email-title">Profile Picture</h5>
            </div>
            <div class="card-body text-center">
                <input type="file"
                       wire:model="photo"
                       class="d-none"
                       id="upload-photo"
                       accept="image/*">
                <label for="upload-photo"
                       class="user-avatar d-block"
                       x-data="{ dragOver: false }"
                       x-on:dragover.prevent="dragOver = true"
                       x-on:dragleave.prevent="dragOver = false"
                       x-on:drop.prevent="dragOver = false; $refs.input.files = $event.dataTransfer.files; $refs.input.dispatchEvent(new Event('change'));"
                       :class="{ 'drag-over': dragOver }">
                    @if ($photo)
                        <img src="{{ $photo->temporaryUrl() }}"
                             alt="Profile Preview"
                             class="rounded-circle user-avatar-xxl">
                    @else
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('template/assets/images/avatar-1.jpg') }}"
                             alt="User Avatar"
                             class="rounded-circle user-avatar-xxl">
                    @endif
                </label>
                @error('photo')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
                <div wire:loading wire:target="photo" class="text-primary">
                    <i class="fas fa-spinner fa-spin"></i> Uploading files...
                </div>
                @if ($photo)
                    <p class="text-success">Preview updated! Click save.</p>
                @endif
            </div>
            <div class="card-footer d-flex text-muted">
                Click the image above or drag & drop a new one. (128x128px recommended, max 5MB)
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                <div class="section-block" id="cards">
                    <h3 class="section-title">Profile Information</h3>
                    <p>Update your account's profile information.</p>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName" class="col-form-label">Name</label>
                            <input id="inputName"
                                   type="text"
                                   wire:model="name"
                                   class="form-control form-control-lg">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                            </div>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-dark active">SAVE</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        Livewire.on('photoUpdated', () => {
            alert('Profile photo updated successfully!');
        });
    </script>
</div>
