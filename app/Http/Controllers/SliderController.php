<?php

namespace App\Http\Controllers;

use App\helpers\SaveImage;
use App\Model\Slider;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    private $classPath = 'App\Model\SliderItem';
    private $imagePath = 'slider-item';

    public function index()
    {
        $data['sliders'] = Slider::get();
        return view('backend.slider.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|required',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2555',
            'btn_text' => 'nullable|string|max:255',
            'target_url' => 'nullable|string|max:255',
            'target' => 'required',
        ]);

        $data = $this->saveData($request);
        if ($request->hasFile('image')) {
            $data['image'] = SaveImage::save($request->image, $this->imagePath);
        }
        Slider::create($data);
        toast(__('global.data_saved'), 'success');
        return redirect()->back();

    }


    private function saveData($request)
    {
        $data = $this->commanData($request);
        return $data;
    }

    private function commanData($request)
    {
        if ($request->target_url) {
            $target_url = $request->target_url;
        } else {
            $target_url = '#';
        }
        $request->order ? $order = $request->order : $order = 1;
        return [
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'btn_text' => $request->btn_text,
            'target_url' => $target_url,
            'target' => $request->target,
            'order' => $order,
            'active' => switch_case_check($request->active),
        ];
    }

    public function activeToggle(Slider $slider)
    {
        $slider->update([
            'active' => !$slider->active
        ]);

        toast(__('global.data_update'), 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Model\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('backend.slider.slider-item.show')->with('data', $slider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Model\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('backend.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'image' => 'image|nullable',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2555',
            'btn_text' => 'nullable|string|max:255',
            'target_url' => 'nullable|string|max:255',
            'target' => 'required',
        ]);
        $data = $this->commanData($request);
        if ($request->hasFile('image')) {
            $data['image'] = SaveImage::update($request->image,$this->imagePath, $slider->imagePath);
        }
        else{
            $data['image']=$slider->image;
        }
        $slider->update($data);
        toast(__('global.data_update'), 'success');
        return redirect()->route('admin.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return int
     */
    public function destroy(Slider $slider)
    {
        return deleteCheckForeignKey($slider);
    }

    public function apiSlider()
    {
        $data = Slider::select('id', 'title', 'image', 'active', 'order')
            ->orderBy('order')->get();
        $mainRoute = 'admin.sliders';
        return DataTables::of($data)
            ->addColumn('action', function ($data) use ($mainRoute) {
                return editDeleteAction($data->id, $mainRoute);
            })
            ->editColumn('image', function ($data) {
                return '<img src="' . asset($data->imagePath) . '" alt="" width="100px">';
            })
            ->editColumn('active_toggle', function ($data) use ($mainRoute) {
                return activeToggle($mainRoute . '.active-toggle',
                    $data->id, $data->active, 'Activate', 'Deactivate');
            })
            ->editColumn('active', function ($data) {
                return active_column_check($data->active);
            })
            ->rawColumns(['action', 'active', 'image', 'active_toggle'])
            ->make(true);
    }
}
