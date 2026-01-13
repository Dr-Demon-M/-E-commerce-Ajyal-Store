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
        <div class="col-md-12 mb-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Role Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0"><i class="fas fa-tag text-muted"></i></span>
                </div>
                <x-form.input type="text" name="name"
                    class="form-control form-control-lg border-left-0 shadow-none bg-light" value="{{ $role->name }}"
                    placeholder="Enter role name..." />
            </div>
        </div>
        <fieldset class="border-0 p-0 m-0">
            <legend class="form-label small fw-bold text-muted text-uppercase mb-3">
                <i class="fas fa-shield-alt mr-2"></i> {{ __('Role Abilities & Permissions') }}
            </legend>
            <div class="row">
                @foreach (config('abilities') as $ability_code => $ability_name)
                    <div class="col-md-6 mb-3">
                        <div
                            class="p-3 border rounded shadow-sm bg-white d-flex align-items-center justify-content-between">
                            <div>
                                <span class="fw-bold text-dark d-block">{{ $ability_name }}</span>
                            </div>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-success btn-sm px-3 rounded-pill mr-2 ">
                                    <input type="radio" name="abilities[{{ $ability_code }}]" value="allow"
                                        {{ $ability_code }}
                                        @if ($role_ability) @checked($role_ability[$ability_code] == 'allow') @endif>
                                    <i class="fas fa-check-circle"></i> Allow
                                </label>
                                <label class="btn btn-outline-danger btn-sm px-3 rounded-pill">
                                    <input type="radio" name="abilities[{{ $ability_code }}]" value="deny"
                                        {{ $ability_code }}
                                        @if ($role_ability) @checked($role_ability[$ability_code] == 'deny') @endif>
                                    <i class="fas fa-times-circle"></i> Deny
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </fieldset>
        <div class="card-footer bg-white border-top-0 p-4">
            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill">
                <i class="fas fa-save mr-2"></i> {{ $button_label ?? 'Save Role' }}
            </button>
            <a href="{{ route('roles.index') }}" class="btn btn-link text-muted fw-bold">Cancel</a>
        </div>
