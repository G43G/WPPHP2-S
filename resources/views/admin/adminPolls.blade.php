@extends('pages.admin')

@section('admin')

<div class="column admin">
    <h2>MANAGE POLLS</h2>
    <div class="table-wrapper">
        @isset($polls)
            @if(count($polls) > 5)
                <div class="wrapper-paging">
                    <ul>
                        <li><a class="paging-back"><i class="fa fa-arrow-left"></i></a></li>
                        <li><a class="paging-this"><strong>0</strong> of <span>x</span></a></li>
                        <li><a class="paging-next"><i class="fa fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            @endif
        @endisset
        <table class="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Question</td>
                    <td>Created</td>
                    <td>Updated</td>
                    <td>Active</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
            @isset($polls)
                @foreach($polls as $poll)
                    <tr>
                        <td>{{ $poll->poll_id }}</td>
                        <td>{{ $poll->poll_question }}</td>
                        <td>{{ date('d.m.Y', strtotime($poll->created_at)) }}</td>
                        <td>{{ (isset($poll->updated_at)) ? date('d.m.Y', strtotime($poll->updated_at)) : 'NEVER' }}</td>
                        <td>@if($poll->poll_active == 1)<p class="activation">ACTIVE</p> @else <a href="{{ asset('/admin-panel/polls/activate/'.$poll->poll_id) }}">ACTIVATE</a>@endif</td>
                        <td><a href="{{ asset('/admin-panel/polls'.'/'.$poll->poll_id) }}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{ asset('/admin-panel/polls/delete/'.$poll->poll_id) }}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
</div>
<div class="social column">
    <h2>{{ (isset($selectedPoll))? 'EDIT POLL' : 'ADD POLL' }}</h2>
    <form action="{{(isset($selectedPoll)) ? asset('/admin-panel/polls/update/'.$selectedPoll[0]->poll_id) : route('insertPoll')}}" method="POST">
        {{csrf_field()}}
        <div class="question">
            <label for="pollQuestionAdmin">Question</label>
            <input type="text" name='pollQuestionAdmin' value='{{(isset($selectedPoll)) ? $selectedPoll[0]->poll_question : old('pollQuestionAdmin')}}'>
        </div>
        <div class="field half first">
            <label for="pollFirstAnswer">Answer 1</label>
            <input type="text" name='pollFirstAnswer' value='{{(isset($selectedPoll)) ? $selectedPoll[0]->answer : old('pollFirstAnswer')}}'>
            <input type="text" value="Number of votes: {{(isset($selectedPoll)) ? $selectedPoll[0]->answer_votes : 'NO VOTES'}}" disabled=""/>
            <input type="hidden" name="answer" value="{{(isset($selectedPoll)) ? $selectedPoll[0]->answer_id : old('answer')}}"/>
        </div>
        <div class="field half">
            <label for="pollSecondAnswer">Answer 2</label>
            <input type="text" name='pollSecondAnswer' value='{{(isset($selectedPoll)) ? $selectedPoll[1]->answer : old('pollSecondAnswer')}}'>
            <input type="text" value="Number of votes: {{(isset($selectedPoll)) ? $selectedPoll[1]->answer_votes : 'NO VOTES'}}" disabled=""/>
            <input type="hidden" name="answer_alt" value="{{(isset($selectedPoll)) ? $selectedPoll[1]->answer_id : old('answer_alt')}}"/>
        </div>
        <input type="submit" class="btn btn-default" value="{{(isset($selectedPoll)) ? 'UPDATE' : 'ADD'}}">
        @isset($selectedPoll)
            <a href="{{ asset('admin-panel/polls/') }}" class="button cancel">CANCEL</a>
        @endisset
    </form>
</div>

@endsection
