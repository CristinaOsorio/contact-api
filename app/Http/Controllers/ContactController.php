<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index(Request $request)
    {
        
        $perPage = $request->query('per_page', 10);
        $contacts = $this->contactService->getAllContacts($perPage);
        return response()->json([
                'data' => $contacts->items(),
                'current_page' => $contacts->currentPage(),
                'from' => $contacts->firstItem(),
                'last_page' => $contacts->lastPage(),
                'per_page' => $contacts->perPage(),
                'to' => $contacts->lastItem(),
                'total' => $contacts->total(),
            ]);
    }

    public function store(ContactRequest $request)
    {
        $contact = $this->contactService->storeContactWithDetails($request);

        return response()->json(['data' => $contact], 201);
    }

    public function update($id, ContactRequest $request)
    {
            $contact = $this->contactService->updateContactWithDetails($id, $request);
            return response()->json([
                'data' => $contact,
            ], 200);
    }

    public function destroy($id)
    {
        try {
            $this->contactService->deleteContact($id);

            return response()->json([
                'message' => 'Contacto eliminado con éxito'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudo eliminar el contacto: ' . $e->getMessage()
            ], 500);
        }
    }
}
