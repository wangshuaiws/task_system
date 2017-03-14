@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
    <div class="container col-md-4">
    <canvas id="pieChart" width="300" height="300"></canvas>
        <div id="pie-data" data-todo="{{ $toDoCount }}" data-done="{{ $DoneCount }}" data-total="{{ $total }}"></div>
    </div>


    <div class="container col-md-4">
        <canvas id="BarChart" width="300" height="300"></canvas>
        <div id="bar-data"
             data-names={!!  json_encode($names,JSON_UNESCAPED_UNICODE) !!}
             data-count={!!  json_encode(TaskCountArray($projects)) !!}>
        </div>
    </div>

    <div class="container col-md-4">
        <canvas id="RadarChart" width="300" height="300"></canvas>
    </div>
        </div>
@endsection







@section('customJS')
            <script src="{{ asset('js/charts.js') }}" ></script>
            <script>
            var Radarctx = $('#RadarChart');
            var data = {
                labels: ["总的任务", "未完成的任务", "已完成的任务"],
                datasets: [
                        <?php
                            $i = 0;
                            foreach($projects as $project) :
                                $name = $project->name;
                                $totalPP = $project->tasks()->count();
                                $toDoPP = $project->tasks()->where('completed',0)->count();
                                $DonePP = $project->tasks()->where('completed',1)->count();
                                echo '{';
                        ?>

                        label: "<?php echo $name ?>",
                        backgroundColor: "{{ rand_color() }}",
                        borderColor: "{{ rand_color() }}",
                        pointBackgroundColor: "{{ rand_color() }}",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        data: [<?php echo $totalPP.','.$toDoPP.','.$DonePP ?>]

            <?php
                    ($i+1) == $projects->count() ? print '}' : print '},';
                    $i++;
                    endforeach;
                    ?>
                ]
            };
            var myRadarChart = new Chart(Radarctx, {
            type: 'radar',
            data: data,
            options: {
               responsive: true,
                title: {
                    display: true,
                    text: '项目之间的任务完成情况'
                    },
                legend: {
                    display: true,
                    position: "bottom"
                    }
                }
            });
    </script>
@endsection