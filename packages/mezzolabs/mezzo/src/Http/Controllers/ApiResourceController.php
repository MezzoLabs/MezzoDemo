<?php


namespace MezzoLabs\Mezzo\Http\Controllers;

use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Requests\Resource\DestroyResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\IndexResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\ShowResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ApiResponseFactory;
use MezzoLabs\Mezzo\Http\Transformers\EloquentModelTransformer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class ApiResourceController extends ApiController implements ResourceControllerContract
{
    use \MezzoLabs\Mezzo\Http\Controllers\HasModelResource;

    protected $allowStaticRepositories = false;

    /**
     * Display a listing of the resource.
     *
     * @param IndexResourceRequest $request
     * @return ApiResponseFactory
     */
    public function index(IndexResourceRequest $request)
    {
        $response = $this->response()->collection($this->repository()->all(), $this->bestModelTransformer());

        return $response;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreResourceRequest $request
     * @return ApiResponseFactory
     * @throws ModuleControllerException
     */
    public function store(StoreResourceRequest $request)
    {
        return $this->response()->result($this->repository()->create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param ShowResourceRequest $request
     * @param int $id
     * @return ApiResponseFactory
     */
    public function show(ShowResourceRequest $request, $id)
    {
        $this->assertResourceExists($id);
        return $this->response()->item($this->repository()->findOrFail($id), $this->bestModelTransformer());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateResourceRequest $request
     * @param  int $id
     * @return ApiResponseFactory
     */
    public function update(UpdateResourceRequest $request, $id)
    {
        $this->assertResourceExists($id);
        return $this->response()->result($this->repository()->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyResourceRequest $request
     * @param  int $id
     * @return ApiResponseFactory
     */
    public function destroy(DestroyResourceRequest $request, $id)
    {
        $this->assertResourceExists($id);
        return $this->response()->result($this->repository()->delete($id));
    }

    /**
     * @param $id
     * @return NotFoundHttpException
     */
    public function assertResourceExists($id)
    {
        if(!$this->repository()->exists($id))
            throw new NotFoundHttpException();
        return true;
    }


    /**
     * Check if this resource controller is correctly named (<ModelName>Controller)
     *
     * @return bool
     * @throws ModuleControllerException
     */
    public function isValid()
    {
        parent::isValid();

        return $this->assertResourceIsReflectedModel();

    }

    /**
     * Find the best model transformer based on the class name and the registered transformers.
     * If there is no registration for the given model a new instance of "EloquentModelTransformer" will be returned.
     *
     * @param string $modelClass
     * @return EloquentModelTransformer
     */
    protected function bestModelTransformer($modelClass = "")
    {
        if(empty($modelClass))
            $modelClass = $this->model()->className();

        return EloquentModelTransformer::makeBest($modelClass);
    }
}