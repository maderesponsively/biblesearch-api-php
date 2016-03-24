<?php

namespace BiblesearchApi;

/**
 * @version $Id$
 * @author  Brian Smith <wisecounselor@gmail.com>
 * @package ABS
 */
    
class Note extends Base {
    
    /**
     * The name of the XML element in the response that defines the object.
     *
     * @var string
     */
    const XML_RESPONSE_ELEMENT = 'note';
    /**
     * The id of a specific note
     *
     * @var integer
     */
    protected $_note_id;
    
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
            case 'list':
                return 'user/notes.xml';
                break;
            case 'show':
                return 'notes/' . $this->_note_id . '.xml';
                break;
            case 'create':
                return 'user/notes.xml';
                break;
            case 'update':
                return 'notes/' . $this->_note_id . '.xml';
                break;
            case 'delete':
                return 'notes/' . $this->_note_id . '.xml';
                break;
            default:
                throw new Exception('Invalid method ' . $method);
        }
    }
    
    /*
    * Method to list all notes the api user has created
    *  
    * @param   string $method
    * @return  xml SimpleXML object
    */
    public function listNotes() {
        return $this->requestXml('list');
    }
    /*
    * Show specific note
    * 
    * @param   integer $note_id
    * @return  xml SimpleXML object
    */
    public function show($note_id) {
        $this->_note_id = $note_id;
        return $this->requestXml('show');
    }
    /*
    * Create a new note
    * 
    * @param   string $xml
    * @return  xml SimpleXML object
    */
    public function addNote($xml) {
        $test = simplexml_load_string($xml);
        
        if (false === $test) {
            throw new XmlParseException('Could not parse XML.', $xml);
        }
        $this->setRestMethod('POST');
        $this->setRequestData($xml);
        return $this->requestXml('create');
    }
    /*
    * Update a note
    *
    * @param   integer $note_id
    * @param   string $xml
    * @return  xml SimpleXML object
    */
    public function updateNote($note_id, $xml) {
        $this->_note_id = $note_id;
        $this->setRestMethod('PUT');
        $this->setRequestData($xml);
        return $this->requestXml('update');
    }
    /*
    * Create a new note
    * 
    * @param   string $method
    * @return  xml SimpleXML object
    */
    public function deleteNote($note_id) {
        $this->_note_id = $note_id;
        $this->setRestMethod('DELETE');
        return $this->requestXml('delete', false);
    }
}