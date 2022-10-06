@extends('layouts.app')

@section('content')
<div id="course">
    <div class="image-box">
        @if ($course->cover_image)
            <img class="course-cover" src="/images/course_covers/{{ $course->cover_image }}">
        @endif
    </div>
    @php
        $wordCounts = $course->getWordCounts($words);
    @endphp
    <div class="information-box">
        <div class="name">{{ $course->name }}</div>
        <div class="information">Words: <span>{{ $wordCounts->total }}</span></div>
        <div class="information">Unique words: <span>{{ $wordCounts->unique }}</span></div>
        <div class="information">Known words: <span>{{ $wordCounts->known }}</span></div>
        <div class="information">Highlighted words: <span class="highlighted"><i class="fa fa-book-open"></i> {{ $wordCounts->highlighted }}</span></div>
        <div class="information">New words: <span class="new"><i class="fa fa-eye-slash"></i> {{ $wordCounts->new }}</span></div>
    </div>
    <div class="buttons">
        <a href="/courses">
            <button class="btn btn-primary texts-button"><i class="fa fa-book-open"></i> Library</button>
        </a>
        <a href="/create-lesson/{{ $course->id }}">
            <button class="btn btn-primary texts-button"><i class="fa fa-folder-plus"></i> Create chapter</button>
        </a>
        @if (count($lessons))
            <a href="{{ url('/vocabulary-practice/random/-1/' . $course->id) }}">
                <button class="btn btn-primary texts-button"><i class="fa fa-keyboard"></i>  Practice</button>
            </a>
            <a href="/lesson/{{ $lessons[rand(0, count($lessons) - 1)]->id }}">
                <button class="btn btn-primary texts-button"><i class="fa fa-random"></i>  Random chapter</button>
            </a>
        @endif            
    </div>
</div>


<div id="lessons">

    @foreach ($lessons as $lesson)
        @php
            $wordCounts = $lesson->getWordCounts($words);
        @endphp
            <div class="lesson">
                <div class="name">{{ $lesson->name }}</div>
                <div class="information">Read: <span>{{ $lesson->read_count }}</span></div>
                <div class="information">Words: <span>{{ $wordCounts->total }}</span></div>
                <div class="information">Unique words: <span>{{ $wordCounts->unique }}</span></div>
                <div class="information">Known words: <span>{{ $wordCounts->known }}</span></div>
                <div class="information">Highlighted words: <span class="highlighted"><i class="fa fa-book-open"></i> {{ $wordCounts->highlighted }}</span></div>
                <div class="information">New words: <span class="new"><i class="fa fa-eye-slash"></i> {{ $wordCounts->new }}</span></div>
                <div class="buttons">
                    <a href="/lesson/{{ $lesson->id }}">
                        <button class="btn btn-secondary texts-button"><i class="fa fa-book-open"></i> Read</button>
                    </a>
                    <a href="{{ url('/vocabulary-practice/random/' . $lesson->id) }}">
                        <button class="btn btn-primary texts-button"><i class="fa fa-keyboard"></i>  Vocabulary</button>
                    </a>
                    <a href="/edit-lesson/{{ $lesson->id }}">
                        <button class="btn btn-primary texts-button"><i class="fa fa-pen"></i> Edit</button>
                    </a>
                </div>
            </div>
    @endforeach
</div>
@endsection
