<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\OutfitDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateOutfitRequest;
use App\Http\Requests\Admin\UpdateOutfitRequest;
use App\Repositories\Admin\OutfitRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OutfitController extends \App\Http\Controllers\Controller
{
    /** @var  OutfitRepository */
    private $outfitRepository;

    public function __construct(OutfitRepository $outfitRepo)
    {
        $this->outfitRepository = $outfitRepo;
    }

    /**
     * Display a listing of the Outfit.
     *
     * @param OutfitDataTable $outfitDataTable
     * @return Response
     */
    public function index(OutfitDataTable $outfitDataTable)
    {
        return $outfitDataTable->render('admin.outfits.index');
    }

    /**
     * Show the form for creating a new Outfit.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.outfits.create');
    }

    /**
     * Store a newly created Outfit in storage.
     *
     * @param CreateOutfitRequest $request
     *
     * @return Response
     */
    public function store(CreateOutfitRequest $request)
    {
        $input = $request->all();

        $outfit = $this->outfitRepository->create($input);

        alert()->success('Outfit saved successfully.');

        return redirect(route('admin.outfits.index'));
    }

    /**
     * Display the specified Outfit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $outfit = $this->outfitRepository->findWithoutFail($id);

        if (empty($outfit)) {
            alert()->error('Outfit not found');

            return redirect(route('admin.outfits.index'));
        }

        return view('admin.outfits.show')->with('outfit', $outfit);
    }

    /**
     * Show the form for editing the specified Outfit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $outfit = $this->outfitRepository->findWithoutFail($id);

        if (empty($outfit)) {
            alert()->error('Outfit not found');

            return redirect(route('admin.outfits.index'));
        }
        return view('admin.outfits.edit')->with('outfit', $outfit);
    }

    /**
     * Update the specified Outfit in storage.
     *
     * @param  int              $id
     * @param UpdateOutfitRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOutfitRequest $request)
    {
        $outfit = $this->outfitRepository->findWithoutFail($id);

        if (empty($outfit)) {
            alert()->error('Outfit not found');

            return redirect(route('admin.outfits.index'));
        }

        $outfit = $this->outfitRepository->update($request->all(), $id);

        alert()->success('Outfit updated successfully.');

        return back();
    }

    /**
     * Remove the specified Outfit from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $outfit = $this->outfitRepository->findWithoutFail($id);

        if (empty($outfit)) {
            alert()->error('Outfit not found');

            return redirect(route('admin.outfits.index'));
        }

        $this->outfitRepository->delete($id);

        alert()->success('Outfit ha sido eliminado');

        return redirect(route('admin.outfits.index'));
    }
}