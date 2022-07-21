<?php


namespace App\Repositories\Classes;

use App\Enums\OrderEnum;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @return mixed
     */
    public static function getNew()
    {
        // TODO: Implement getNew() method.
    }

    public function getAllAdmin($search, $status, $per_page)
    {
        return Order::with(['details'])->latest('id')->when($status,function ($query) use ($status){
            $query->whereHas('details',function ($query) use ($status){
                return $query->where('status',$status);
            });
        })->when($search,function ($query) use ($search){
            $query->whereHas('user',function ($query) use ($search){
                return $query->where('phone',$search);
            })->orWhereHas('details',function ($query) use ($search){
                return $query->where('id',(int)$search - Order::CHANGE_ID);
            })->orWhere('id',(int)$search-Order::CHANGE_ID);
        })->paginate($per_page);
    }

    public function find($id)
    {
        return Order::findOrFail($id);
    }

    public function count(array $where = [])
    {
        return Order::where($where)->count();
    }

    public static function CHANGE_ID(): int
    {
        return Order::CHANGE_ID;
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function get(array $where)
    {
        return Order::with('details.course')->where($where)->firstOrFail();
    }

    public function destroy($id)
    {
        Order::destroy($id);
    }

    public function getNameSpace(): string
    {
        return Order::class;
    }
}
