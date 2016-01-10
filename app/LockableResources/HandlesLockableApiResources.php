<?php

namespace App\LockableResources;


use Illuminate\Support\Facades\Auth;
use MezzoLabs\Mezzo\Http\Requests\Resource\ShowResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

trait HandlesLockableApiResources
{
    /**
     * @param ShowResourceRequest $request
     * @param $id
     */
    public function locked(ShowResourceRequest $request, $id)
    {
        $resource = $this->repository()->findOrFail($id);
        return $this->lockedResponse($resource);
    }

    public function lock(UpdateResourceRequest $request, $id)
    {
        $resource = $this->repository()->findOrFail($id);

        $locked = $this->lockResource($resource, $request->get('minutes', 5));

        if (!$locked) {
            throw new AccessDeniedHttpException('Resource is already locked by ' . $resource->lockedBy->email . '.');
        }

        return $this->lockedResponse($resource);
    }

    public function unlock(UpdateResourceRequest $request, $id)
    {
        $resource = $this->repository()->findOrFail($id);

        $resource->unlock();

        return $this->lockedResponse($resource);
    }

    private function lockedResponse(LockableResource $resource)
    {
        return $this->response()->withArray(['data' => [
            'locked' => $resource->isLockedForUser(),
            'locked_until' => $resource->lockedUntil(),
            'locked_by' => $resource->lockedBy
        ]]);
    }

    private function lockResource(LockableResource $resource, $minutes) : bool
    {
        if ($resource->isLockedForUser())
            return false;

        if (!Auth::check()) {
            throw new UnauthorizedHttpException('You have to be logged in to lock a resource.');
        }

        $resource->lock(Auth::user(), 5);
        return true;
    }

}