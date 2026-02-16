@props([])

<div class="px-2 mt-2">
    {{-- تنبيه النجاح - Success --}}
    @if (session('success'))
        <div class="alert alert-light border-left-success shadow-sm d-flex align-items-center mb-3 py-3 alert-dismissible fade show" role="alert"
            style="border-left: 5px solid #28a745 !important; border-radius: 8px;">
            <i class="fas fa-check-circle text-success mr-3 fa-lg"></i>
            <div>
                <strong class="text-success d-block">Success!</strong>
                <span class="text-secondary small">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- تنبيه التحديث - Info/Update --}}
    @if (session('update'))
        <div class="alert alert-light border-left-info shadow-sm d-flex align-items-center mb-3 py-3 alert-dismissible fade show" role="alert"
            style="border-left: 5px solid #17a2b8 !important; border-radius: 8px;">
            <i class="fas fa-info-circle text-info mr-3 fa-lg"></i>
            <div>
                <strong class="text-info d-block">Updated!</strong>
                <span class="text-secondary small">{{ session('update') }}</span>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- تنبيه الحذف أو الخطأ - Danger/Delete --}}
    @if (session('delete'))
        <div class="alert alert-light border-left-danger shadow-sm d-flex align-items-center mb-3 py-3 alert-dismissible fade show" role="alert"
            style="border-left: 5px solid #dc3545 !important; border-radius: 8px;">
            <i class="fas fa-exclamation-triangle text-danger mr-3 fa-lg"></i>
            <div>
                <strong class="text-danger d-block">Deleted!</strong>
                <span class="text-secondary small">{{ session('delete') }}</span>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-light border-left-danger shadow-sm d-flex align-items-center mb-3 py-3 alert-dismissible fade show" role="alert"
            style="border-left: 5px solid #dc3545 !important; border-radius: 8px;">
            <i class="fas fa-exclamation-triangle text-danger mr-3 fa-lg"></i>
            <div>
                <strong class="text-danger d-block">Error!</strong>
                <span class="text-secondary small">{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>