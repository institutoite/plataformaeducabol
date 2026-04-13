<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoursePurchaseRequest;

class CoursePurchaseRequestController extends Controller
{
    public function index()
    {
        $purchaseRequests = CoursePurchaseRequest::with(['course', 'user'])
            ->where('status', CoursePurchaseRequest::STATUS_PENDING)
            ->latest('id')
            ->paginate();

        return view('admin.courses.purchase-requests.index', compact('purchaseRequests'));
    }

    public function approve(CoursePurchaseRequest $purchaseRequest)
    {
        if ($purchaseRequest->status !== CoursePurchaseRequest::STATUS_PENDING) {
            return redirect()->route('admin.course-purchase-requests.index')
                ->with('info', 'La solicitud ya fue procesada previamente.');
        }

        $alreadyEnrolled = $purchaseRequest->course
            ->students()
            ->where('user_id', $purchaseRequest->user_id)
            ->exists();

        if (!$alreadyEnrolled) {
            $purchaseRequest->course->students()->attach($purchaseRequest->user_id);
        }

        $purchaseRequest->update([
            'status' => CoursePurchaseRequest::STATUS_APPROVED,
        ]);

        return redirect()->route('admin.course-purchase-requests.index')
            ->with('info', 'Solicitud aprobada e inscripción realizada correctamente.');
    }

    public function reject(CoursePurchaseRequest $purchaseRequest)
    {
        if ($purchaseRequest->status !== CoursePurchaseRequest::STATUS_PENDING) {
            return redirect()->route('admin.course-purchase-requests.index')
                ->with('info', 'La solicitud ya fue procesada previamente.');
        }

        $purchaseRequest->update([
            'status' => CoursePurchaseRequest::STATUS_REJECTED,
        ]);

        return redirect()->route('admin.course-purchase-requests.index')
            ->with('info', 'Solicitud rechazada.');
    }
}
