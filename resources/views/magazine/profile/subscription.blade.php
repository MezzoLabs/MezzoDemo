@extends('magazine.layout')

@section('content')
    <h3>Subscriptions</h3>
    <table class="table">
        <tr>
            <th>Created at</th>
            <th>Days</th>
            <th>Valid until</th>
        </tr>
        @foreach($user->subscriptions->sortByDesc('subscribed_until') as $subscription)
            <tr>
                <td>
                    {{ Html::time($subscription->created_at) }}
                </td>
                <td>
                    {{ $subscription->duration()->days }} days
                </td>
                <td>
                    {{ Html::time($subscription->subscribed_until) }}
                    @if($subscription->isActive())
                        ( {{ $subscription->subscribed_until->diffForHumans() }} )
                    @endif
                </td>
            </tr>
        @endforeach
    </table>


    <h3>Redeem voucher</h3>
    <form method="POST" action="{{ route('profile.subscription.add_voucher') }}">
        {!! csrf_field() !!}
        <div class="form-group">
            <input type="text" name="code" value="{{ old('code') }}" class="form-control">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit">
        </div>
    </form>
@endsection