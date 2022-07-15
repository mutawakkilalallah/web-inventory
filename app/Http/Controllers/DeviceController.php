<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];

        return view('home', $data);
    }

    public function createDevice()
    {
        $data = [
            'title' => 'Tambah Perangkat',
            'types' => DB::table('types')->get()
        ];

        return view('device.create', $data);
    }

    public function saveDevice(Request $request)
    {

        $validated = $request->validate([
            'picture' => 'image|file',
            'mandatory' => 'image|file'
        ]);

        $picture = $request->file('picture')->store('upload');
        $mandatory = $request->file('mandatory')->store('upload');

        DB::table('devices')->insert([
            'number' => $request->input('number'),
            'picture' => $picture,
            'mandatory' => $mandatory,
            'status' => 'in',
            'type_id' => $request->input('type_id'),
            'created_by' => 1,
            'created_at' => new DateTime(),
            'updated_by' => 1,
            'updated_at' => new DateTime(),
        ]);

        DB::table('customers')->insert([
            'registration' => $request->input('registration'),
            'name' => $request->input('name'),
            'status' => 'old',
            'address' => $request->input('address'),
            'created_by' => 1,
            'created_at' => new DateTime(),
            'updated_by' => 1,
            'updated_at' => new DateTime(),
        ]);

        return redirect('/device/in');
    }

    public function listInDevice()
    {
        $devices = DB::table('devices')
            ->where('status', "=", 'in')
            ->join('types', 'devices.type_id', '=', 'types.id')
            ->select('devices.*', 'types.*', 'devices.id as device_id', 'types.id as type_id')
            ->get();

        $data = [
            'title' => 'Perangkat Lama',
            'devices' => $devices
        ];

        return view('device.view.in', $data);
    }

    public function onHandGood()
    {
        $devices = DB::table('devices')
            ->where('status', "=", 'onHand')
            ->where('condition', "=", 'good')
            ->join('types', 'devices.type_id', '=', 'types.id')
            ->select('devices.*', 'types.*', 'devices.id as device_id', 'types.id as type_id')
            ->get();

        $data = [
            'title' => 'Perangkat On Stock (Bagus)',
            'devices' => $devices
        ];

        return view('device.view.onHandGood', $data);
    }

    public function onHandBad()
    {
        $devices = DB::table('devices')
            ->where('status', "=", 'onHand')
            ->where('condition', "=", 'bad')
            ->join('types', 'devices.type_id', '=', 'types.id')
            ->select('devices.*', 'types.*', 'devices.id as device_id', 'types.id as type_id')
            ->get();

        $data = [
            'title' => 'Perangkat On Stock (Rusak)',
            'devices' => $devices
        ];

        return view('device.view.onHandBad', $data);
    }

    public function listOutDevice()
    {
        $devices = DB::table('devices')
            ->where('devices.status', "=", 'out')
            ->join('types', 'devices.type_id', '=', 'types.id')
            ->join('customers', 'devices.customer_id', '=', 'customers.id')
            ->select('devices.*', 'types.*', 'customers.*', 'devices.id as device_id', 'customers.id as customer_id', 'types.id as type_id')
            ->get();

        $data = [
            'title' => 'Perangkat Baru',
            'devices' => $devices
        ];

        return view('device.view.out', $data);
    }

    public function verifyDevice($id)
    {
        $data = [
            'title' => 'Verifikasi Perangkat',
            'id' => $id
        ];

        return view('device.verify', $data);
    }

    public function verifyConditionDevice($id, Request $request)
    {
        DB::table('devices')
            ->where('id', $id)
            ->update([
                'status' => 'onHand',
                'condition' => $request->input('condition')
            ]);

        return redirect('/device/in');
    }

    public function sellDevice($id)
    {
        $device = DB::table('devices')
            ->where('devices.id', "=", $id)
            ->join('types', 'devices.type_id', '=', 'types.id')
            ->select('devices.*', 'types.*', 'devices.id as device_id', 'types.id as type_id')
            ->first();

        $data = [
            'title' => 'Jual Perangkat',
            'device' => $device
        ];

        return view('device.sell', $data);
    }

    public function sellDeviceToCustomer($id, Request $request)
    {
        $customer_id = DB::table('customers')->insertGetId([
            'registration' => $request->input('registration'),
            'name' => $request->input('name'),
            'status' => 'new',
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'device_id' => $id,
            'created_by' => 1,
            'created_at' => new DateTime(),
            'updated_by' => 1,
            'updated_at' => new DateTime(),
        ]);

        DB::table('devices')
            ->where('id', $id)
            ->update([
                'status' => 'out',
                'customer_id' => $customer_id
            ]);

        return redirect('/device/out');
    }
}
