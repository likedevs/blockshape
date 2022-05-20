## RESTful format response for Laravel

Restable is a useful to create RESTful API response format that support multiple format, such as Json, XML
Serialized, PHP.

### Installation

To get the lastest version of Theme simply require it in your `composer.json` file.

~~~
"terranet/restable": "dev-master"
~~~

You'll then need to run `composer install` to download it and have the autoloader updated.

Once Package is installed you need to register the service provider with the application. Open up `config/app.php` and find the `providers` key.

~~~
'providers' => array(

    'Terranet\Restable\RestableServiceProvider'

)
~~~

Restable also ships with a facade which provides the static syntax for creating collections. You can register the facade in the `aliases` key of your `config/app.php` file.

~~~
'aliases' => array(

    'Restable' => 'Terranet\Restable\Facades\Restable'

)
~~~

Publish config using artisan CLI.

~~~
php artisan vendor:publish
~~~

## Usage

Create reponses format for RESTful.

Example:
~~~php
class ApiBlogsController extends BaseController {

    /**
     * Checking permission.
     *
     * @return Response
     */
    public function __construct()
    {
        if ( ! Input::get('secret') == '12345')
        {
            return Restable::unauthorized();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Set default response format.
        //Restable::setDefaultFormat('xml');

        // Override format response.
        //return Restable::listing(Blog::paginate())->to('xml');
        //return Restable::listing(Blog::paginate())->toXML();

        return Restable::listing(Blog::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('api.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $blog = new Blog;

        $validator = Validator::make(Input::all(), array(
            'title'       => 'required',
            'description' => 'required'
        ));

        if ($validator->fails())
        {
            return Restable::unprocess($validator);
        }

        $blog->title = Input::get('title');
        $blog->description = Input::get('description');

        $blog->save();

        return Restable::created($blog);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);

        if ( ! $blog)
        {
            return Restable::missing()
        }

        return Restable::single($blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);

        if ( ! $blog)
        {
            return Restable::missing();
        }

        return View::make('api.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $blog = Blog::find($id);

        if ( ! $blog)
        {
            return Restable::missing();
        }

        $validator = Validator::make(Input::all(), array(
            'title'       => 'required',
            'description' => 'required'
        ));

        if ($validator->fails())
        {
            return Restable::unprocess($validator);
        }

        $blog->title = Input::get('title');
        $blog->description = Input::get('description');

        $blog->save();

        return Restable::updated($blog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if ( ! $blog)
        {
            return Restable::missing();
        }

        $blog->delete();

        return Restable::deleted();
    }

}
~~~

Error cases.
~~~php
// Unauthorized.
Restable::unauthorized();

// Bad request.
Restable::bad();

// Missing, Not found.
Restable::missing();

// Unprocess, Validation Failed.
Restable::unprocess();

// Custom.
Restable::error(null, 429);
~~~

Another success cases.
~~~php
return Restable::success();
~~~

Changing error code.
~~~php
return Restable::code(9001)->bad('message');
~~~