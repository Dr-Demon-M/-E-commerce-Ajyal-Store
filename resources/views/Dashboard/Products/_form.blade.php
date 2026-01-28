@if ($errors->any())
    <div class="alert alert-light border-left border-danger shadow-sm m-3" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-circle text-danger mr-3 fa-2x"></i>
            <div>
                <h6 class="text-danger fw-bold mb-1">Please fix the following errors:</h6>
                <ul class="list-unstyled mb-0 small text-secondary">
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-dot-circle text-danger mr-1" style="font-size: 8px;"></i> {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
<div class="card-body p-4">
    <div class="row">
        <div class="col-md-6 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Product Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0"><i class="fas fa-font text-muted"></i></span>
                </div>
                <x-form.input type="text" name="name"
                    class="form-control form-control-lg border-left-0 shadow-none bg-light"
                    placeholder="Enter category name..." value="{{ $product->name ?? '' }}" />
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Product Price</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0"><i
                            class="fas fa-dollar-sign text-muted"></i></span>
                </div>
                <x-form.input type="text" name="price"
                    class="form-control form-control-lg border-left-0 shadow-none bg-light"
                    placeholder="Enter Price ..." value="{{ $product->price ?? '' }}" />
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Product Tags</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0"><i class="fas fa-tags text-muted"></i></span>
                </div>
                <x-form.input type="text" name="tags"
                    class="form-control form-control-lg border-left-0 shadow-none bg-light" placeholder="Enter tags ..."
                    value="{{ $tags ?? '' }}" />
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Product Store</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0"><i class="fas fa-solid fa-store"
                            style="color: #454545;"></i></span>
                </div>
                <select class="form-control form-control-lg border-left-0 shadow-none bg-light" name="store_id">
                    <option value="">Select</option>
                    @foreach ($stores as $store)
                        <option value="{{ $store->id }}" @selected(old('category_id', $product->store_id) == $store->id)>
                            {{ $store->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Product Category</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0"><i class="fas fa-solid fa-icons"
                            style="color: #454545;"></i></span>
                </div>
                <select class="form-control form-control-lg border-left-0 shadow-none bg-light" name="category_id">
                    <option value="">Select</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Product Place</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0"><i class="fas fa-regular fa-id-badge"
                            style="color: #454545;"></i></span>
                </div>
                <select class="form-control form-control-lg border-left-0 shadow-none bg-light" name="show_in_home"
                    id="show_in_home">
                    <option value="">-- None (Don't display) --</option>


                    @foreach ($options as $value => $label)
                        <option value="{{ $value }}" @selected(old('show_in_home', $product->show_in_home) == $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Product Quantity</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0"><i
                            class="fas fa-dollar-sign text-muted"></i></span>
                </div>
                <x-form.input type="text" name="quantity"
                    class="form-control form-control-lg border-left-0 shadow-none bg-light"
                    placeholder="Enter Quantity ..." value="{{ $product->quantity ?? '' }}" />
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <label class="form-label small fw-bold text-muted text-uppercase">Product Image</label>
        <div class="custom-file">
            <input type="file" name="product_image" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file...</label>
        </div>
        @if ($product->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $product->image) }}" class="rounded shadow-sm border" height="60">
            </div>
        @endif
    </div>

    <div class="col-12 mb-4">
        <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
        <textarea class="form-control border-0 shadow-none bg-light p-3"
            placeholder="Write a brief description about this category..." name="description"
            style="height: 120px; resize: none; border-radius: 10px;">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="col-md-6 mb-4">
        <label class="form-label small fw-bold text-muted text-uppercase d-block">Status</label>
        <div class="p-2 rounded bg-light border d-inline-block px-4">
            <x-form.label name='status' :checked="$product->status" :options="['active' => 'Active', 'archived' => 'Archived', 'draft' => 'Draft']" />
        </div>
    </div>
</div>
<div class="card-footer bg-white border-top-0 p-4">
    <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill">
        <i class="fas fa-save mr-2"></i> {{ $button_label ?? 'Save Product' }}
    </button>
    <a href="{{ route('products.index') }}" class="btn btn-link text-muted fw-bold">Cancel</a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var inputElm = document.querySelector('[name="tags"]'),
            tagify = new Tagify(inputElm);
    </script>
@endpush
