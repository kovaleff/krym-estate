<div wire:poll.1000ms>
    <h1>Current jobs: ({{count($jobs)}})</h1>
    @foreach ($jobs as $job)
        <p>
            <span><b>-- {{$job->id}} -- </b></span>
            <span>{{$job->payload['displayName']}}</span>
        </p>
    @endforeach
</div>
