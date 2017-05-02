<?php
namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use JWTAuth;
class ServiceController extends Controller
{
    public function postService(Request $request)
    {
        $user=JWTAuth::parseToken()->toUser();
        $service = new Service();
        $service->content = $request->input('content');
        $service->save();
        return response()->json(['service' => $service, 'user'=> $user], 201);
    }

    public function getServices()
    {
        $services = Service::all();
        $response = [
          'services' => $services
        ];
        return response()->json($response, 200);
    }

    public function putService(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $service->content = $request->input('content');
        $service->save();
        return response()->json(['service' => $service], 200);
    }

    public function deleteService($id)
    {
        $service = Service::find($id);
        $service->delete();
        return response()->json(['message' => 'Service deleted'], 200);
    }
}