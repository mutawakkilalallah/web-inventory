<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function createDevice()
    {
        $data = [
            'title' => 'Tambah Perangkat',
            'types' => DB::table('types')->get()
        ];
        
        return view('device.create', $data);
    }

    public function listInDevice()
    {
        $devices = DB::table('devices')->where('status', "=", 'in')->join('types', 'devices.type_id', '=', 'types.id')->get();
       
        $data = [
            'title' => 'Perangkat Lama',
            'devices' => $devices
        ];

        return view('device.view.in', $data);
    }

    public function onHandGood()
    {
        $devices = DB::table('devices')->where('status', "=", 'onHand')->where('condition', "=", 'good')->join('types', 'devices.type_id', '=', 'types.id')->get();

        $data = [
            'title' => 'Perangkat On Stock (Bagus)',
            'devices' => $devices
        ];

        return view('device.view.onHandGood', $data);
    }

    public function onHandBad()
    {
        $devices = DB::table('devices')->where('status', "=", 'onHand')->where('condition', "=", 'bad')->join('types', 'devices.type_id', '=', 'types.id')->get();

        $data = [
            'title' => 'Perangkat On Stock (Rusak)',
            'devices' => $devices
        ];

        return view('device.view.onHandBad', $data);
    }

    public function listOutDevice()
    {
        $devices = DB::table('devices')->where('devices.status', "=", 'out')->join('types', 'devices.type_id', '=', 'types.id')->join('customers', 'devices.customer_id', '=', 'customers.id')->select('devices.*', 'types.*', 'customers.*', 'devices.number as serial_number')->get();
        
        $data = [
            'title' => 'Perangkat Baru',
            'devices' => $devices
        ];

        return view('device.view.out', $data);
    }
}
