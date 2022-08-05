<?php

namespace App\Http\Controllers\Admin\Dashboard;


use App\Http\Controllers\BaseComponent;


class IndexDashboard extends BaseComponent
{


   
    public function mount()
    {
        
    }

    
    
    
    

    public function render()
    {
       

        return view('admin.dashboard.index-dashboard')
            ->extends('admin.layouts.admin');
    }

 
}
