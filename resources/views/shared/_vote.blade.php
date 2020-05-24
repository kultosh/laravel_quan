@if ($model instanceof App\Question)
    @php
        $name = 'question';
        $firstURISegment = 'questions';
    @endphp
@elseif ($model instanceof App\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp
@endif

@php
    $form_id = $name . "-" . $model->id;
    $formAction =  "/{$firstURISegment}/{$model->id}/vote"
@endphp

<div class="d-fex flex-column vote-controls">
    <a title="This {{$name}} is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('up-vote-{{$form_id}}').submit();">
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form id="up-vote-{{$form_id}}" action="{{$formAction}}" method="post">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>

    <span class="votes-count">{{$model->votes_count}}</span>
    <a title="This {{$name}} is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}" onclick="event.preventDefault(); document.getElementById('down-vote-{{$form_id}}').submit();">
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form id="down-vote-{{$form_id}}" action="{{$formAction}}" method="post">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>

    @if ($model instanceof App\Question)
        @include ('shared._favorite',[
            'model' => $model
        ])
    @elseif ($model instanceof App\Answer)
    @include ('shared._accept',[
            'model' => $model
        ])
    @endif
</div>
