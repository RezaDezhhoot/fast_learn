<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Enums\NotificationEnum;
use App\Enums\PaymentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CertificateRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class IndexDashboard extends BaseComponent
{
    public $from_date , $to_date , $box , $course;

    public $to_date_viwe , $from_date_view;

    protected $queryString = ['to_date','from_date','course'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->articleRepository = app(ArticleRepositoryInterface::class);
        $this->questionRepository = app(QuestionRepositoryInterface::class);
        $this->quizRepository = app(QuizRepositoryInterface::class);
        $this->certificateRepository = app(CertificateRepositoryInterface::class);
        $this->transcriptRepository = app(TranscriptRepositoryInterface::class);
        $this->notificationRepository = app(NotificationRepositoryInterface::class);
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



        $this->getData();
        $this->data['courses'] = $this->courseRepository->getAll()->pluck('title','id');
    }

    public function confirmFilter()
    {
       $from_date = $this->dateConverter($this->from_date_view,'m');
       $to_date = $this->dateConverter($this->to_date_viwe ,'m');
        redirect()->route('admin.dashboard',
            [
                'from_date'=> $from_date,
                'to_date'=> $to_date,
                'course' => $this->course
            ]
        );
    }

    public function runChart()
    {
        $this->emit('runChart',$this->getChartData());
    }

    public function getData()
    {
        $this->box = [
            'orders'=> $this->orderDetailRepository->getDashboardData($this->from_date,$this->to_date,$this->course),
            'users'=> $this->userRepository->getDashboardData($this->from_date,$this->to_date),
            'payments'=> $this->orderDetailRepository->getDashboardDataPayments($this->from_date,$this->to_date,'total_price',$this->course),
            'paymentsReduction'=> $this->orderDetailRepository->getDashboardDataPayments($this->from_date,$this->to_date,'reduction_amount',$this->course),
            'paymentsWallet'=> $this->orderDetailRepository->getDashboardDataPayments($this->from_date,$this->to_date,'wallet_amount',$this->course),
            'paymentsTeacher'=> $this->orderDetailRepository->getDashboardDataPayments($this->from_date,$this->to_date,'teacher_amount',$this->course),
            'categories' => $this->categoryRepository->count(),
            'courses' => $this->courseRepository->count(),
            'articles' => $this->articleRepository->count(),
            'questions' => $this->questionRepository->count(),
            'quizzes' => $this->quizRepository->count(),
            'certificates' => $this->certificateRepository->count(),
            'walletCharge' => $this->paymentReporitory->getDashboardData($this->from_date,$this->to_date),
            'all_users' => $this->userRepository->count(),
            'all_orders' => $this->orderRepository->count(),
            'all_transcripts' => $this->transcriptRepository->count(),
        ];
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
                    $dates[$i]->format('Y-m-d') . " 00:00:00", $dates[$i]->format('Y-m-d') . " 23:59:59" , 'total_price',
                    $this->course
                );
                $chart['label'][] = (string)$dates[$i]->format('Y-m-d');

            }
        }
        return json_encode($chart);
    }

    public function render()
    {
        $most_sold = $this->courseRepository->getMostSoldCourses($this->from_date,$this->to_date);
        $fess = $this->notificationRepository->getByWhere([['subject',NotificationEnum::FEE]],$this->from_date,$this->to_date);

        return view('admin.dashboard.index-dashboard',['most_sold'=>$most_sold,'fees'=>$fess])
            ->extends('admin.layouts.admin');
    }

    public function getDates()
    {
        $period = CarbonPeriod::create($this->from_date, $this->to_date);
        foreach ($period as $date) {
            $date->format('Y-m-d');
        }
        return $period->toArray();
    }
}
