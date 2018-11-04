<style>
    .center-all {
        position: absolute;
        top: 35%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        text-align: center;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .nickname {
        font-size: 4.5em;
        white-space: nowrap;
    }

    .details {
        font-size: 0.8em;
    }

    .details div {
        white-space: nowrap;
        display: block;
        font-size: 1.2em;
    }

</style>
<div class="center-all">

    <?php $nicknameCount = strlen($alumni->nickname) ? strlen($alumni->nickname) : 1 ?>
    <?php $ems = 30 / $nicknameCount  ?>
    <?php $ems = $ems > 3 ? 3 : $ems ?>
    <p>
        <strong class="nickname"
                style="font-size: {{ $ems }}em">
            {{ strtoupper($alumni->nickname) }}
        </strong>

    <div class="details">
        <div>{{ $alumni->first_name }} {{$alumni->middle_initial}} {{ $alumni->last_name }} </div>
        <div>{{ $alumni->diocese }} </div>
        @if($alumni->alumni_type !== 'current')

            <div>{{ $alumni->batch_year }}</div>
        @endif
    </div>

    </p>

</div>