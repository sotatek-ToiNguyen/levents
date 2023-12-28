<?php

namespace Modules\Post\Http\Controllers\Admin;

use Modules\Admin\Traits\HasCrudActions;

class PostController
{
    use HasCrudActions;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'post::posts.post';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'post::admin.post';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
}
