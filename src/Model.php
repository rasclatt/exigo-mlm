<?php
namespace Exigo;

use \GuzzleHttp\Client as Guzzle;

class Model
{
    public const AUTH_DEF = 'Basic';
    public const AUTH_BEARER = 'Bearer';
    private Guzzle $http;
    public static string $cacheDirectory;
    private string $exigo_host = '-api.exigo.com';
    private string $version = '3.0';
    protected string $baseService;
    private string $service;
    private string $auth_type;
    private $body;
    private $endpoint;
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
     *	@description	
     *	@param	
     */
    private function transmit(string $type)
    {
        $data = [
            implode(' ', [ $this->auth_type, EXIGO_APIKEY ]),
            'https://'.$this->getEndpoint(),
            $this->body,
            strtoupper($type)
        ];
        return $this->curl(...$data);
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
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        # Do post
        if (in_array($method, ['POST', 'PATCH'])) {
            // Convert the data to JSON
            $json_data = json_encode($data);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json_data)
            ]);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: ' . $apikey
            ]);
        }
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
     *	@description	
     *	@param	
     */
    protected function getCached(string $name):? array
    {
        $path = $this->getCacheDir()."/{$name}.json";
        return (file_exists($path))? json_decode(file_get_contents($path), 1) : null;
    }
    /**
     *	@description	
     *	@param	
     */
    private function getCacheDir(): string
    {
        return (empty(self::$cacheDirectory)? realpath('../../../'.__DIR__).'/exigo.cache' : self::$cacheDirectory);
    }
    /**
     *	@description	
     *	@param	
     */
    protected function cache(string $name, $data): array
    {
        $path = $this->getCacheDir()."/{$name}.json";
        file_put_contents($path, json_encode($data));
        return $data;
    }
    /**
     *	@description	
     *	@param	
     */
    protected function getCachedOrStore(string $name, Callable $func): array
    {
        $data = $this->getCached($name);

        if(!empty($data))
            return $data;

        return $this->cache($name, $func());
    }
    /**
     *	@description	
     */
    protected function trimAll($value)
    {
        if(is_array($value)) {
            foreach($value as $k => $v) {
                $value[$k] = $this->trimAll($v);
            }
        } else {
            if(is_string($value)) {
                return trim($value);
            }
        }
        return $value;
    }
    /**
     *	@description	Shortcut post method to remove some DRYness
     */
    public function toPost(string $service, $body)
    {
        return $this->setService($service)
        ->setBody($this->trimAll(($body instanceof \SmartDto\Dto)? $body->toArray() : $body))
        ->post();
    }
    /**
     *	@description	Shortcut get method to remove some DRYness
     */
    public function toGet(string $service, $body = null)
    {
        if($body instanceof \SmartDto\Dto)
            $body = $body->toArray();
        return $this->setService($service.(!empty($body)? $this->toQueryString($body) : ''))->get();
    }
}