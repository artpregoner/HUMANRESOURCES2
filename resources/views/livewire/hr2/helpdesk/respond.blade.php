<div>
    <div class="card">
        <div class="card-header d-flex">
            <div class="email-title">
                <span class="icon"><i class="fas fa-inbox"></i></span>
                Ticket response for:
                <span class="new-messages">{{ $ticket->title }}</span>
            </div>
            <div class="toolbar ml-auto d-flex align-items-center">
                <!-- Status Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-space btn-outline-code3 dropdown-toggle" type="button" wire:click="toggleStatusDropdown">
                        {{ ucfirst($ticket->status) }}
                    </button>

                    @if($showStatusDropdown)
                    <div class="dropdown-menu show">
                        <button wire:click="updateStatus('in_progress')" class="dropdown-item {{ $ticket->status == 'in_progress' ? 'text-info' : '' }}">
                            In Progress
                        </button>
                        <button wire:click="updateStatus('resolved')" class="dropdown-item {{ $ticket->status == 'resolved' ? 'text-success' : '' }}">
                            Resolved
                        </button>
                        <div class="dropdown-divider"></div>
                        <button wire:click="updateStatus('closed')" class="dropdown-item text-danger {{ $ticket->status == 'closed' ? 'active' : '' }}">
                            Closed
                        </button>
                    </div>
                    @endif
                </div>

                <!-- Reply Button -->
                <button wire:click="toggleReplyBox" class="btn btn-space btn-code3 btn-sm new-chat-btn ml-2">
                    <i class="fas fa-reply"></i> Reply
                </button>
            </div>

        </div>

        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Reply Box -->
            @if($showReplyBox)
            <div class="reply-box">
                <div class="reply-tools">
                    <label for="file-upload" class="btn btn-sm btn-light mr-2">
                        <i class="fas fa-paperclip"></i> Add File
                    </label>
                    <small class="text-muted ml-2">Maximum 10 files total</small>
                </div>

                <div class="reply-input-container">
                    <div class="form-group">
                        <textarea
                            class="form-control @error('response') is-invalid @enderror"
                            placeholder="Type your reply here..."
                            wire:model.defer="response"
                            rows="3"
                        ></textarea>
                        @error('response')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <input
                        id="file-upload"
                        type="file"
                        wire:model="files"
                        class="d-none"
                        multiple
                    >

                    <!-- File Preview Section -->
                    @if($files)
                    <div class="mt-3">
                        @foreach($files as $file)
                        <div class="file-preview-item d-flex align-items-center mb-2">
                            @if(in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ $file->temporaryUrl() }}" class="mr-2" style="height: 40px; width: 40px; object-fit: cover;">
                            @else
                                <i class="fas fa-file mr-2"></i>
                            @endif
                            <span>{{ $file->getClientOriginalName() }}</span>
                            <button type="button" wire:click="removeFile({{ $loop->index }})" class="btn btn-sm btn-danger ml-auto">×</button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="reply-actions mt-3">
                    <button type="button" wire:click="discardReply" class="btn btn-light mr-2">
                        <i class="fas fa-times"></i> Discard
                    </button>
                    <button type="button" wire:click="sendReply" class="btn btn-code3">
                        <i class="fas fa-paper-plane"></i> Send
                    </button>
                </div>
            </div>
            @endif

            <!-- Messages Display -->
            <div class="chatbox">
                @foreach ($responses->reverse() as $response)
                    <div class="chatbox-messages">
                        <div class="chat-message received">
                            <img src="{{ $response->user->profile_photo_path ? Storage::url($response->user->profile_photo_path) : asset('template/assets/images/avatar-1.jpg') }}" alt="Admin" class="user-avatar-lg rounded-circle">
                            <div class="chat-details {{ Auth::id() === $response->user_id ? 'current-user' : '' }}">
                                @if (Auth::id() === $response->user_id)
                                    <span class="message-author">You</span>
                                @else
                                    <span class="message-author">{{ $response->user->name }}</span>
                                @endif
                                <p class="message-text">{{ $response->response_text }}</p>

                                <!-- Attachments Display -->
                                @if($response->files->count() > 0)
                                <div class="message-attachment">
                                    @foreach ($response->files as $file)
                                        @if (in_array($file->file_type, ['image/jpeg', 'image/png', 'image/gif', 'image/webp']))
                                            <img
                                                src="{{ asset('storage/' . $file->file_path) }}"
                                                alt="Attached Image"
                                                class="message-image cursor-pointer modalThisImage"
                                                wire:click="showImage('{{ asset('storage/' . $file->file_path) }}')"
                                            >
                                        @else
                                            <div class="media media-attachment">
                                                <div class="avatar bg-primary">
                                                    <i class="far fa-file"></i>
                                                </div>
                                                <div class="media-body">
                                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                                        {{ $file->file_name }}
                                                    </a>
                                                    <span>{{ number_format($file->file_size / 1024, 2) }} KB</div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @endif
                                <span class="message-time">{{ $response->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        <hr class="message-divider">
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    {{-- <!-- Image Modal -->
    @if($selectedImage)
    <div class="modal fade show" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" wire:click="closeImageModal" class="close">×</button>
                </div>
                <div class="modal-body">
                    <img src="{{ $selectedImage }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif --}}
    @if ($selectedImage)
        <div id="imageModal" class="modal">
            <button wire:click="closeImageModal" class="close-btn btn btn-dark btn-rounded"><i class="fas fa-times"></i></button>
            <img src="{{ $selectedImage }}" id="modalImg" alt="Modal Image">
        </div>
    @endif
</div>
