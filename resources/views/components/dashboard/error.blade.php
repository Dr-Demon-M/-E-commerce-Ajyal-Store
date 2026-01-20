@props([])
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if ($errors->any())
                <div class="alert alert-light border-left border-danger shadow-sm mb-4" role="alert"
                    style="border-left: 5px solid #dc3545 !important;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle text-danger mr-3 fa-2x"></i>
                        <div>
                            <h6 class="text-danger fw-bold mb-1">Whoops! Something went wrong.</h6>
                            <ul class="list-unstyled mb-0 small text-secondary">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-dot-circle text-danger mr-1" style="font-size: 8px;"></i>
                                        {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
