@extends('layouts.app')

@section('content')
    @include('layouts.includes.home.nav')
    @include('layouts.includes.home.left_block')
    <div class="messenger_cont" style="overflow: hidden">
        <chat-messages :user="{{ auth()->user() }}" :conversation-id="{{$conversationId}}" :recipient="{{$user}}"></chat-messages>
    </div>
    @push('js')
    @endpush
@endsection
