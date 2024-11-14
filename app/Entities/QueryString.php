<?php
declare(strict_types=1);

namespace App\Entities;

use Illuminate\Http\Client\Request;
use Budgetcontrol\Library\Model\Workspace;
use App\Entities\Param;

class QueryString {

    /** @var array<string,string> $params */
    public readonly array $params;

    /**
     * QueryString constructor.
     *
     * @param array<string,Param> $params An associative array of query parameters.
     */
    public function __construct(array $params)
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
        return  "?" . http_build_query($this->params);
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
        $params = [];
        $fiterlConf = config('routes.config.query_filters');
        if(!empty($fiterlConf) && is_array($fiterlConf)) {
            $queryParams = array_filter($queryParams, function($key) use ($fiterlConf) { return in_array($key->name, $fiterlConf); });
        }

        /** @var Param $value */
            foreach ($queryParams as $key => $value) {
            if(!$value instanceof Param) {
                throw new \InvalidArgumentException("Object must be instance of \App\Entities\Param ");
            }

            $paramValue = $value->value;
            if(isset($value->closure) && is_callable($value->closure)){
                $closure = $value->closure;
                $paramValue = $closure($value->value);
            }

            if(is_array($value->value)) {
                $newKey = array_key_first($value->value);
                $params[$value->name][$newKey] = $paramValue;
            } else {
                $params[$value->name] = $paramValue;
            }

        }

        return $params;
    }


}