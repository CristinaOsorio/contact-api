<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactService
{

    public function getAllContacts($perPage = 10)
    {
        return Contact::with(['phoneNumbers', 'emails', 'addresses'])->paginate($perPage);
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
            throw new ValidationException($e->getMessage());
        }
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
