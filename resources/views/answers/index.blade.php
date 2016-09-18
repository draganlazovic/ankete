@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="jumbotron">
            <h3>{{ $survey->title }}</h3>
            <p>{{ $survey->text }}</p>
        </div>

        <form action="{{ url('answers') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @foreach($survey->questions as $question)

                <div class="form-group">
                    <label for="{{ $question->id }}" class="col-sm-3 control-label">{{ $question->text }}</label>

                    <div class="col-sm-6">
                        @if($question->questionType->id == 1)
                            <input type="text" name="{{ $question->id }}"
                                   {{ $question->is_required == 1 ? 'required' : '' }}
                                   class="form-control">
                        @elseif($question->questionType->id == 2)
                            <textarea name="{{ $question->id }}" cols="30" rows="10"
                                      {{ $question->is_required == 1 ? 'required' : '' }}
                                      class="form-control"></textarea>
                        @elseif($question->questionType->id == 3)
                            <input type="radio" name="{{ $question->id }}"
                                   {{ $question->is_required ? 'checked' : '' }} value="da">
                            Da
                            <input type="radio" name="{{ $question->id }}" value="ne">
                            Ne
                        @elseif($question->questionType->id == 4)
                            <input type="radio" name="{{ $question->id }}"
                                   {{ $question->is_required ? 'checked' : '' }} value="Potpuno se slažem">
                            Potpuno se slažem
                            <input type="radio" name="{{ $question->id }}" value="Delimično se slažem">
                            Delimično se slažem
                            <input type="radio" name="{{ $question->id }}" value="Nisam siguran">
                            Nisam siguran
                            <input type="radio" name="{{ $question->id }}" value="Delimično se ne slažem">
                            Delimično se ne slažem
                            <input type="radio" name="{{ $question->id }}" value="Potpuno se ne slažem">
                            Potpuno se ne slažem
                        @elseif($question->questionType->id == 5)
                            <select name="{{ $question->id }}" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        @elseif($question->questionType->id == 6)
                            <select name="{{ $question->id }}" class="form-control">
                                @foreach(json_decode(json_decode($question->arguments)) as $argument)
                                    <option value="{{ $argument }}">{{ $argument }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-rocket fa-lg"></i> Pošalji odgovore
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection