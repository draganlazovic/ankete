@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Question Form -->
        <form action="{{ url('questions') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <input type="hidden" name="survey_id" id="survey-id" value="{{ $survey->id }}">

            <!-- Question -->
            <div class="form-group">
                <label for="question" class="col-sm-3 control-label">Pitanje</label>

                <div class="col-sm-6">
                    <input type="text" name="text" id="question" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="is-required" class="col-sm-3 control-label">Ovo pitanje je obavezno</label>

                <div class="col-sm-6">
                    <input type="checkbox" name="is_required" id="is-required" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="question-type" class="col-sm-3 control-label">Tip pitanja</label>

                <div class="col-sm-6">
                    <select name="question_type_id" id="question-type" class="form-control">
                        @foreach ($question_types as $question_type)
                            <option value="{{ $question_type->id }}"
                                    class="arguments-{{ $question_type->takes_arguments }}">{{ $question_type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group arguments">
                <label for="question-arguments" class="col-sm-3 control-label">Argumenti - razdvojiti znakom <strong>;</strong></label>

                <div class="col-sm-6">
                    <textarea name="arguments" id="question-arguments" cols="30" rows="10"
                              class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-puzzle-piece fa-lg"></i> Dodaj pitanje
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Questions -->
    @if (count($survey->questions) > 0)
        <div class="alert alert-warning">
            <h4>Link do ankete</h4>
            <a href="{{ url('answers/' . $survey->slug) }}" target="_blank">{{ url('answers/' . $survey->slug) }}</a>
        </div>

        <div class="alert alert-info">
            <h4>Odgovori na anketu</h4>
            <a href="{{ url('surveys/' . $survey->id . '/answers') }}" target="_blank">{{ url('surveys/' . $survey->id . '/answers') }}</a>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Pitanja u ovoj anketi
            </div>

            <div class="panel-body">
                <table class="table table-striped survey-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Pitanje</th>
                    <th>Obavezno</th>
                    <th>Tip pitanja</th>
                    <th>Argumenti</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($survey->questions as $question)
                        <tr>
                            <td class="table-text">
                                <div>{{ $question->text }}</div>
                            </td>

                            <td>
                                <div>{{ $question->is_required }}</div>
                            </td>

                            <td>
                                <div>{{ $question->questionType->name }}</div>
                            </td>

                            <td>
                                <div>{{ $question->arguments }}</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <script>
        window.onload = function () {
            $('#question-type').on('click', function () {
                var element = $('#question-type').find("option:selected");
                var questionTypeClass = element.attr('class');
                if (questionTypeClass == 'arguments-0') {
                    $('.arguments').hide();
                } else {
                    $('.arguments').show();
                }
            });
        }
    </script>
@endsection