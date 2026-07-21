@extends('layouts.master')

@section('title','Messages')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <div class="row">

            <!-- Contact List -->

            <div class="col-lg-4">

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title mb-0">

                            Messages

                        </h4>

                    </div>

                    <div class="card-body p-0">

                        <div class="p-3">

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search..."
                            >

                        </div>

                        <div style="height:650px;overflow-y:auto;">

                            @forelse($contacts as $contact)

                                @php

                                    if($role=='school'){
                                        $route = route('school.chat.open',$contact->id);
                                        $name = $contact->name;
                                        $subtitle = $contact->student_id;
                                    }else{
                                        $route = route('student.chat.open',$contact->id);
                                        $name = $contact->school_name;
                                        $subtitle = $contact->email;
                                    }

                                @endphp

                                <a href="{{ $route }}"
                                   class="text-decoration-none text-dark">

                                    <div class="d-flex align-items-center p-3 border-bottom">

                                        <div class="avatar-sm">

                                            <span class="avatar-title rounded-circle bg-primary">

                                                {{ strtoupper(substr($name,0,1)) }}

                                            </span>

                                        </div>

                                        <div class="ms-3 flex-grow-1">

                                            <h5 class="mb-1">

                                                {{ $name }}

                                            </h5>

                                            <small class="text-muted">

                                                {{ $subtitle }}

                                            </small>

                                        </div>

                                    </div>

                                </a>

                            @empty

                                <div class="p-5 text-center">

                                    No Contacts Found

                                </div>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>
                        <!-- Chat Window -->

            <div class="col-lg-8">

                <div class="card">

                    @if($conversation)

                        <div class="card-header">

                            <div class="d-flex align-items-center">

                                <div class="avatar-sm">

                                    <span class="avatar-title rounded-circle bg-primary">

                                        @if($role == 'school')

                                            {{ strtoupper(substr($conversation->student->student->name,0,1)) }}

                                        @else

                                            {{ strtoupper(substr($conversation->school->school->school_name,0,1)) }}

                                        @endif

                                    </span>

                                </div>

                                <div class="ms-3">

                                    <h5 class="mb-0">

                                        @if($role == 'school')

                                            {{ $conversation->student->student->name }}

                                        @else

                                            {{ $conversation->school->school->school_name }}

                                        @endif

                                    </h5>

                                </div>

                            </div>

                        </div>

                        <div class="card-body"
                             style="height:520px;overflow-y:auto;background:#f8f9fa;">

                            @forelse($messages as $message)

                                @if($message->sender_id == auth()->id())

                                    <div class="d-flex justify-content-end mb-3">

                                        <div
                                            class="bg-primary text-white rounded px-3 py-2"
                                            style="max-width:70%;">

                                            {{ $message->message }}

                                            <div class="text-end">

                                                <small>

                                                    {{ $message->created_at->format('h:i A') }}

                                                </small>

                                            </div>

                                        </div>

                                    </div>

                                @else

                                    <div class="d-flex justify-content-start mb-3">

                                        <div
                                            class="bg-white border rounded px-3 py-2"
                                            style="max-width:70%;">

                                            {{ $message->message }}

                                            <div class="text-end">

                                                <small class="text-muted">

                                                    {{ $message->created_at->format('h:i A') }}

                                                </small>

                                            </div>

                                        </div>

                                    </div>

                                @endif

                            @empty

                                <div class="text-center mt-5">

                                    <h5>

                                        No messages yet.

                                    </h5>

                                    <p class="text-muted">

                                        Start the conversation.

                                    </p>

                                </div>

                            @endforelse

                        </div>

                        <div class="card-footer">

                            @if($role == 'school')

                                <form
                                    action="{{ route('school.chat.send',$conversation->id) }}"
                                    method="POST">

                            @else

                                <form
                                    action="{{ route('student.chat.send',$conversation->id) }}"
                                    method="POST">

                            @endif

                                @csrf

                                <div class="input-group">

                                    <input
                                        type="text"
                                        name="message"
                                        class="form-control"
                                        placeholder="Type your message..."
                                        required>

                                    <button
                                        class="btn btn-primary"
                                        type="submit">

                                        <i class="bx bx-send"></i>

                                        Send

                                    </button>

                                </div>

                            </form>

                        </div>

                    @else

                        <div
                            class="card-body d-flex align-items-center justify-content-center"
                            style="height:650px;">

                            <div class="text-center">

                                <i class="bx bx-message-square-dots display-3 text-muted"></i>

                                <h4 class="mt-3">

                                    Select a contact

                                </h4>

                                <p class="text-muted">

                                    Choose a contact from the left to start chatting.

                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection