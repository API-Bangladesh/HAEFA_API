<?php 
namespace App\Traits;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ResponseTrait{

    public $fractal;

    public function respondWithCollection($collection, $callback, bool $success, int $status, $message = ''){
        $this->fractal = new Manager();
        $resources = new Collection($collection, $callback);

        if(empty($collection)){
            //$collection = new LengthAwarePaginator([],0,10);
            $resources = new Collection($collection, $callback);
        }

        //$resources->setPaginator(new IlluminatePaginatorAdapter($collection));

        $rootScope = $this->fractal->createData($resources);

        return $this->responseJson($success, $status, $message, [], $rootScope->toArray());

    }

    public function respondWithItem($item, $callback, bool $success, int $status, $message = ''){
        $this->fractal = new Manager;

        $resources = new Item($item, $callback);
        $rootScope = $this->fractal->createData($resources);

        return $this->responseJson($success, $status, $message, [], $rootScope->toArray());
    }
    public function responseJson(bool $success, int $status, string $message = '', array $error =[], $data =[]){
        $result_data = !empty($data) ? isset($data['data']) ? $data : ['data' => $data] : [];
        return response()->json(\array_merge([
            'success' => $success,
            'status' => $status,
            'message' => $message,
            'error' => $error

        ],$result_data), $status);
    }
}