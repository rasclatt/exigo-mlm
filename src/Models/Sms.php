<?php
namespace Exigo\Models;

use \Exigo\Dto\Sms\Send\Request;
use \Exigo\Dto\Response;

class Sms extends \Exigo\Model
{
    protected string $baseService = '/sms';
    /**
     *	@description	
     *	@param	
     */
    public function send(Request $request): Response
    {
        return new Response($this->toPost($this->baseService, $request->toArray()));
    }
}