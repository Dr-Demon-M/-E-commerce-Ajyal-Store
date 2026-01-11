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
            <label class="form-label small fw-bold text-muted text-uppercase">Category Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0"><i class="fas fa-tag text-muted"></i></span>
                </div>
                <x-form.input type="text" name="name"
                    class="form-control form-control-lg border-left-0 shadow-none bg-light"
                    value="{{ $category->name }}" placeholder="Enter category name..." />
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Parent Category</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0"><i
                            class="fas fa-sitemap text-muted"></i></span>
                </div>
                <select class="form-control form-control-lg border-left-0 shadow-none bg-light" name="parent_id">
                    <option value="">Primary Category (No Parent)</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
            <textarea class="form-control border-0 shadow-none bg-light p-3"
                placeholder="Write a brief description about this category..." name="description"
                style="height: 120px; resize: none; border-radius: 10px;">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Category Image</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input shadow-none" name="image" id="categoryImage">
                <label class="custom-file-label border-0 bg-light" for="categoryImage">Choose file...</label>
            </div>
            @if ($category->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $category->image) }}" class="rounded shadow-sm border"
                        height="60">
                </div>
            @endif
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase d-block">Publication Status</label>
            <div class="p-2 rounded bg-light border d-inline-block px-4">
                <x-form.label name='status' :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
            </div>
        </div>
    </div>
</div>

<div class="card-footer bg-white border-top-0 p-4">
    <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill">
        <i class="fas fa-save mr-2"></i> {{ $button_label ?? 'Save Category' }}
    </button>
    <a href="{{ route('categories.index') }}" class="btn btn-link text-muted fw-bold">Cancel</a>
</div>
