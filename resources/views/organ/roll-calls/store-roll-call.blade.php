<div>
    @section('title',$header)
    <x-organ.form-control store="{{false}}" mode="{{$mode}}" title="حضور غیاب" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-organ.forms.validation-errors />
        <div class="card-body">
            <x-organ.forms.select2 id="chapter" :data="$data['chapter']" label=" فصل" wire:model="chapter" />
            @include('organ.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table  table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>دانش اموز/عنوان درس</th>
                            @foreach($lists as $list)
                                <th class="text-center" style="min-width: 100px">{{$list->title}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $order)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$order->order->user->name}}</td>
                                @foreach($lists as $list)
                                    <td >
                                        @foreach($data['status'] as $key => $value)
                                            <div  class="form-check text-center">
                                                <input class="form-check-input" type="radio" name="status.{{$order->id}}.{{$list->id}}.{{$order->order->user_id}}" value="{{$order->id}}.{{$list->id}}.{{$order->order->user_id}}.{{$key}}" id="status{{$order->id}}{{$list->id}}{{$order->order->user_id}}{{$key}}"  wire:model="status.{{$order->id}}.{{$list->id}}.{{$order->order->user_id}}.value" >
                                                <label style="cursor: pointer" class="form-check-label mt-1" for="status{{$order->id}}{{$list->id}}{{$order->order->user_id}}{{$key}}">{{$value}}</label>
                                            </div>
                                        @endforeach
                                        <small>{{$status[$order->id][$list->id][$order->order->user_id]['date'] ?? ''}}</small>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{$details->links('organ.layouts.paginate')}}
        </div>
    </div>
</div>
