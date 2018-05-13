<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Address;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserAddress as AddressResource;
use App\Http\Requests\Admin\StoreAddressesRequest;
use App\Http\Requests\Admin\UpdateAddressesRequest;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    public function index()
    {
        return new AddressResource(Address::with([])->get());
    }

    public function show($id)
    {
        $address = Address::with([])->findOrFail($id);

        return new AddressResource($address);
    }

    public function store(StoreAddressesRequest $request)
    {
        $address = Address::create($request->all());

        return (new AddressResource($address))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateAddressesRequest $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->update($request->all());

        return (new AddressResource($address))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return response(null, 204);
    }
}
