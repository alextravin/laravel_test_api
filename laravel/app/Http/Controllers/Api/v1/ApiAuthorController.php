<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Author\ApiAuthorBooksRequest;
use App\Http\Requests\Author\ApiAuthorIndexRequest;
use App\Http\Requests\Author\ApiAuthorStoreRequest;
use App\Http\Resources\Author\AuthorCollection;
use App\Http\Resources\Author\AuthorFullResource;
use App\Http\Resources\Book\BookCollection;
use App\Services\Author\AuthorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiAuthorController extends Controller
{

    private AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(ApiAuthorIndexRequest $request): JsonResource
    {
        $limit = (int) $request->get('limit', static::DEFAULT_LIMIT_ITEMS_PER_PAGE);
        $offset = (int) $request->get('offset', 0);


        $authors = $this->authorService->getAll($limit, $offset);
        return new AuthorCollection($authors);
    }


    public function store(ApiAuthorStoreRequest $request): JsonResponse
    {
        $item = $this->authorService->createAuthorFromArray($request->all());
        //@todo Limit books items in Response

        $message = [
            'message'=>[
                'title'=> trans('api.successTitle'),
                'text'=> trans('api.successText') ]
        ];

        return (new AuthorFullResource($item))
            ->additional($message)
            ->response()
            ->setStatusCode(self::HTTP_STATUS_CREATED);
    }

    public function books(string $id, ApiAuthorBooksRequest $request): JsonResource
    {
        $limit = (int) $request->get('limit', static::DEFAULT_LIMIT_ITEMS_PER_PAGE);
        $offset = (int) $request->get('offset', 0);


        $books = $this->authorService->getAll($limit, $offset);
        return new BookCollection($books);
    }

    public function show(string $id): JsonResource
    {
        if (!is_numeric($id)) {
           abort(400, 'Id have to be numeric');
        }

        $item = $this->authorService->find($id);
        if (!$item) {
            abort(404);
        }

        AuthorFullResource::withoutWrapping();
        return new AuthorFullResource($item);
    }

}
