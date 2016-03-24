<?php

namespace BiblesearchApi;

/**
 * @version $Id$
 * @author  Brian Smith <wisecounselor@gmail.com>
 * @package ABS
 */
    
/**
 *
 * This class is responsible for:
 * - Converting the XML string returned by a Request object into a
 *   SimpleXML object.
 * - Determining the success or failure of the request.
 *
 * @package ABS
 * @author  Brian Smith <wisecounselorh@gmail.com>
 * @since   0.1.0
 */
class Response {
    
    /**
     * XML payload of the Response.
     *
     * @var object SimpleXMLElement
     */
    var $xml = null;
    
    /**
     * Constructor takes output from the http request
     *
     * @param string $restResult XML string .
     * @param boolean $throwOnFailed Should an exception be thrown when the
     *      response indicates failure?
     * @throws XmlParseException, MethodFailureException
     */
    function __construct($restResult, $throwOnFailed = false) {
        $restResult = trim($restResult);
        //print "Response.php result: " . $restResult;
        if ($restResult != '<?xml version="1.0" encoding="utf-8" ?>') {
            $xml = simplexml_load_string($restResult);
            if (false === $xml ) {
                if ($throwOnFailed) {
                    throw new XmlParseException('Could not parse XML.', $restResult);
                }
            } else {
                $this->xml = $xml;
            }
        }
    }

    public function __toString() {
        return $this->xml->asXML();
    }

    /**
     * Get the XML Object.
     *
     * @return  object SimpleXML
     * @see     SimpleXML::asXML()
     * @since   0.2.3
     */
    public function getXml() {
        return $this->xml;
    }
}
