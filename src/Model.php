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
        $headers = [
            'headers' => [
                'Authorization' => implode(' ', [ $this->auth_type, EXIGO_APIKEY ]),
                'Content-Type' => 'application/json'
            ]
        ];
        
        return @json_decode($this->http
            ->request(
                $type,
                $this->getEndpoint(),
                (in_array(strtolower($type), ['get','delete'])? $headers : array_merge($headers, [ 'json' => $this->body ])))
            ->getBody()
            ->getContents(), 1);
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