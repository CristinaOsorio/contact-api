<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ContactService
{

    public function getAllContacts($perPage = 10)
    {
        return Contact::with(['phoneNumbers', 'emails', 'addresses'])->paginate($perPage);
    }

    public function getContactById($id)
    {
        $contact = Contact::with(['phoneNumbers', 'emails', 'addresses'])->find($id);

        if (!$contact) {
            throw new ModelNotFoundException("Contacto no encontrado");
        }

        return $contact;
    }


    public function storeContactWithDetails($requestData)
    {
        DB::beginTransaction();

        try {
            $contact = Contact::create($requestData->only(['name', 'notes', 'birthday', 'company', 'website']));

            $this->savePhoneNumbers($contact, $requestData->phoneNumbers);
            $this->saveEmails($contact, $requestData->emails);
            $this->saveAddresses($contact, $requestData->addresses);

            DB::commit();

            return $contact->load([
                'phoneNumbers:id,contact_id,number',
                'emails:id,contact_id,address',
                'addresses:id,contact_id,location'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ModelNotFoundException($e->getMessage());
        }
    }

    public function updateContactWithDetails($contactId, $requestData)
    {
        DB::beginTransaction();

        try {
            $contact = Contact::findOrFail($contactId);
            
            $contact->update($requestData->only(['name', 'notes', 'birthday', 'company', 'website']));

            $contact->phoneNumbers()->delete();
            $this->savePhoneNumbers($contact, $requestData->phoneNumbers);

            $contact->emails()->delete();
            $this->saveEmails($contact, $requestData->emails);

            $contact->addresses()->delete();
            $this->saveAddresses($contact, $requestData->addresses);

            DB::commit();

            return $contact->load('phoneNumbers', 'emails', 'addresses');
        
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e->getMessage();
            }
            
    }

    public function deleteContact($id)
    {   
        DB::transaction(function () use ($id) {
            $contact = Contact::with(['phoneNumbers', 'emails', 'addresses'])->findOrFail($id);

            $contact->phoneNumbers()->delete();
            $contact->emails()->delete();
            $contact->addresses()->delete();

            $contact->delete();
        });
    }

    private function savePhoneNumbers(Contact $contact, array $phoneNumbers)
    {
        if (!empty($phoneNumbers)) {
            foreach ($phoneNumbers as $phoneNumber) {
                $contact->phoneNumbers()->create($phoneNumber);
            }
        }
    }

    private function saveEmails(Contact $contact, array $emails)
    {
        if (!empty($emails)) {
            foreach ($emails as $email) {
                $contact->emails()->create($email);
            }
        }
    }

    private function saveAddresses(Contact $contact, array $addresses)
    {
        if (!empty($addresses)) {
            foreach ($addresses as $address) {
                $contact->addresses()->create($address);
            }
        }
    }
}
