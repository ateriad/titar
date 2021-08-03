<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdvertisementStatuses;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdvertisementsController extends Controller
{
    public function index()
    {
        return view('pages.admin.advertisements.index', [
            'advertisements' => Advertisement::all(),
        ]);
    }

    public function create()
    {
        return view('pages.admin.advertisements.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
            'status' => ['required', 'in:' . implode(',', AdvertisementStatuses::all())],
            'skippable' => ['required', 'max:3'],
            'length' => ['max:3', 'nullable']
        ]);

        $advertisement = new Advertisement();
        $advertisement->title = $request->input('title');
        $advertisement->video = '';
        $advertisement->url = $request->input('url');
        $advertisement->status = $request->input('status');
        $advertisement->skippable = $request->input('skippable');
        $advertisement->length = $request->input('length');
        $advertisement->save();

        return redirect()->route('admin.advertisements.edit', ['advertisement' => $advertisement])->with('success', trans('words.item.created'));
    }

    public function edit(Advertisement $advertisement)
    {
        return view('pages.admin.advertisements.edit', [
            'advertisement' => $advertisement,
        ]);
    }

    /**
     * @param Advertisement $advertisement
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function update(Advertisement $advertisement, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'video' => ['required', 'url', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
            'status' => ['required', 'in:' . implode(',', AdvertisementStatuses::all())],
            'skippable' => ['required', 'max:3'],
            'length' => ['max:3', 'nullable']
        ]);

        $attributes = $request->only([
            'title',
            'video',
            'url',
            'status',
            'skippable',
            'length',
        ]);

        $advertisement->update($attributes);

        return back()->with('success', trans('words.item.updated'));
    }

    /**
     * @param int $advertisement
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $advertisement)
    {
        Advertisement::whereId($advertisement)->delete();

        return back()->with('success', trans('words.item.deleted'));
    }
}
