<?php

namespace BiblesearchApi;

/**
 * @version $Id$
 * @author  Brian Smith <wisecounselor@gmail.com>
 * @package ABS
 */

class Book extends Base {
    
    /**
     * The name of the XML element in the response that defines the object.
     *
     * @var string
     */
    const XML_RESPONSE_ELEMENT = 'book';
    
	/**
     * A group ID defining a specific book group
     *
     * @var string
     */
    private $_group_id;
    
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
                return 'versions/' . $this->_version_id.'/books.xml';
                break;
            case 'showbookgroup':
                return 'bookgroups/' . $this->_group_id . '.xml';
                break;
            case 'show':
                return 'books/' . $this->_version_id . ':' . $this->_book_id . '.xml';
                break;
            default:
                throw new Exception('Invalid method ' . $method);
        }
    }
    /*
     * Method to list all books of the Bible
     * 
     * @return  xml SimpleXML object
     */
    public function listBooks() {
        return $this->requestXml('list');
    }
	
    /*
    * Method to list show the details of a specific book of the Bible
    * 
    * @return  xml SimpleXML object
    */
    public function show($book = '') {
        if (!empty($book)) {
            $this->setBook($book);
        }
        $this->__validateVersion();
        if (empty($this->_book_id) || is_null($this->_book_id)) {
            throw new Exception('The Book cannot be null or empty');
        }
        $xml = $this->requestXml('show');
        return $xml;
    }
	
     /*
    * Method to list show the details of a specific version of the Bibl
    * 
    * @param   string $version_id
    * @return  xml SimpleXML object
    */
    public function showBookGroup($group_id) {
        $this->setGroup($group_id);
        return $this->requestXml('showbookgroup');
    }
	
    /*
     * Method to set the version of the Bible being processed
     * 
     * @param   string $version_id
      */
    public function setGroup($group_id) {
        $this->_group_id = $group_id;
    }
}