<?php

namespace BiblesearchApi;

/**
* Exception (optionally) thrown when an API method call fails.
*
* You can determine if this exception should be thrown by calling
* Request's setExceptionThrownOnFailure() method.
*
* @package ABS
* @author  Brian Smith <wisecounselor@gmail.com>
*/
class MethodFailureException extends Exception {
    
}