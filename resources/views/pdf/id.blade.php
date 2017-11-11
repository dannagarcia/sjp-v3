<style>
    .center-all {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        text-align: center;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

</style>
<div class="center-all">
    <h3><strong>{{ $alumni->nickname }}</strong></h3>
    <p>{{ $alumni->id }}</p>
    <p>{{ $alumni->last_name }}, {{ $alumni->first_name }}</p>
    <p>{{ $alumni->diocese }}<p/>
    <p>{{ $alumni->years_in_sj  }} {{ $alumni->ordination }}</p>

</div>