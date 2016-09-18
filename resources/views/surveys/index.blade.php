@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Survey Form -->
        <form action="{{ url('surveys') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Survey Name -->
            <div class="form-group">
                <label for="survey-name" class="col-sm-3 control-label">Naslov</label>

                <div class="col-sm-6">
                    <input type="text" name="title" id="survey-name" class="form-control" required>
                </div>
            </div>

            <!-- Survey Text -->
            <div class="form-group">
                <label for="survey-text" class="col-sm-3 control-label">Uvodni tekst</label>

                <div class="col-sm-6">
                    <textarea name="text" id="survey-text" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>

            <!-- Add Survey Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-comments-o fa-lg"></i> Dodaj anketu
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Surveys -->
    @if (count($surveys) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Postojeće ankete
            </div>

            <div class="panel-body">
                <table class="table table-striped survey-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Anketa</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($surveys as $survey)
                        <tr>
                            <!-- Survey Name -->
                            <td class="table-text">
                                <div>{{ $survey->title }}</div>
                            </td>

                            <td>
                                <form action="{{ url('surveys/'.$survey->id) }}" method="GET">
                                    {{ csrf_field() }}

                                    <button type="submit" id="show-survey-{{ $survey->id }}" class="btn btn-info">
                                        <i class="fa fa-btn fa-binoculars fa-lg"></i>Prikaži
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection