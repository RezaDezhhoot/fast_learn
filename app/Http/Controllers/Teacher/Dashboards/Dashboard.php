<?php

namespace App\Http\Controllers\Teacher\Dashboards;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Dashboard extends BaseComponent
{
    public $box = [] , $from_date , $to_date;

    public $to_date_viwe , $from_date_view;

    protected $queryString = ['from_date','to_date'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->newCoursesRepository = app(NewCourseRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
    }

    public function mount()
    {
        if (
            !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->to_date) ||
            !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->from_date)
        )
        {
            $this->reset(['to_date','from_date']);
        }

        if (!isset($this->to_date)){
            $this->to_date =  Carbon::now()->format('Y-m-d');
        }
        $this->to_date_viwe = $this->dateConverter($this->to_date);

        if (!isset($this->from_date)){
            $this->from_date = Carbon::now()->subDays(5)->format('Y-m-d');
        }
        $this->from_date_view = $this->dateConverter($this->from_date);

        $this->box = [
            'courses' => $this->courseRepository->getTeachersCount($this->from_date,$this->to_date),
            'episodes' => $this->episodeRepository->getTeachersCount($this->from_date,$this->to_date),
            'pending_course' => $this->newCoursesRepository->getTeachersCount(),
            'students' =>  $this->orderDetailRepository->getTeacherStudents($this->from_date,$this->to_date),
        ];
    }

    public function runChart()
    {
        $this->emit('runChart',$this->getChartData());
    }

    public function confirmFilter()
    {
        $from_date = $this->dateConverter($this->from_date_view,'m');
        $to_date = $this->dateConverter($this->to_date_viwe ,'m');
        redirect()->route('teacher.dashboard',
            [
                'from_date'=> $from_date,
                'to_date'=> $to_date,
            ]
        );
    }

    public function getChartData(): bool|string
    {
        $dates = $this->getDates();
        $chart = [];
        $chartModels = ['payments'];
        foreach ($chartModels as $chartModel ) {
            $chart[$chartModel] = [];
            $chart['label'] = [];
            for ($i = 0 ; $i< count($dates); $i++) {
                $chart[$chartModel][] = (float)$this->orderDetailRepository->getDashboardDataPayments(
                    $dates[$i]->format('Y-m-d') . " 00:00:00", $dates[$i]->format('Y-m-d') . " 23:59:59" , 'teacher_amount',
                    teacher: true
                );
                $chart['label'][] = (string)$dates[$i]->format('Y-m-d');

            }
        }
        return json_encode($chart);
    }

    public function getDates()
    {
        $period = CarbonPeriod::create($this->from_date, $this->to_date);
        foreach ($period as $date) {
            $date->format('Y-m-d');
        }
        return $period->toArray();
    }

    public function render()
    {
        return view('teacher.dashboards.dashboard')->extends('teacher.layouts.teacher');
    }
}
