<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @author https://github.com/Stunext
 *
 * PHP, and by extension, Laravel does not support multipart/form-data requests when using any request method other than POST.
 * This limits the ability to implement RESTful architectures. This is a middleware for Laravel 5.7 that manually decoding
 * the php://input stream when the request type is PUT, DELETE or PATCH and the Content-Type header is mutlipart/form-data.
 *
 * The implementation is based on an example by [netcoder at stackoverflow](http://stackoverflow.com/a/9469615).
 * This is necessary due to an underlying limitation of PHP, as discussed here: https://bugs.php.net/bug.php?id=55815.
 */

class HandlePutFormData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->method() == 'POST' or $request->method() == 'GET')
        {
            return $next($request);
        }
        if (preg_match('/multipart\/form-data/', $request->headers->get('Content-Type')) or preg_match('/multipart\/form-data/', $request->headers->get('content-type')))
        {
			$parameters = $this->decode();

            $request->merge($parameters['inputs']);
            $request->files->add($parameters['files']);
        }
        else if (preg_match('/application\/json/', $request->headers->get('Content-Type')) or preg_match('/application\/json/', $request->headers->get('content-type')))
		{
			$request = json_decode($request->getContent());
			
		}

        return $next($request);
    }

    public function decode()
	{
	    $files = array();
	    $data = array();
	    // Fetch content and determine boundary
	    $rawData = file_get_contents('php://input');
	    $boundary = substr($rawData, 0, strpos($rawData, "\r\n"));
	    // Fetch and process each part
	    $parts = array_slice(explode($boundary, $rawData), 1);
	    foreach ($parts as $part) {
	        // If this is the last part, break
	        if ($part == "--\r\n") {
	            break;
	        }
	        // Separate content from headers
	        $part = ltrim($part, "\r\n");
	        list($rawHeaders, $content) = explode("\r\n\r\n", $part, 2);
	        $content = substr($content, 0, strlen($content) - 2);
	        // Parse the headers list
	        $rawHeaders = explode("\r\n", $rawHeaders);
	        $headers = array();
	        foreach ($rawHeaders as $header) {
	            list($name, $value) = explode(':', $header);
	            $headers[strtolower($name)] = ltrim($value, ' ');
	        }
	        // Parse the Content-Disposition to get the field name, etc.
	        if (isset($headers['content-disposition'])) {
	            $filename = null;
	            preg_match('/^form-data; *name="([^"]+)"(; *filename="([^"]+)")?/', $headers['content-disposition'], $matches);
	            $fieldName = $matches[1];
	            $fileName = (isset($matches[3]) ? $matches[3] : null);
	            // If we have a file, save it. Otherwise, save the data.
	            if ($fileName !== null) {
	                $localFileName = tempnam(sys_get_temp_dir(), 'sfy');
	                file_put_contents($localFileName, $content);
	                $files[$fieldName] = array(
	                    'name' => $fileName,
	                    'type' => $headers['content-type'],
	                    'tmp_name' => $localFileName,
	                    'error' => 0,
	                    'size' => filesize($localFileName)
	                );
	                // register a shutdown function to cleanup the temporary file
	                register_shutdown_function(function() use($localFileName) {
	                   unlink($localFileName);
	                });
	            } else {
	                $data[$fieldName] = $content;
	            }
	        }
        }
        $fields = new ParameterBag($data);

        return ["inputs" => $fields->all(), "files" => $files];
	}
}