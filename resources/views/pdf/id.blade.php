<style>
    .center-all {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        text-align: center;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;

    }
    .nickname{
        font-size: 3.5em;
    }

</style>
<div class="center-all">
    <p><strong class="nickname">{{ strtoupper($alumni->nickname) }}</strong> <br>
    {{ $alumni->id }} <br>
    {{ $alumni->last_name }}, {{ $alumni->first_name }} <br>
    {{ isset($alumni->diocese) ?  $alumni->diocese . '<br>': ''  }}
    {{ $alumni->years_in_sj  }} {{ $alumni->ordination }}

    </p>

</div>