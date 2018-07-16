<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>
<div class="media alert {{ $class }} row">
<div class="col-lg-5">
    <h4 class="media-heading">
        <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
        ({{ $thread->userUnreadMessagesCount(Auth::id()) }} non lus)</h4>
        </div>
        <div class="col-lg-2">
    <p>
    <strong>Dernier message :</strong> {{ $thread->latestMessage->body }}
    </p>
    <p>
    <strong> {{$thread->updated_at->diffForHumans()}} </strong>
    </p>
    </div>
    <div class="col-lg-2">
    <p>
        <small><strong>Créé par:</strong> {{ $thread->creator()->name }}</small>
    </p>
    </div>
    <div class="col-lg-2">
    <p>
        <small><strong>Participants:</strong> {{ $thread->participantsString(Auth::id()) }}</small>
    </p>
    </div>
</div>