<div class="chart-graphic">
    @foreach ($hadir as $day)
        <p class="chart-data-holder attend-chart-data-day-name">{{ \Carbon\Carbon::parse($day['day'])->isoFormat('dddd') }}</p>
        <p class="chart-data-holder attend-chart-data-day-count">{{ $day['total'] }}</p>
    @endforeach

    @foreach ($alpha as $day)
        <p class="chart-data-holder alpha-chart-data-day-name">{{ \Carbon\Carbon::parse($day['day'])->isoFormat('dddd') }}</p>
        <p class="chart-data-holder alpha-chart-data-day-count">{{ $day['total'] }}</p>
    @endforeach
    <canvas id="weekly-chart"></canvas>
    <canvas id="alpha-chart"></canvas>
</div>