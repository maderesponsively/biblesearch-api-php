<?php

namespace BiblesearchApi;
    
/**
 * @version $Id$
 * @author  Brian Smith <wisecounselor@gmail.com>
 * @package ABS
 */

class User extends Base {
    
    /**
     * The name of the XML element in the response that defines the object.
     *
     * @var string
     */
    const XML_RESPONSE_ELEMENT = 'user';
    
    function __construct(Api $api) {
        parent::__construct($api, self::XML_RESPONSE_ELEMENT);
    }
    /*
     * Method to return the appropriate URL ending based on the method being executed
     * 
     * @param   string $method
     * @return  string
     * @throws  Exception
     */
    
    protected function getUrl($method) {
        switch($method) {
            case 'user':
                return 'user.xml';
                break;
            case 'update':
                return 'user.xml';
                break;
            default:
                throw new Exception('Invalid method ' . $method);
        }
    }
    
    /*
    * Method to get the details of current api user account
    * 
    * @return  xml SimpleXML object
    */
    public function getUser() {
        return $this->requestXml('user');
    }
    /*
    * Method to update a user account
    * 
    * @param   string $xml
    * @return  xml SimpleXML object
    */
    public function updateUser($xml) {
        $test = simplexml_load_string($xml);
        if (false === $test) {
            throw new XmlParseException('Could not parse XML.', $xml);
        }
        $this->setRestMethod('PUT');
        $this->setRequestData($xml);
        return $this->requestXml('update');
    }
}