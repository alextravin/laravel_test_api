<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\AuthorBook
 *
 * @property int $id
 * @property int $author_id
 * @property int $book_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBook query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBook whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBook whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBook whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AuthorBook extends Pivot
{
    //
}
