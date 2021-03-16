<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Book\ApiBookIndexRequest;
use App\Http\Requests\Book\ApiBookStoreRequest;
use App\Http\Requests\Book\ApiBookUpdateRequest;
use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\Book\BookFullResource;
use App\Models\Book;
use App\Services\Book\BookService;

class ApiBookController extends Controller
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(ApiBookIndexRequest $request)
    {
        $limit = (int) $request->get('limit', static::DEFAULT_LIMIT_ITEMS_PER_PAGE);
        $offset = (int) $request->get('offset', 0);


        $authors = $this->bookService->getAll($limit, $offset);
        return new BookCollection($authors);
    }


    public function store(ApiBookStoreRequest $request)
    {
        $item = $this->bookService->createBookFromArray($request->all());

        $message = [
            'message' => [
                'title' => trans('api.successTitle'),
                'text' => trans('api.successText') ]
        ];

        return (new BookFullResource($item))
            ->additional($message)
            ->response()
            ->setStatusCode(self::HTTP_STATUS_CREATED);
    }


    public function show(string $id)
    {
        if (!is_numeric($id)) {
            abort(400, 'Id have to be numeric');
        }

        $item = $this->bookService->find($id);
        if (!$item) {
            abort(404);
        }

        BookFullResource::withoutWrapping();
        return new BookFullResource($item);
    }


    public function update(ApiBookUpdateRequest $request, Book $book)
    {
        $this->bookService->updateBook($book, $request->all());

        BookFullResource::withoutWrapping();
        return new BookFullResource($book);
    }
}
