<?php
namespace Exigo;

use \GuzzleHttp\Client as Guzzle;
use Exigo\Interfaces\Database as IDatabase;

class Model
{
    public const AUTH_DEF = 'Basic';
    public const AUTH_BEARER = 'Bearer';
    public static string $cacheDirectory;
    protected string $baseService;
    private string $exigo_host = '-api.exigo.com';
    private string $version = '3.0';
    private string $service;
    private string $auth_type;
    private $body;
    private $endpoint;
    protected IDatabase $db;
    private array $data;
    
    private Guzzle $http;
    /**
     *	@description	
     *	@param	$auth_type [string|void]    Use object::AUTH_DEF or object::AUTH_BEARER. Currently default is Basic 
     */
    public function __construct(string $auth_type = null)
    {
        $this->http = new Guzzle();
        # Set an initial endpoint
        $this->setEndpoint(EXIGO_API_COMPANY_NAME);
        $this->auth_type = (empty($auth_type))? self::AUTH_DEF : $auth_type;
    }
    /**
     *	@description	
     *	@param	
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
        return $this;
    }
    /**
     *	@description	    Allows the user to reset the endpoint
     *	@param	$endpoint   Path of the endpoint
     */
    protected function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint . $this->exigo_host;
        return $this;
    }
    /**
     *	@description	    Allows the user to reset the endpoint fully
     *	@param	$endpoint   Path of the endpoint
     */
    public function overWriteEndpoint(string $endpoint)
    {
        $this->endpoint = rtrim($endpoint, '/');
        return $this;
    }
    /**
     *	@description	
     *	@param	
     */
    protected function setService(string $service)
    {
        $this->service = $service;
        return $this;
    }
    /**
     *	@description	
     *	@param	
     */
    protected function setBody($body)
    {
        $this->body = $body;
        return $this;
    }
    /**
     *	@description	
     *	@param	
     */
    protected function get()
    {
        return $this->transmit(__FUNCTION__);
    }
    /**
     *	@description	
     *	@param	
     */
    protected function post()
    {
        return $this->transmit(__FUNCTION__);
    }
    /**
     *	@description	
     *	@param	
     */
    protected function patch()
    {
        return $this->transmit(__FUNCTION__);
    }
    /**
     *	@description	
     *	@param	
     */
    protected function put()
    {
        return $this->transmit(__FUNCTION__);
    }
    /**
     *	@description	
     *	@param	
     */
    protected function delete()
    {
        return $this->transmit(__FUNCTION__);
    }
    /**
     * @description 
     **/
    protected function assembleData()
    {
        $this->data = [
            implode(' ', [ $this->auth_type, EXIGO_APIKEY ]),
            'https://'.$this->getEndpoint(),
            $this->body
        ];
        return $this;
    }
    /**
     * @description 
     **/
    public function getAssembledData()
    {
        $this->assembleData();
        return $this->data;
    }
    /**
     *	@description	
     *	@param	
     */
    private function transmit(string $type)
    {
        $this->assembleData();
        $this->data[]  = strtoupper($type);
        return $this->curl(...$this->data);
    }
    /**
     *	@description	
     *	@param	
     */
    public function curl(
        string $apikey,
        string $url,
        array $data = null,
        string $method = 'GET'
    )
    {
        # Initialize
        $ch = curl_init();
        # Add some base options
        $options = [
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2
        ];
        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . $apikey
        ];
        if (in_array($method, ['POST', 'PATCH'])) {
            $json_data = json_encode($data);
            $options[CURLOPT_POST] = 1;
            $options[CURLOPT_POSTFIELDS] = $json_data;
            $headers[] = 'Content-Length: ' . strlen($json_data);
        }
        $options[CURLOPT_HTTPHEADER] = $headers;
        curl_setopt_array($ch, $options);
        # Execute the cURL session
        $response = curl_exec($ch);
        # Check for errors
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            throw new \Exception("cURL error: {$error_msg}");
        }
        # Close the cURL session
        curl_close($ch);
        # Send back results with decode
        $response = @json_decode($response, 1);
        # If there is some problem
        if(!empty($response['message']))
            throw new \Exception(trim($response['message']), 500);
        # Send back response
        return $response;
    }
    /**
     *	@description	
     *	@param	
     */
    private function getEndpoint()
    {
        return rtrim($this->endpoint, '/').'/'.$this->version.'/'.ltrim($this->service, '/');
    }
    /**
     *	@description	
     *	@param	
     */
    public function tryCatch(Callable $func, $return, Callable $transform = null )
    {
        try {
            return $transform? $transform($func()) : $func();
        } catch (\Throwable $th) {
            return (is_callable($return))? $return($th) : $return;
        }
    }
    /**
     *	@description	
     *	@param	
     */
    protected function toQueryString(array $arr, array $unset = []): string
    {
        foreach($unset as $v) {
            if(isset($arr[$v]))
                unset($arr[$v]);
        }
        $arr = array_filter($arr);
        return (!empty($arr))? '?'.http_build_query($arr) : '';
    }
    /**
     *	@description	            Allow for caching of API results, ideally for products and product collections
     *	@param	$cacheDir [string]  The root folder for the cache directory
     */
    protected function caching(string $cacheDir): Helpers\Cache
    {
        return new Helpers\Cache($cacheDir);
    }
    /**
     *	@description	Shortcut post method to remove some DRYness
     */
    public function toPost(string $service, $body)
    {
        return $this->setService($service)
        ->setBody(Helpers\ArrayWorks::trimAll(($body instanceof \SmartDto\Dto)? $body->toArray() : $body))
        ->post();
    }
    /**
     *	@description	Shortcut get method to remove some DRYness
     */
    public function toGet(string $service, $body = null)
    {
        if($body instanceof \SmartDto\Dto)
            $body = $body->toArray();
        return $this->setService($service.(!empty($body)? $this->toQueryString(Helpers\ArrayWorks::trimAll($body)) : ''))->get();
    }
    /**
     *	@description	Shortcut update method to remove some DRYness
     */
    public function toPatch(string $service, $body)
    {
        return $this->setService($service)
        ->setBody(Helpers\ArrayWorks::trimAll(($body instanceof \SmartDto\Dto)? $body->toArray() : $body))
        ->patch();
    }

    public function connect(IDatabase $db): self
    {
        $this->db = $db;
        return $this;
    }
}