<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    // controller untuk halaman dashboard
    public function index()
    {
        // mengambil jumlah dari masing-masing data untuk halaman dashboard
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

    // controller untuk halaman tambah perangkat
    public function createDevice()
    {
        $data = [
            'title' => 'Tambah Perangkat',
            'types' => DB::table('types')->get(),
        ];

        return view('device.create', $data);
    }

    // controller untuk halaman simpan perangkat
    public function saveDevice(Request $request)
    {

        // validasi gambar harus berbentuk gambar
        $validated = $request->validate([
            'picture' => 'image|file',
            'mandatory' => 'image|file'
        ]);

        // jika gambar valid di simpan ke storage
        $picture = $request->file('picture')->store('upload');
        $mandatory = $request->file('mandatory')->store('upload');

        // menyimpan data customer
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

        // menyimpan data perangkat
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

    // controller untuk halaman edit perangkat
    public function editDevice($id)
    {

        // mengambil data perangkat
        $device = DB::table('devices')->where('devices.id', $id)
            ->join('types', 'devices.type_id', '=', 'types.id')
            ->join('customers', 'devices.customer_id', '=', 'customers.id')
            ->select('devices.*', 'types.*', 'customers.*', 'devices.id as device_id', 'devices.status as device_status', 'customers.id as customer_id', 'types.id as type_id')
            ->first();

        // mengambil data perangkat jika status sudah out/terjual
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

    // controller untuk update perangkat
    public function updateDevice($id, Request $request)
    {
        // update device
        DB::table('devices')->where('id', $id)
            ->update([
                'number' => $request->input('number'),
                'type_id' => $request->input('type_id'),
                'condition' => $request->input('condition'),
                'updated_by' => auth()->user()->id,
                'updated_at' => new DateTime(),
            ]);

        // update customer
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

        // logic return ke halaman sesuai kondisi perangkat
        if ($status == "onHand") {
            $status = "on-hand-" . $request->input('condition');
        }

        return redirect('/device' . "/" . $status);
    }

    // controller halaman perangkat masuk
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
            'title' => 'Perangkat Masuk',
            'devices' => $devices
        ];

        return view('device.view.in', $data);
    }

    // controller halaman perangkat bagus
    public function onHandGood()
    {
        $devices = DB::table('devices')
            ->where('status', "=", 'onHand')
            ->where('condition', "=", 'good')
            ->join('types', 'devices.type_id', '=', 'types.id')
            ->select('devices.*', 'types.*', 'devices.id as device_id', 'types.id as type_id')
            ->get();

        $data = [
            'title' => 'Perangkat Bagus',
            'devices' => $devices
        ];

        return view('device.view.onHandGood', $data);
    }

    // controller halaman perangkat rusak
    public function onHandBad()
    {
        $devices = DB::table('devices')
            ->where('status', "=", 'onHand')
            ->where('condition', "=", 'bad')
            ->join('types', 'devices.type_id', '=', 'types.id')
            ->select('devices.*', 'types.*', 'devices.id as device_id', 'types.id as type_id')
            ->get();

        $data = [
            'title' => 'Perangkat Rusak',
            'devices' => $devices
        ];

        return view('device.view.onHandBad', $data);
    }


    // controller halaman perangkat terjual
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
            'title' => 'Perangkat Terjual',
            'devices' => $devices
        ];

        return view('device.view.out', $data);
    }

    // controller halaman verifikasi perangkat
    public function verifyDevice($id)
    {
        $data = [
            'title' => 'Verifikasi Perangkat',
            'id' => $id
        ];

        return view('device.verify', $data);
    }

    // fungsi verifikasi perangkat
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

    // controller halaman jual perangkat
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

    // fungsi jual perangkat
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

    // controller halaman customer
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
            'title' => 'Customer',
            'customers' => $customers
        ];

        return view('device.customer', $data);
    }

    // fungsi hapus perangkat
    public function deleteDevice($id)
    {
        DB::table('devices')
            ->where('id', $id)
            ->delete();

        return redirect()->back();
    }
}
