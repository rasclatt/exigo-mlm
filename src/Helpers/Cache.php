<?php
namespace Exigo\Helpers;

class Cache
{
    private string $cacheDir;
    /**
     *	@description	
     *	@param	
     */
    public function __construct(string $cacheDir = null)
    {
        if($cacheDir)
            $this->setRootDir($cacheDir);
    }
    /**
     *	@description	
     *	@param	
     */
    public function setRootDir(string $cacheDir): self
    {
        $this->cacheDir = $cacheDir;
        return $this;
    }
    /**
     *	@description	Fetch the contents of a previously stored json response
     */
    public function getCached(string $name):? array
    {
        $path = $this->getCacheDir()."/{$name}.json";
        return (file_exists($path))? json_decode(file_get_contents($path), 1) : null;
    }
    /**
     *	@description	Returns the cache directory root. Defaults to host root
     */
    private function getCacheDir(): string
    {
        return (empty($this->cacheDir)? realpath('../../../'.__DIR__).'/exigo.cache' : $this->cacheDir);
    }
    /**
     *	@description	Save and return the cached data
     */
    public function cache(string $name, $data): array
    {
        $path = $this->getCacheDir()."/{$name}.json";
        file_put_contents($path, json_encode($data));
        return $data;
    }
    /**
     *	@description	Fetches cache, if stored, otherwise runs the callable function and caches the result
     *  @important      The naming convention of saved files is important so as to not return the wrong data.
     *                  ie. "products.us.1.1.json"  which might be cached products relating to us retail customers from warehouse 1.
     *                  bad naming example: "products.json" because you will pull the same products in every instance no matter country or customer type.
     */
    public function getCachedOrStore(string $name, Callable $func): array
    {
        $data = $this->getCached($name);
        if(!empty($data))
            return $data;
        return $this->cache($name, $func());
    }
}