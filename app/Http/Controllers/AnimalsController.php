<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AnimalsCreateRequest;
use App\Http\Requests\AnimalsUpdateRequest;
use App\Repositories\AnimalsRepository;
use App\Validators\AnimalsValidator;

/**
 * Class AnimalsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AnimalsController extends BaseController
{
    /**
     * @var AnimalsRepository
     */
    protected $repository;

    /**
     * @var AnimalsValidator
     */
    protected $validator;

    /**
     * AnimalsController constructor.
     *
     * @param AnimalsRepository $repository
     * @param AnimalsValidator $validator
     */
    public function __construct(AnimalsRepository $repository, AnimalsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Get(
     *     path="/api/animals",
     *     description="Return list animals",
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Connect to Database error"
     *     )
     * )
     */
    public function index()
    {
        try {
            $animals = $this->repository->all();
            if($animals) {
                return $this->sendResponse($animals, __('messages.demo.update_success'));
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return $this->sendError(__('messages.demo.update_fail'));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AnimalsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AnimalsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $animal = $this->repository->create($request->all());

            $response = [
                'message' => 'Animals created.',
                'data'    => $animal->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $animal,
            ]);
        }

        return view('animals.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animal = $this->repository->find($id);

        return view('animals.edit', compact('animal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AnimalsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AnimalsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $animal = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Animals updated.',
                'data'    => $animal->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Animals deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Animals deleted.');
    }
}
