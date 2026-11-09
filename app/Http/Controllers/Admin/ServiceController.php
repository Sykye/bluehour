<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ActivityLogger;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Service::class);

        $services = Service::latest()->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $this->authorize('create', Service::class);

        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = FileUploadHelper::uploadImage(
                $request->file('image'),
                'services'
            );
        }

        $validated['is_active'] = $request->has('is_active');

        $service = Service::create($validated);

        ActivityLogger::log('create_service', 'Service', $service->id, [
            'name'  => $service->name,
            'price' => $service->price,
        ]);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function show(Service $service)
    {
        $this->authorize('view', $service);

        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $this->authorize('update', $service);

        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $this->authorize('update', $service);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $validated['image'] = FileUploadHelper::uploadImage(
                $request->file('image'),
                'services'
            );
        }

        $validated['is_active'] = $request->has('is_active');

        $service->update($validated);

        ActivityLogger::log('update_service', 'Service', $service->id, [
            'name'  => $service->name,
            'price' => $service->price,
        ]);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        ActivityLogger::log('delete_service', 'Service', $service->id, [
            'name' => $service->name,
        ]);

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}