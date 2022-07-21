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
            'deviceIn' => DB::table('devices')->where('status', "=", "in")->count(),
            'deviceOnHandGood' => DB::table('devices')->where('status', "=", "onHand")->where('condition', "=", "good")->count(),
            'deviceOnHandBad' => DB::table('devices')->where('status', "=", "onHand")->where('condition', "=", "bad")->count(),
            'deviceOut' => DB::table('devices')->where('status', "=", "out")->count(),
            'userTF' => DB::table('users')->where('role', "=", "team-field")->count(),
            'userFM' => DB::table('users')->where('role', "=", "field-manager")->count(),
            'userM' => DB::table('users')->where('role', "=", "manager")->count(),
        ];

        return view('home', $data);
    }

    public function createDevice()
    {
        $data = [
            'title' => 'Tambah Perangkat',
            'types' => DB::table('types')->get(),
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

        $customer_id = DB::table('customers')->insertGetId([
            'registration' => "SO" . $request->input('registration'),
            'name' => $request->input('name'),
            'status' => 'old',
            'address' => $request->input('address'),
            'district' => $request->input('district'),
            'created_by' => auth()->user()->id,
            'created_at' => new DateTime(),
            'updated_by' => auth()->user()->id,
            'updated_at' => new DateTime(),
        ]);

        DB::table('devices')->insert([
            'number' => $request->input('number'),
            'picture' => $picture,
            'mandatory' => $mandatory,
            'customer_id' => $customer_id,
            'status' => 'in',
            'type_id' => $request->input('type_id'),
            'created_by' => auth()->user()->id,
            'created_at' => new DateTime(),
            'updated_by' => auth()->user()->id,
            'updated_at' => new DateTime(),
        ]);

        return redirect('/device/in');
    }

    public function editDevice($id)
    {
        $device = DB::table('devices')->where('devices.id', $id)
            ->join('types', 'devices.type_id', '=', 'types.id')
            ->join('customers', 'devices.customer_id', '=', 'customers.id')
            ->select('devices.*', 'types.*', 'customers.*', 'devices.id as device_id', 'devices.status as device_status', 'customers.id as customer_id', 'types.id as type_id')
            ->first();

        if ($device->status == "out") {
            $device = DB::table('devices')->where('devices.id', $id)
                ->join('types', 'devices.type_id', '=', 'types.id')
                ->join('customers', 'devices.customer_id', '=', 'customers.id')
                ->select('devices.*', 'types.*', 'customers.*', 'devices.id as device_id', 'devices.status as device_status', 'customers.id as customer_id', 'types.id as type_id')
                ->first();

            $device->registration = substr($device->registration, 2);
        }

        $data = [
            'title' => 'Edit Perangkat',
            'device' => $device,
            'types' => DB::table('types')->get(),
        ];

        return view('device.edit', $data);
    }

    public function updateDevice($id, Request $request)
    {
        DB::table('devices')->where('id', $id)
            ->update([
                'number' => $request->input('number'),
                'type_id' => $request->input('type_id'),
                'condition' => $request->input('condition'),
                'updated_by' => auth()->user()->id,
                'updated_at' => new DateTime(),
            ]);

        DB::table('customers')->where('id', $request->input('customer_id'))
            ->update([
                'registration' => "SO" . $request->input('registration'),
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'district' => $request->input('district'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'updated_by' => auth()->user()->id,
                'updated_at' => new DateTime(),
            ]);

        $status = $request->input('device_status');

        if ($status == "onHand") {
            $status = "on-hand-" . $request->input('condition');
        }

        return redirect('/device' . "/" . $status);
    }

    public function listInDevice()
    {
        if (auth()->user()->role == "team-field") {
            $devices = DB::table('devices')
                ->where('status', "=", 'in')
                ->where('created_by', auth()->user()->id)
                ->join('types', 'devices.type_id', '=', 'types.id')
                ->select('devices.*', 'types.*', 'devices.id as device_id', 'types.id as type_id')
                ->get();
        } else {
            $devices = DB::table('devices')
                ->where('status', "=", 'in')
                ->join('types', 'devices.type_id', '=', 'types.id')
                ->select('devices.*', 'types.*', 'devices.id as device_id', 'types.id as type_id')
                ->get();
        }

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
        if (request('district')) {
            $devices = DB::table('devices')
                ->where('devices.status', "=", 'out')
                ->join('types', 'devices.type_id', '=', 'types.id')
                ->join('customers', function ($join) {
                    $join->on('devices.customer_id', '=', 'customers.id')
                        ->where('district', request('district'));
                })
                ->select('devices.*', 'types.*', 'customers.*', 'devices.id as device_id', 'customers.id as customer_id', 'types.id as type_id')
                ->get();
        } else {
            $devices = DB::table('devices')
                ->where('devices.status', "=", 'out')
                ->join('types', 'devices.type_id', '=', 'types.id')
                ->join('customers', 'devices.customer_id', '=', 'customers.id')
                ->select('devices.*', 'types.*', 'customers.*', 'devices.id as device_id', 'customers.id as customer_id', 'types.id as type_id')
                ->get();
        }

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
            'registration' => "SO" . $request->input('registration'),
            'name' => $request->input('name'),
            'status' => 'new',
            'address' => $request->input('address'),
            'district' => $request->input('district'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'device_id' => $id,
            'created_by' => auth()->user()->id,
            'created_at' => new DateTime(),
            'updated_by' => auth()->user()->id,
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

    public function customer()
    {
        if (auth()->user()->role == "team-field") {
            $customers = DB::table('customers')
                ->where('created_by', auth()->user()->id)
                ->get();
        } else {
            $customers = DB::table('customers')->get();
        }

        $data = [
            'title' => 'Data Customer',
            'customers' => $customers
        ];

        return view('device.customer', $data);
    }

    public function deleteDevice($id)
    {
        DB::table('devices')
            ->where('id', $id)
            ->delete();

        return redirect()->back();
    }
}
