<style>
    .center-all {
        position: absolute;
        top: {{ $settings->position->from_top }};
        left: {{ $settings->position->from_left }};;
        transform: translateX(-50%) translateY(-50%);
        text-align: center;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .nickname {
        font-size: 4.5em;
        white-space: nowrap;
        text-align: center;
    }

    .details {
        font-size: {{ $settings->details_font_size }};
    }

    .details div {
        white-space: nowrap;
        display: block;
        font-size: 1.2em;
    }

</style>
<div class="center-all">

    <?php $nicknameCount = strlen($alumni->nickname) ? strlen($alumni->nickname) : 1 ?>
    <?php $ems = $settings->nickname_proportion / $nicknameCount  ?>
    <?php $ems = $ems > 3 ? 3 : $ems ?>
    <h2 style="font-size: {{$settings->title_font_size}}">{{ $alumni->title }}</h2>
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