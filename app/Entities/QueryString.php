<?php
declare(strict_types=1);

namespace App\Entities;

use Illuminate\Http\Client\Request;
use Budgetcontrol\Library\Model\Workspace;
use App\Entities\Param;

class QueryString {

    /** @var array<string,string> $params */
    public array $params;

    /**
     * QueryString constructor.
     *
     * @param array<string,Param> $params An associative array of query parameters.
     */
    public function __construct(array $params = [])
    {
        $this->params = $this->cleanQUeryParams($params);
    }

    /**
     * Retrieve query parameters from the given request.
     *
     * @param Request $request The HTTP request instance.
     * @param array $fields The fields to retrieve from the query string.
     * @return array The query parameters.
     */
    public function getQueryParams(array $fields = []): array
    {   
        $queryParams = $this->params;
        $params = [];

        foreach ($fields as $field) {
            if (array_key_exists($field, $queryParams)) {
                $params[$field] = $queryParams[$field];
            }
        }

        return $params;
    }

    /**
     * Convert the QueryString object to its string representation.
     *
     * @return string The string representation of the QueryString object.
     */
    public function __toString()
    {
        $queryParams = $this->removeParamsByConfig($this->params);           
        return  "?" . http_build_query($queryParams);
    }

    /**
     * Retrieve the workspace ID based on the provided UUID.
     *
     * @param string $uuid The UUID of the workspace.
     * @return int The workspace ID.
     */
    public static function workspaceId(string $uuid): int
    {
        $ws = Workspace::where('uuid', $uuid)->first()->id;

        if($ws === null) {
            throw new \InvalidArgumentException('Invalid workspace UUID');
        }

        return $ws;
    }


    /**
     * Cleans the query parameters.
     *
     * This function takes an array of query parameters and processes them to remove
     * any unwanted or invalid entries, ensuring that the resulting array contains
     * only valid query parameters.
     *
     * @param array $queryParams The array of query parameters to be cleaned.
     * @return array<string,string> The cleaned array of query parameters.
     */
    private function cleanQUeryParams($queryParams): array 
    {
        foreach($queryParams as $key => $value) {
            $params[$key] = $this->build($value);
        }

        return $queryParams;
    }

    private function removeParamsByConfig($queryParams) {
        $fiterlConf = config('routes.config.query_filters');
        if(!empty($fiterlConf) && is_array($fiterlConf)) {
            foreach($queryParams as $key => $_) {
                if(!in_array($key, $fiterlConf)) {
                    unset($queryParams[$key]);
                }
            }
        }

        return $queryParams;
    }

    /**
     * Builds an array representation of the given parameter.
     *
     * @param Param $value The parameter to be converted into an array.
     * @return mixed The array representation of the parameter.
     */
    private function build(Param $value): mixed
    {
        /** @var Param $value */
        if(!$value instanceof Param) {
            throw new \InvalidArgumentException("Object must be instance of \App\Entities\Param ");
        }

        $paramValue = $value->value;
        if(isset($value->closure) && is_callable($value->closure)){
            $closure = $value->closure;
            $paramValue = $closure($value->value);
        }

        return $paramValue;

    }

    /**
     * Sets a parameter in the query string.
     *
     * @param string $name The name of the parameter.
     * @param string|array $value The value of the parameter.
     * @param callable|null $closure An optional closure to modify the value before setting it.
     * 
     * @return void
     */
    public function setParam(string $name, string|array $value, ?callable $closure = null, string $subKey = null): void
    {
        
        if($subKey !== null) {
            $this->params[$subKey][$name] = $this->build(new Param($name, $value, $closure));
        } else {
            $this->params[$name] = $this->build(new Param($name, $value, $closure));
        }
    }


}