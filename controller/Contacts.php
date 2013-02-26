<?php

//**********   INCLUDES
include_once(dirname(__FILE__) . '/../assets/utils/init.php');

class Contacts {

    /**
     * Obtains the List of BaseDatatypes
     * @return array Operation status and BaseDatatypes
     */
    function getAll($params) {
        try {
            $contactModel = new Contact();
            $contacts = $contactModel->getAll(null, $params->limit, $params->start);
            $total = $contactModel->count();
            return array('success' => true, 'contacts' => $contacts, 'total' => $total);
        } catch (Exception $e) {
            print_r($e);
            LOG::getInstance()->put(Log::$ERROR, __CLASS__, __METHOD__, $e->getMessage());
            return array('success' => false);
        }
    }

    /**
     *
     * @param type $contactData
     * @return type 
     */
    function save($contactData) {
        try {
            $contact = new Contact();
            $contact->setId($contactData->id);
            $contact->setName($contactData->name);
            $contact->setLastname($contactData->lastname);
            $contact->setPhone($contactData->phone);
            $contact->setEmail($contactData->email);

            if ($contact->id)
                $contact->update();
            else
                $contact->create($contact->toArray());

            return array('success' => true);
        } catch (Exception $e) {
            LOG::getInstance()->put(Log::$ERROR, __CLASS__, __METHOD__, $e->getMessage());
            return array('success' => false);
        }
    }
    
    function removeContacts($contactsList) {
            foreach ($contactsList as $contactData) {
                $removeContactResult = $this->destroy($contactData);

                if ($removeContactResult['success'] == false)
                    return array('success' => false);
            }
            return array('success' => true);
        }

        /**
         * Deletes the given Base datatype.
         * @return Operation status
         */
        function destroy($contactData) {
            try {
                $contact = new Contact();
                $contact->setId($contactData->id);
                $contact->delete();

                return array('success' => true);
            } catch (Exception $e) {
                LOG::getInstance()->put(Log::$ERROR, __CLASS__, __METHOD__, $e->getMessage());
                return array('success' => false);
            }
        }

    /**
     *
     * @param type $data
     * @return type 
     */
    function read($data) {
        
    }

}

?>