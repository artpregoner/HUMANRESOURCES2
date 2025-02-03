<div>
    <div class="list-group">
        @foreach($responses as $response)
            <div class="list-group-item">
                <h5>{{ $response->user->name }} ({{ $response->responded_at->diffForHumans() }})</h5>
                <p>{{ $response->response_text }}</p>
            </div>
        @endforeach
    </div>
</div>
