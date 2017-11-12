<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductController extends AppBaseController {

    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo) {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        $this->productRepository->pushCriteria(new RequestCriteria($request));
        $products = $this->productRepository->all();

        $categories = \App\Models\Category::all(['name', 'id']);
        $users = \App\Models\User::all('username', 'id');
        return view('products.index')
                        ->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create() {
        $categories = \App\Models\Category::all(['id', 'name']);
        foreach ($categories as $key) {
            $category_ids[$key->id] = $key->name;
        }

        $users = \App\Models\User::all(['id', 'username']);
        foreach ($users as $key) {
            $author[$key->id] = $key->username;
        }
        return view('products.create')->with('category_ids', $category_ids)->with('author', $author);
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request) {
        $input = $request->all();

        $product = $this->productRepository->create($input);

        Flash::success('Product saved successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id) {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }
        $categories = \App\Models\Category::all('name', 'id');
        foreach ($categories as $key) {
            $category_ids[$key->id] = $key->name;
        }
        $users = \App\Models\User::all('username', 'id');
        foreach ($users as $key) {
            $author[$key->id] = $key->username;
        }
        return view('products.edit')->with('product', $product)->with('category_ids', $category_ids)->with('author', $author);
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request) {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }
        $input['name'] = $request->name;
        $input['category_id'] = $request->category_id;
        $input['author'] = $request->author;
        $input['content'] = $request->content;
        $file = $request->file('image');

        if (isset($file)) {
            @unlink('uploads/'.$product->image);
            $destination_path = 'uploads';
            $name_file = 'product-' . \Ramsey\Uuid\Uuid::uuid4() . $file->getClientOriginalExtension();
            $file->move($destination_path, $name_file);
            $input['image'] = $name_file;
        } else {
            @unlink('uploads/'.$product->image);
        }

        $this->productRepository->update($input, $id);

        Flash::success('Product updated successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }
        @unlink('uploads/' . $product->image);
        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }

}
