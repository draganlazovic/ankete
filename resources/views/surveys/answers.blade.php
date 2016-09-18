@extends('layouts.app')

@section('content')

    @if (count($questions) > 0)

        <div class="panel panel-default">
            <div class="panel-heading">
                Odgovori na anketu
            </div>

            <div class="panel-body">
                <a class="btn btn-danger" href="{{ url('/surveys/' . $surveyId . '/csv') }}"><i class="fa fa-flask fa-lg"></i>  CSV format</a>

                <table class="table table-striped survey-table">

                    <!-- Table Headings -->
                    <thead>
                    @foreach ($questions as $question)
                        <th class="table-text">
                            <div>{{ $question->text }}</div>
                        </th>
                    @endforeach
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @for ($i = 0; $i < $answerCount; $i++)
                        @if ($i % count($questions) == 0)
                            <tr>
                                @endif
                                <td>
                                    {{ $questions[$i % count($questions)]->answers[$i / count($questions)]->text }}
                                </td>
                                @if (($i + 1) % count($questions) == 0)
                            </tr>
                        @endif
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection