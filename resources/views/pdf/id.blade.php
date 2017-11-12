<style>
    .center-all {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        text-align: center;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .nickname {
        font-size: 3.5em;
    }

    .details {
        font-size: 0.8em;
    }

    .details div {
        white-space: nowrap;
        display: block;
    }

</style>
<div class="center-all">
    <p><strong class="nickname">{{ strtoupper($alumni->nickname) }}</strong
    <div class="details">
        <div>#{{ $alumni->id }} {{ $alumni->last_name }}, {{ $alumni->first_name }} </div>
        <div>{{ $alumni->diocese }} </div>
        <div>{{ $alumni->years_in_sj  }} </div>
        <div>{{ $alumni->ordination }}</div>
    </div>

    </p>

</div>