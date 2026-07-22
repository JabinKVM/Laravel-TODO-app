@extends('layouts.master')

@section('title','Chat')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">
<h4 class="mb-4">Messages</h4>

<div class="chat-page">

    <div class="chat-wrapper">

        <!-- ========================= -->
        <!-- LEFT PANEL -->
        <!-- ========================= -->

        <div class="chat-left">

            <!-- Profile -->

            <div class="chat-profile">

                <div class="d-flex align-items-center">

                    @php
                        $me = auth()->user();
                    @endphp

                    <img
                        src="{{ $me->profile_photo
                                ? asset('storage/'.$me->profile_photo)
                                : asset('assets/images/users/avatar-1.jpg') }}"
                        class="profile-avatar">

                    <div class="ms-3">

                        @if($role=='school')

                            <h3>{{ $me->school->name }}</h3>

                            <span class="status">

                                <i class="bx bxs-circle text-success"></i>

                                Active

                            </span>

                        @else

                            <h3>{{ $me->student->name }}</h3>

                            <span class="status">

                                <i class="bx bxs-circle text-success"></i>

                                Online

                            </span>

                        @endif

                    </div>

                </div>

            </div>

            <!-- Search -->

            <div class="chat-search">

                <form method="GET">

                    <div class="search-box">

                        <i class="bx bx-search"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search conversations...">

                       

                    </div>

                </form>

            </div>

            <!-- Heading -->

            <div class="chat-heading">

                <h4>Chats</h4>

                <small>Recent Conversations</small>

            </div>

            <!-- Contact List -->

            <div class="chat-users">

                @forelse($contacts as $contact)

                    @php

                        $chatRoute = $role=='school'
                            ? route('school.chat.open',$contact->id)
                            : route('student.chat.open',$contact->id);

                        $photo = optional($contact->user)->profile_photo;

                    @endphp

                    <a
                        href="{{ $chatRoute }}"
                        class="chat-user-item {{ $activeChat==$contact->id ? 'active' : '' }}">

                        <div class="user-avatar">

                            <img
                                src="{{ $photo
                                        ? asset('storage/'.$photo)
                                        : asset('assets/images/users/avatar-2.jpg') }}">

                            <span class="online-dot"></span>

                        </div>

                        <div class="user-details">

                            <div class="user-top">

                                <h5>

                                    {{ $contact->name }}

                                </h5>

                                <small>

                                    @if($contact->last_message_time)

                                        {{ $contact->last_message_time->format('h:i A') }}

                                    @endif

                                </small>

                            </div>

                            <div class="user-bottom">

                                <span>

                                    {{ $contact->last_message
                                        ? \Illuminate\Support\Str::limit($contact->last_message,28)
                                        : 'Start conversation...' }}

                                </span>

                                @if($contact->unread_count)

                                    <span class="unread-count">

                                        {{ $contact->unread_count }}

                                    </span>

                                @endif

                            </div>

                        </div>

                    </a>

                @empty

                    <div class="empty-chat-list">

                        <img
                            src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                            width="90">

                        <h5 class="mt-4">

                            No Conversations

                        </h5>

                    </div>

                @endforelse

            </div>

        </div>

        <!-- ========================= -->
        <!-- RIGHT PANEL -->
        <!-- ========================= -->

        <div class="chat-right">

            @if($chatUser)

                @php

                    $chatPhoto = optional($chatUser->user)->profile_photo;

                @endphp

                <div class="chat-header">

                    <div class="chat-user-info">

                        <img
                            src="{{ $chatPhoto
                                    ? asset('storage/'.$chatPhoto)
                                    : asset('assets/images/users/avatar-2.jpg') }}"
                            class="header-avatar">

                        <div>

                            <h4>{{ $chatUser->name }}</h4>

                            <small class="text-success">

                                <i class="bx bxs-circle"></i>

                                Online

                            </small>

                        </div>

                    </div>
                    <!-- message search
                    <div class="chat-actions">

                        <button>

                            <i class="bx bx-search"></i>

                        </button>

                        <button>

                            <i class="bx bx-phone"></i>

                        </button>

                        <button>

                            <i class="bx bx-dots-vertical-rounded"></i>

                        </button>

                    </div> -->

                </div>

                <!-- Chat body starts here -->

                <div class="chat-body" id="chatBody">

                    <div class="chat-date">

                        <span>Today</span>

                    </div>

                                        @forelse($messages as $message)

                        @if($message->sender_id == auth()->id())

                            <!-- Outgoing Message -->

                            <div class="message-row message-right">

                                <div class="message-box outgoing">

                                    <div class="message-text">

                                        {{ $message->message }}

                                    </div>

                                    <div class="message-info">

                                        <span>

                                            {{ $message->created_at->format('h:i A') }}

                                        </span>

                                        <i class="bx bx-check-double"></i>

                                    </div>

                                </div>

                            </div>

                        @else

                            <!-- Incoming Message -->

                            <div class="message-row message-left">

                                <div class="message-box incoming">

                                    <div class="message-text">

                                        {{ $message->message }}

                                    </div>

                                    <div class="message-info">

                                        <span>

                                            {{ $message->created_at->format('h:i A') }}

                                        </span>

                                    </div>

                                </div>

                            </div>

                        @endif

                    @empty

                        <div class="empty-chat">

                            <img
                                src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                width="110">

                            <h3 class="mt-4">

                                No Messages Yet

                            </h3>

                            <p class="text-muted">

                                Start your first conversation.

                            </p>

                        </div>

                    @endforelse

                </div>

                <!-- ========================= -->
                <!-- Chat Footer -->
                <!-- ========================= -->

                @php

                    $sendRoute = $role == 'school'
                        ? route('school.chat.send',$conversation->id)
                        : route('student.chat.send',$conversation->id);

                @endphp

                <div class="chat-footer">

                    <form
                        action="{{ $sendRoute }}"
                        method="POST">

                        @csrf

                        <div class="chat-input-box">
                            <!--
                            <button
                                type="button"
                                class="input-icon">

                                <i class="bx bx-smile"></i>

                            </button> -->

                            <input
                                type="text"
                                name="message"
                                class="chat-input"
                                placeholder="Type your message..."
                                autocomplete="off"
                                required>
                            <!-- file send
                            <button
                                type="button"
                                class="input-icon">

                                <i class="bx bx-paperclip"></i>

                            </button> -->

                            <button
                                type="submit"
                                class="send-button">

                                <i class="bx bx-send"></i>

                            </button>

                        </div>

                    </form>

                </div>

            @else

                <!-- Empty Screen -->

                <div class="chat-empty-screen">

                    <div class="text-center">

                       

                        <h3 class="mt-4">

                            Welcome to TodoPro Chat

                        </h3>

                        <p class="text-muted">

                            Select a conversation from the left to start chatting.

                        </p>

                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

<script src="{{ asset('assets/js/chat.js') }}"></script>

@endsection
                    